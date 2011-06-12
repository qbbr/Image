<?php
/**
 * Image
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image
{
    protected $_image;
    protected $_imagePath;
    protected $_imageType;

    public function __construct($imagePath)
    {
        if (!file_exists($imagePath)) {
            throw new Q_Image_Exception("File {$imagePath} does not exist");
        }

        $this->_imagePath = $imagePath;
        $this->_image = $this->open($imagePath);
    }

    public function __destruct()
    {
        imagedestroy($this->_image);
    }

    protected function open($imagePath)
    {
        $this->_imageType = exif_imagetype($imagePath);

        switch ($this->_imageType) {
            case IMAGETYPE_GIF:
                return imagecreatefromgif($imagePath);
                break;

            case IMAGETYPE_JPEG:
                return imagecreatefromjpeg($imagePath);
                break;

            case IMAGETYPE_PNG:
                return imagecreatefrompng($imagePath);

            default:
                throw new Q_Image_Exception('Unknown image type');
                break;
        }
    }

    public function output($saveTo = null)
    {
        if (null !== $saveTo) {
            $dir = dirname($saveTo);

            if (!is_dir($dir)) {
                throw new Q_Image_Exception("Dir ({$cacheDir}) not found");
            }

            if (!is_writable($dir)) {
                throw new Q_Image_Exception("Dir ({$dir}) is not writable");
            }

            if (file_exists($saveTo)) {
                throw new Q_Image_Exception("File ({$saveTo}) already exist");
            }
        }

        switch ($this->_imageType) {
            case IMAGETYPE_GIF:
                if (null === $saveTo) $this->setContentType('gif');
                imagegif($this->_image, $saveTo);
                break;

            case IMAGETYPE_JPEG:
                if (null === $saveTo) $this->setContentType('jpeg');
                imagejpeg($this->_image, $saveTo);
                break;

            case IMAGETYPE_PNG:
                if (null === $saveTo) $this->setContentType('png');
                imagepng($this->_image, $saveTo);
                break;
        }
    }

    protected function setContentType($contentType)
    {
        header('Content-type: image/' . $contentType);
    }

    public function resize()
    {
    }

    public function crop()
    {
    }

    /**
     * @param integer $angle
     * @param integer $bgColor
     */
    public function rotate($angle, $bgColor = 0)
    {
        $manipulation = new Q_Image_Manipulation_Rotate($this->_image);

        $this->_image = $manipulation
            ->setAngle($angle)
            ->setBgColor($bgColor)
            ->getImage();
    }

    /**
     * @param boolean $horizontal
     * @param boolean $vertical
     */
    public function flip($horizontal = true, $vertical = false)
    {
        $manipulation = new Q_Image_Manipulation_Flip($this->_image);

        $this->_image = $manipulation
            ->setHorizontal($horizontal)
            ->setVertical($vertical)
            ->getImage();
    }

    public function save()
    {
    }
}
