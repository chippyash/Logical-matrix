<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\Operation\XorMatrix;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 */
class XorMatrixTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = new XorMatrix();
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
     * @return array [[dataA, dataB, expected],...]
     */
    public function operateMatrices()
    {
        return [
            [
                [[true,false]],
                [[true,true]],
                [[false, true]],
            ],
            [
                [[true,false]],
                [[false,false]],
                [[true, false]],
            ],
            [
                [[1,0]],
                [[1,1]],
                [[false, true]],
            ],
            [
                [[1,0]],
                [[0,0]],
                [[true, false]],
            ],
        ];
    }
}
