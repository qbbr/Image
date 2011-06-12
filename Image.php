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

    public function __construct($image)
    {
        if (!file_exists($image)) {
            throw new Q_Image_Exception("File {$image} does not exist");
        }

        $this->_image = $image;
    }

    public function resize()
    {
    }

    public function crop()
    {
    }

    public function rotate()
    {
    }

    public function save()
    {
    }
}
