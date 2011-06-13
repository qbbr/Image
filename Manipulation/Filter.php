<?php
/**
 * Filter
 *
 * @package Q_Image
 * @author Sokolov Innokenty, <sokolov.innokenty@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT License
 * @copyright Copyright (c) 2011, qbbr
 */
class Q_Image_Manipulation_Filter extends Q_Image_Manipulation_Abstract
{
    protected $_filters = array();

    public function addFilter($filter)
    {
        if (is_array($filter)) {
            $this->_filters = array_merge($this->_filters, $filter);
        } else {
            $this->_filters[] = $filter;
        }

        return $this;
    }

    public function make()
    {
        foreach ($this->_filters as $filter) {
            imagefilter($this->_image, $filter);
        }
    }
}