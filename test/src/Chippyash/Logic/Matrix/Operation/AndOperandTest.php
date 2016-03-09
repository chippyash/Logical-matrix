<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\Operation\AndOperand;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AndOperandTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new AndOperand();
    }

    /**
     * @dataProvider operateMatrices
     */
    public function testComputeReturnsCorrectResult($test, $expected, $operand)
    {
        $m = new LogicalMatrix($test);
        $this->assertEquals($expected, $this->object->operate($m, $operand)->toArray());
    }

    /**
     * Data provider
     * @return array [[test, expected, operand],...]
     */
    public function operateMatrices()
    {
        return array(
            array(
                array(array(-1,0,1,2)),
                array(array(true,false,true,true)),
                true
            ),
            array(
                array(array(-1,0,1,2)),
                array(array(false,false,false,false)),
                false
            ),
            array(
                array(array(-1.2,0.0,1.2,2.2)),
                array(array(true,false,true,true)),
                true
            ),
            array(
                array(array(-1.2,0.0,1.2,2.2)),
                array(array(false,false,false,false)),
                false
            ),
            array(
                array(array(2)),
                array(array(true)),
                true
            ),
            array(
                array(array(2)),
                array(array(false)),
                false
            ),
            array(
                array(array(true, false)),
                array(array(true, false)),
                true
            ),
            array(
                array(array(true, false)),
                array(array(false, false)),
                false
            ),
        );
    }
}
