<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */

namespace Chippyash\Logic\Matrix\Operation;

use Chippyash\Logic\Matrix\Operation\AbstractOperation;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 * NOT each matrix item
 */
class Not extends AbstractOperation
{
    /**
     * NOT each entry in the matrix
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param boolean $extra ignored
     *
     * @return LogicalMatrix
     *
     * @throws Chippyash\Logic\Matrix\Exceptions\LogicException
     */
    public function operate(LogicalMatrix $mA, $extra = null)
    {
        if ($mA->is('empty')) {
            return new LogicalMatrix([]);
        }

        $data = $mA->toArray();
        $lx = $mA->columns();
        $ly = $mA->rows();
        for ($x=0; $x<$lx; $x++) {
            for ($y=0; $y<$ly; $y++) {
                $data[$y][$x] = !$data[$y][$x];
            }
        }

        return new LogicalMatrix($data);
    }

}
