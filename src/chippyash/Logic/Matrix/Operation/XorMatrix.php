<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */

namespace chippyash\Logic\Matrix\Operation;

use chippyash\Logic\Matrix\Operation\AbstractMatrixOperation;
use chippyash\Logic\Matrix\LogicalMatrix;

/**
 * XOR two matrices
 */
class XorMatrix extends AbstractMatrixOperation
{
    /**
     * @param LogicalMatrix $mA first matrix to operate on
     * @param LogicalMatrix $mB second matrix operand
     * @return LogicalMatrix
     */
    protected function doOperation(LogicalMatrix $mA, LogicalMatrix $mB)
    {
        $data = array();
        $dA = $mA->toArray();
        $dB = $mB->toArray();
        $cols = $mA->columns();
        $rows = $mA->rows();
        for ($row=0; $row<$rows; $row++) {
            for ($col=0; $col<$cols; $col++) {
                $data[$row][$col] = ($dA[$row][$col] xor $dB[$row][$col]);
            }
        }

        return new LogicalMatrix($data);
    }
}
