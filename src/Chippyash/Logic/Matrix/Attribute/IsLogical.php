<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 * @link http://en.wikipedia.org/wiki/Matrix_(mathematics)
 */
namespace Chippyash\Logic\Matrix\Attribute;

use Chippyash\Matrix\Interfaces\AttributeInterface;
use Chippyash\Matrix\Matrix;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 * Is matrix a Logical matrix?
 */
class IsLogical implements AttributeInterface
{
    /**
     * Does the matrix have this attribute
     * Synonym for (0,1)-matrix, Boolean and Logical matrix
     *
     * @param Matrix $mA
     * @return boolean
     */
    public function is(Matrix $mA)
    {
        return ($mA instanceof LogicalMatrix);
    }
}
