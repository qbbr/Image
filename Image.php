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

    /**
     * @param string $imagePath
     */
    public function __construct($imagePath)
    {
        if (!file_exists($imagePath)) {
            throw new Q_Image_Exception("File {$imagePath} does not exist");
        }

        $this->_imagePath = $imagePath;
        $this->_image = $this->open($imagePath);
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

    protected function setContentType()
    {
        header('Content-type: ' . image_type_to_mime_type($this->_imageType));
    }

    /**
     * Rotate image
     *
     * @param integer $angle
     * @param integer $bgColor
     */
    public function rotate($angle, $bgColor = 0)
    {
        $manipulation = new Q_Image_Manipulation_Rotate($this->_image, $this->_imageType);

        $this->_image = $manipulation
            ->setAngle($angle)
            ->setBgColor($bgColor)
            ->getImage();
    }

    /**
     * Flip image
     *
     * @param boolean $horizontal
     * @param boolean $vertical
     */
    public function flip($horizontal = true, $vertical = false)
    {
        $manipulation = new Q_Image_Manipulation_Flip($this->_image, $this->_imageType);

        $this->_image = $manipulation
            ->setHorizontal($horizontal)
            ->setVertical($vertical)
            ->getImage();
    }

    /**
     * Filter
     *
     * @see http://php.net/manual/en/function.imagefilter.php
     * @param int|array $filter
     */
    public function filter($filter)
    {
        $manipulation = new Q_Image_Manipulation_Filter($this->_image, $this->_imageType);

        $this->_image = $manipulation->addFilter($filter)->getImage();
    }

    /**
     * Resize
     *
     * @param integer $width
     * @param integer $height
     * @param integer $mode
     */
    public function resize($width, $height, $mode = Q_Image_Manipulation_Resize::NONE)
    {
        $manipulation = new Q_Image_Manipulation_Resize($this->_image, $this->_imageType);

        $this->_image = $manipulation
            ->setWidth($width)
            ->setHeight($height)
            ->setMode($mode)
            ->getImage();
    }

    /**
     * Crop
     *
     * @param integer $width
     * @param integer $height
     * @param integer $x
     * @param integer $y
     */
    public function crop($width, $height, $x = Q_Image_Manipulation_Crop::CENTER, $y = Q_Image_Manipulation_Crop::CENTER)
    {
        $manipulation = new Q_Image_Manipulation_Crop($this->_image, $this->_imageType);

        $this->_image = $manipulation
            ->setWidth($width)
            ->setHeight($height)
            ->setX($x)
            ->setY($y)
            ->getImage();
    }

    /**
     * Output image to browser
     */
    public function output()
    {
        $this->setContentType();

        switch ($this->_imageType) {
            case IMAGETYPE_GIF:
                imagegif($this->_image);
                break;

            case IMAGETYPE_JPEG:
                imagejpeg($this->_image);
                break;

            case IMAGETYPE_PNG:
                imagepng($this->_image);
                break;
        }
    }

    /**
     * Save image to file
     *
     * @param string $file
     */
    public function save($file)
    {
        $dir = dirname($file);

        if (!is_dir($dir)) {
            throw new Q_Image_Exception("Dir ({$cacheDir}) not found");
        }

        if (!is_writable($dir)) {
            throw new Q_Image_Exception("Dir ({$dir}) is not writable");
        }

        if (file_exists($file)) {
            throw new Q_Image_Exception("File ({$file}) already exist");
        }

        switch ($this->_imageType) {
            case IMAGETYPE_GIF:
                imagegif($this->_image, $file);
                break;

            case IMAGETYPE_JPEG:
                imagejpeg($this->_image, $file);
                break;

            case IMAGETYPE_PNG:
                imagepng($this->_image, $file);
                break;
        }
    }
}
