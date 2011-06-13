<?php
/**
 * Abstract
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
abstract class Q_Image_Manipulation_Abstract
{
    /**
     * @var resource
     */
    protected $_image;
    protected $_imageType;

    /**
     * @param resource $image
     */
    public function __construct($image, $imageType)
    {
        $this->setImage($image);
        $this->setImageType($imageType);
    }

    final public function setImage($image)
    {
        $this->_image = $image;
    }

    final public function setImageType($imageType)
    {
        $this->_imageType = $imageType;
    }

    abstract protected function make();

    /**
     * @return resource
     */
    final public function getImage()
    {
        $this->make();

        return $this->_image;
    }

    protected function createImage($width, $height)
    {
        $image = imagecreatetruecolor($width, $height);

        if ($this->_imageType == IMAGETYPE_PNG) {
            imagesavealpha($image, true);
            imagealphablending($image, false);
        }

        return $image;
    }
}
