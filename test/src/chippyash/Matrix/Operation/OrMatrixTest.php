<?php
namespace chippyash\Test\Logic\Matrix\Operation;
use chippyash\Logic\Matrix\Operation\OrMatrix;
use chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 */
class OrMatrixTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new OrMatrix();
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
                array(array(true, true)),
            ),
            array(
                array(array(true,false)),
                array(array(false,false)),
                array(array(true, false)),
            ),
            array(
                array(array(1,0)),
                array(array(1,1)),
                array(array(true, true)),
            ),
            array(
                array(array(1,0)),
                array(array(0,0)),
                array(array(true, false)),
            ),
        );
    }
}
