<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 * @link http://en.wikipedia.org/wiki/Matrix_(mathematics)
 */
namespace Chippyash\Logic\Matrix\Operation;

use Chippyash\Logic\Matrix\Interfaces\OperationInterface;
use Chippyash\Logic\Matrix\LogicalMatrix;
use Chippyash\Logic\Matrix\Exceptions\LogicException;
use Chippyash\Matrix\Traits\Debug;

/**
 * Base abstract for logical operations
 *
 * Has invokable interface
 */
abstract class AbstractOperation implements OperationInterface
{
    use Debug;

    /**
     * Carry out a operation and return the result
     * MUST be overriden
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param mixed $extra (logical) matrix or other parameter required by the operation
     *
     * @return LogicalMatrix
     *
     */
    abstract public function operate(LogicalMatrix $mA, $extra = null);

    /**
     * Proxy to compute()
     * Allows object to be called as function
     *
     * @param LogicalMatrix $mA First matrix to act on - required
     * @param mixed $extra (logical) matrix or other parameter required by the computation
     *
     * @return LogicalMatrix
     *
     * @throws Chippyash\Logic\Matrix\Exceptions\LogicException
     */
    public function __invoke()
    {
        $numArgs = func_num_args();
        if ($numArgs == 1) {
            return $this->operate(func_get_arg(0));
        } elseif($numArgs == 2) {
            return $this->operate(func_get_arg(0), func_get_arg(1));
        } else {
            throw new LogicException('Invoke method expects 0<n<3 arguments');
        }
    }
}
