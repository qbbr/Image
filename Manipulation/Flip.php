<?php
/**
 * Flip
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image_Manipulation_Flip extends Q_Image_Manipulation_Abstract
{
    protected $_horizontal = false;
    protected $_vertical = false;

    /**
     * @param boolean $horizontal
     */
    public function setHorizontal($horizontal)
    {
        $this->_horizontal = $horizontal;

        return $this;
    }

    /**
     * @param boolean $vertical
     */
    public function setVertical($vertical)
    {
        $this->_vertical = $vertical;

        return $this;
    }

    public function make()
    {
        $width = imagesx($this->_image);
        $height = imagesy($this->_image);

        $img = imagecreatetruecolor($width, $height);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                if ($this->_horizontal && $this->_vertical) {
                    imagecopy($img, $this->_image, $width - $x - 1, $height - $y - 1, $x, $y, 1, 1);
                } else if ($this->_horizontal) {
                    imagecopy($img, $this->_image, $width - $x - 1, $y, $x, $y, 1, 1);
                } else if ($this->_vertical) {
                    imagecopy($img, $this->_image, $x, $height - $y - 1, $x, $y, 1, 1);
                }
            }
        }

        $this->_image = $img;
    }
}
