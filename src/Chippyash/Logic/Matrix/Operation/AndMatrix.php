<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */

namespace Chippyash\Logic\Matrix\Operation;

use Chippyash\Logic\Matrix\Operation\AbstractMatrixOperation;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 * AND two logical matrices
 */
class AndMatrix extends AbstractMatrixOperation
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
        $lx = $mA->columns();
        $ly = $mA->rows();
        for ($row=0; $row<$ly; $row++) {
            for ($col=0; $col<$lx; $col++) {
                $data[$row][$col] = ($dA[$row][$col] && $dB[$row][$col]);
            }
        }

        return new LogicalMatrix($data);
    }
}
