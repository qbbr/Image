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

    /**
     * @param resource $image
     */
    public function __construct($image)
    {
        $this->setImage($image);
    }

    final public function setImage($image)
    {
        $this->_image = $image;
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
}
