<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\Operation\Not;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class NotTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new Not();
    }

    public function testComputeReturnsEmptyIfMatrixIsEmpty()
    {
        $m = new LogicalMatrix(array());
        $test = $this->object->operate($m);
        $this->assertTrue($test->is('empty'));
    }

    /**
     * @dataProvider operateMatrices
     */
    public function testComputeReturnsCorrectResult($test, $expected)
    {
        $m = new LogicalMatrix($test);
        $this->assertEquals($expected, $this->object->operate($m)->toArray());
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
                array(array(false,true,false,false)),
            ),
            array(
                array(array(-1.2,0.0,1.2,2.2)),
                array(array(false,true,false,false)),
            ),
            array(
                array(array(2)),
                array(array(false)),
            ),
            array(
                array(array(true, false)),
                array(array(false, true)),
            ),
        );
    }
}
