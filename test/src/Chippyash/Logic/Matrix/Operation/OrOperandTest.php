<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\Operation\OrOperand;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class OrOperandTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new OrOperand();
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
                array(array(true,true,true,true)),
                true
            ),
            array(
                array(array(-1,0,1,2)),
                array(array(true,false,true,true)),
                false
            ),
            array(
                array(array(-1.2,0.0,1.2,2.2)),
                array(array(true,true,true,true)),
                true
            ),
            array(
                array(array(-1.2,0.0,1.2,2.2)),
                array(array(true,false,true,true)),
                false
            ),
            array(
                array(array(2)),
                array(array(true)),
                true
            ),
            array(
                array(array(2)),
                array(array(true)),
                false
            ),
            array(
                array(array(true, false)),
                array(array(true, true)),
                true
            ),
            array(
                array(array(true, false)),
                array(array(true, false)),
                false
            ),
        );
    }
}
