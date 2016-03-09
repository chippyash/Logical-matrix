<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */

namespace Chippyash\Logic\Matrix\Exceptions;
use Chippyash\Matrix\Exceptions\MatrixException;

/**
 * A logic operation exception
 */
class LogicException extends MatrixException
{
    protected $msgTpl = "Logic Error: %s";

    public function __construct($reason, $code = -1, $previous = null)
    {
        $message = sprintf($this->msgTpl, $reason);
        parent::__construct($message, $code, $previous);
    }
}
