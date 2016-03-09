<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 * @link http://en.wikipedia.org/wiki/Matrix_(mathematics)
 */

namespace Chippyash\Logic\Matrix\Interfaces;

use Chippyash\Logic\Matrix\LogicalMatrix;
use Chippyash\Matrix\Interfaces\InvokableInterface;

/**
 * Logical operation interface
 * Operations must never modify the operands to the operation
 * and always return a LogicalMatrix as a result.
 *
 * LogicException based exceptions must be thrown if operation fails
 * for any reason
 *
 */
interface OperationInterface extends InvokableInterface
{
    /**
     * Carry out a computation and return the result
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param mixed $extra (logical) matrix or other parameter required by the operation
     *
     * @return LogicalMatrix
     *
     */
    public function operate(LogicalMatrix $mA, $extra = null);

}
