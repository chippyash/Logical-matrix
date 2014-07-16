<?php
/*
 * Matrix library
 *
 * @author Ashley Kitson <akitson@zf4.biz>
 * @copyright Ashley Kitson, UK, 2014
 * @licence GPL V3 or later : http://www.gnu.org/licenses/gpl.html
 */
namespace chippyash\Logic\Matrix;

use chippyash\Matrix\Matrix;
use chippyash\Logic\Matrix\Interfaces\OperationInterface;
use chippyash\Matrix\Interfaces\TransformationInterface;

/**
 * Construct a matrix with all entries set to true or false (1 or 0)
 * Synonym for (0,1)-matrix, Boolean and Logical matrix
 */
class LogicalMatrix extends Matrix
{
    const NS_LOGIC_ATTRIBUTE = 'chippyash\Logic\Matrix\Attribute\Is';
    const NS_OPERATION = 'chippyash\Logic\Matrix\Operation\\';

    /**
     * Construct a complete Matrix with all entries set to true or false (1 or 0)
     * Takes a source matrix or array (which can be incomplete and converts each
     * entry to boolean, setting a default value if entry does not exist.
     *
     * If a Matrix is supplied as $source, the data is cloned into the LogicalMatrix
     * converting to boolean values, with no further checks
     *
     * @param Matrix|array $source Array to initialise the matrix with
     * @param mixed $normalizeDefault Value to set missing vertices
     *
     */
    public function __construct($source, $normalizeDefault = false)
    {
        if ($source instanceof Matrix) {
            $this->store($source->toArray());
            return;
        }

        parent::__construct($source, false, true, (boolean) $normalizeDefault);
    }

    /**
     * Raw form of is() method. You can use this to test for attributes
     * not supplied with the library by passing in $attribute conforming to
     * AttributeInterface.  If it's something you think is important , consider
     * contributing it to the library.
     *
     * @extendAncestor
     *
     * @param string|AttributeInterface $attribute
     *
     * @return boolean
     *
     * @throws NotAnAttributeInterfaceException
     * @throws \BadMethodCallException
     */
    public function test($attribute)
    {
        if (is_string($attribute)) {
            $attribute = ucfirst(strtolower($attribute));
            $class = self::NS_LOGIC_ATTRIBUTE. $attribute;
            if (class_exists($class)) {
                $obj = new $class();
            } else {
                //let parent try to find the class
                return parent::test($attribute);
            }
        } else {
            $obj = $attribute;
        }

        //pass object to parent for testing
        return parent::test($obj);
    }

    /**
     * Carry out a logical operation with this matrix as first argument and an
     * optional second argument
     *
     * @param \chippyash\Logic\Matrix\Interfaces\OperationInterface $operation
     * @param mixed $extra
     * @return \chippyash\Logic\Matrix\LogicalMatrix
     */
    public function operate(OperationInterface $operation, $extra = null)
    {
        return $operation->operate($this, $extra);
    }

    /**
     *
     * @param \chippyash\Matrix\Interfaces\TransformationInterface $transformation
     * @param mixed $extra
     *
     * @return LogicalMatrix
     */
    public function transform(TransformationInterface $transformation, $extra = null)
    {
        return new LogicalMatrix(parent::transform($transformation, $extra)->toArray());
    }

    /**
     * Invokable interface - allows object to be called as function
     * Proxies to operate e.g.
     * $matrix("AndMatrix", $mB)
     * Proxies to transform e.g.
     * $matrix("Rowslice", array(1,2))
     *
     * @overideAncestor
     *
     * @param string $operationName Name of operation to perform
     * @param mixed $extra Additional parameter required by the operation
     *
     * @return \chippyash\Matrix\Matrix
     *
     * @throws \InvalidArgumentException
     */
    public function __invoke()
    {
        //argument arbitrage
        $numArgs = func_num_args();
        if ($numArgs == 1) {
            $operationName = func_get_arg(0);
            $extra = null;
        } elseif($numArgs == 2) {
            $operationName = func_get_arg(0);
            $extra = func_get_arg(1);
        } else {
            throw new \InvalidArgumentException(self::ERR_INVALID_INVOKE_ARG);
        }

        $oName = self::NS_OPERATION . $operationName;
        if (class_exists($oName, true)) {
            return $this->operate(new $oName(), $extra);
        }

        $tName = self::NS_TRANSFORMATION . $operationName;
        if (class_exists($tName, true)) {
            return $this->transform(new $tName(), $extra);
        }

        //else
        throw new \InvalidArgumentException(self::ERR_INVALID_OP_NAME);
    }

    /**
     * Store the data, converting each entry to a boolean
     *
     * @overideAncestor
     *
     * @param array $data
     *
     * @return void
     */
    protected function store(array $data)
    {
        foreach ($data as &$row) {
            foreach ($row as &$item) {
                $item = (boolean) $item;
            }
        }

        $this->data = $data;
    }

/** Operator extension facilitation **/

    public function __bw_or($other)
    {var_dump($other);exit;
        if ($other instanceof LogicalMatrix) {
            $op = new \chippyash\Logic\Matrix\Operation\OrMatrix();
        } elseif(is_bool($other)) {
            $op = new \chippyash\Logic\Matrix\Operation\OrOperand();
        }

        return $this->operate($op, $other);
    }
}
