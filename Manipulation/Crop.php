<?php
/**
 * Crop
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image_Manipulation_Crop extends Q_Image_Manipulation_Abstract
{
    const BOTTOM = -1;
    const CENTER = -2;

    protected $_width;
    protected $_height;
    protected $_x;
    protected $_y;

    /**
     * @param integer $width
     * @return Q_Image_Manipulation_Crop
     */
    public function setWidth($width)
    {
        $this->_width = $width;

        return $this;
    }

    /**
     * @param integer $height
     * @return Q_Image_Manipulation_Crop
     */
    public function setHeight($height)
    {
        $this->_height = $height;

        return $this;
    }

    /**
     * @param integer $x
     * @return Q_Image_Manipulation_Crop
     */
    public function setX($x)
    {
        $this->_x = $x;

        return $this;
    }

    /**
     * @param integer $y
     * @return Q_Image_Manipulation_Crop
     */
    public function setY($y)
    {
        $this->_y = $y;

        return $this;
    }

    protected function make()
    {
        $imageWidth = imagesx($this->_image);
        $imageHeight = imagesy($this->_image);

        $x = $this->_x;
        $y = $this->_y;

        if ($x == self::BOTTOM) {
            $x = $imageWidth - $this->_width;
        } else if ($x == self::CENTER) {
            $x = ($imageWidth - $this->_width) / 2;
        }

        if ($y == self::BOTTOM) {
            $y = $imageHeight - $this->_height;
        } else if ($y == self::CENTER) {
            $y = ($imageHeight - $this->_height) / 2;
        }

        $imageNew = imagecreatetruecolor($this->_width, $this->_height);
        imagecopy($imageNew, $this->_image, 0, 0, $x, $y, $this->_width, $this->_height);

        $this->_image = $imageNew;
    }
}
