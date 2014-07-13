<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 * @link http://en.wikipedia.org/wiki/Matrix_(mathematics)
 */

namespace chippyash\Logic\Matrix\Operation;

use chippyash\Logic\Matrix\Operation\AbstractOperation;
use chippyash\Logic\Matrix\LogicalMatrix;
use chippyash\Logic\Matrix\Exceptions\LogicException;

/**
 * Abstract base for Operand Logical computations
 */
abstract class AbstractOpOperation extends AbstractOperation
{

    /**
     * Compute single value with each entry in the matrix
     * Each entry is cast to boolean before operation
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param boolean $extra value to use as operand
     *
     * @return LogicalMatrix Matrix containing true & false values
     *
     * @throws chippyash\Logic\Matrix\Exceptions\LogicException
     */
    public function operate(LogicalMatrix $mA, $extra = null)
    {
        if ($mA->is('empty')) {
            return new LogicalMatrix([]);
        }
        if (!is_bool($extra)) {
            throw new LogicException('Operand parameter is not boolean!');
        }

        return $this->doOperation($mA, $extra);
    }

    /**
     * @param LogicalMatrix $mA matrix to operate on
     * @param boolean $op operand
     * @return LogicalMatrix
     */
    abstract protected function doOperation(LogicalMatrix $mA, $op);
}
