<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */

namespace chippyash\Logic\Matrix\Operation;

use chippyash\Logic\Matrix\Operation\AbstractOperation;
use chippyash\Logic\Matrix\LogicalMatrix;
use chippyash\Matrix\Traits\AssertMatrixRowsAreEqual;
use chippyash\Matrix\Traits\AssertMatrixColumnsAreEqual;
use chippyash\Logic\Matrix\Exceptions\LogicException;

/**
 * Abstract base for Matrix operand Logical computations
 */
abstract class AbstractMatrixOperation extends AbstractOperation
{
    use AssertMatrixRowsAreEqual;
    use AssertMatrixColumnsAreEqual;

    /**
     * Compute supplied matrix operand entries with each entry in the matrix
     * Each entry is cast to boolean before operation
     * The two matrices must be the same shape and size, and be complete
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param LogicalMatrix $extra Second matrix to use as operand
     *
     * @return LogicalMatrix Matrix containing true & false values
     *
     * @throws chippyash\Logic\Matrix\Exceptions\LogicException
     */
    public function operate(LogicalMatrix $mA, $extra = null)
    {
        if (!$extra instanceof LogicalMatrix) {
            throw new LogicException('Parameter to Logical computation is not a Logical Matrix');
        }

        if ($mA->is('empty') || $extra->is('empty')) {
            return new LogicalMatrix([]);
        }

        $this->assertMatrixRowsAreEqual($mA, $extra)
             ->assertMatrixColumnsAreEqual($mA, $extra);

        return $this->doOperation($mA, $extra);
    }

    /**
     * @param LogicalMatrix $mA first matrix to operate on
     * @param LogicalMatrix $mB second mtrix operand
     * @return LogicalMatrix
     */
    abstract protected function doOperation(LogicalMatrix $mA, LogicalMatrix $mB);
}
