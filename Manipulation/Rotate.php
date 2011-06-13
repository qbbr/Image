<?php
/**
 * Rotate
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image_Manipulation_Rotate extends Q_Image_Manipulation_Abstract
{
    protected $_angle = 0;
    protected $_bgColor = 0;

    /**
     * @param integer $angle
     * @return Q_Image_Manipulation_Rotate
     */
    public function setAngle($angle)
    {
        $this->_angle = $angle;

        return $this;
    }

    /**
     * @param integer $bgColor
     * @return Q_Image_Manipulation_Rotate
     */
    public function setBgColor($bgColor)
    {
        $this->_bgColor = $bgColor;

        return $this;
    }

    protected function make()
    {
        $this->_image = imagerotate($this->_image, $this->_angle, $this->_bgColor);
    }
}