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
    const FILL = 4;         // вписать
}