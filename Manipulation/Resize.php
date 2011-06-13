<?php
/**
 * Resize
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image_Manipulation_Resize extends Q_Image_Manipulation_Abstract
{
    const NONE = 1;         // без сохранения пропорций
    const LARGER_SIDE = 2;  // подогнать по большей чтороне
    const SMALLER_SIDE = 3; // подогнать по меньшей стороне

    protected $_width;
    protected $_height;
    protected $_mode;

    /**
     * @param integer $width
     * @return Q_Image_Manipulation_Resize
     */
    public function setWidth($width)
    {
        $this->_width = $width;

        return $this;
    }

    /**
     * @param integer $height
     * @return Q_Image_Manipulation_Resize
     */
    public function setHeight($height)
    {
        $this->_height = $height;

        return $this;
    }

    /**
     * @param integer $mode
     * @return Q_Image_Manipulation_Resize
     */
    public function setMode($mode)
    {
        $this->_mode = $mode;

        return $this;
    }

    protected function make()
    {
        $imageWidth = imagesx($this->_image);
        $imageHeight = imagesy($this->_image);

        if ($this->_mode == self::NONE) {
            $newWidth = $this->_width;
            $newHeight = $this->_height;
        } else {
            if (
                ($this->_mode == self::LARGER_SIDE && $imageWidth > $imageHeight)
                || ($this->_mode == self::SMALLER_SIDE && $imageWidth < $imageHeight)
               ) {
                $p = ($this->_width * 100) / $imageWidth;
                $newWidth = $this->_width;
                $newHeight = ($imageHeight * $p) / 100;
            } else {
                $p = ($this->_height * 100) / $imageHeight;
                $newHeight = $this->_height;
                $newWidth = ($imageWidth * $p) / 100;
            }
        }

        $imageNew = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($imageNew, $this->_image, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);

        $this->_image = $imageNew;
    }
}