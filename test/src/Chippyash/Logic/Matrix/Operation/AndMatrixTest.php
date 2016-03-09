<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\Operation\AndMatrix;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AndMatrixTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new AndMatrix();
    }

    /**
     * @dataProvider operateMatrices
     */
    public function testComputeReturnsCorrectResult($aA, $aB, $expected)
    {
        $mA = new LogicalMatrix($aA);
        $mB = new LogicalMatrix($aB);
        $this->assertEquals($expected, $this->object->operate($mA, $mB)->toArray());
    }

    /**
     * Data provider
     * @return array [[test, expected, matrix],...]
     */
    public function operateMatrices()
    {
        return array(
            array(
                array(array(true,false)),
                array(array(true,true)),
                array(array(true, false)),
            ),
            array(
                array(array(true,false)),
                array(array(false,false)),
                array(array(false, false)),
            ),
            array(
                array(array(1,0)),
                array(array(1,1)),
                array(array(true, false)),
            ),
            array(
                array(array(1,0)),
                array(array(0,0)),
                array(array(false, false)),
            ),
        );
    }
}
