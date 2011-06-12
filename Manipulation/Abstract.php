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
    protected $_file;

    public function __construct($file)
    {
        $this->_file = $file;
    }
}
