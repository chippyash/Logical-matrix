<?php
namespace Chippyash\Test\Logic\Matrix\Operation;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AbstractMatrixOperationTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Chippyash\Logic\Matrix\Operation\AbstractMatrixOperation');
    }

    /**
     * @expectedException Chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Parameter to Logical computation is not a Logical Matrix
     */
    public function testComputeThrowsExceptionIfSecondParamNotMatrix()
    {
        $m = new LogicalMatrix([]);
        $this->object->operate($m, 'foo');
    }

    /**
     * @expectedException Chippyash\Matrix\Exceptions\MatrixException
     * @expectedExceptionMessage mA->rows != mB->rows
     */
    public function testComputeThrowsExceptionIfMatrixIsIncomplete()
    {
        $mA = new LogicalMatrix([[2,1],[2]]);
        $mB = new LogicalMatrix([1]);
        $this->object->operate($mA, $mB);
    }

    /**
     * @expectedException Chippyash\Matrix\Exceptions\MatrixException
     * @expectedExceptionMessage mA->rows != mB->rows
     */
    public function testComputeThrowsExceptionIfExtraIsIncomplete()
    {
        $mA = new LogicalMatrix([[2,1],[2]]);
        $mB = new LogicalMatrix([1]);
        $this->object->operate($mB, $mA);
    }

    /**
     * @expectedException Chippyash\Matrix\Exceptions\MatrixException
     * @expectedExceptionMessage mA->rows != mB->rows
     */
    public function testComputeThrowsExceptionIfMatricesAreDissimilarInRows()
    {
        $mA = new LogicalMatrix([[2,1],[2, 2]]);
        $mB = new LogicalMatrix([1]);
        $this->object->operate($mB, $mA);
    }

    /**
     * @expectedException Chippyash\Matrix\Exceptions\MatrixException
     * @expectedExceptionMessage mA->cols != mB->cols
     */
    public function testComputeThrowsExceptionIfMatricesAreDissimilarInColumns()
    {
        $mA = new LogicalMatrix([[2,1]]);
        $mB = new LogicalMatrix([1]);
        $this->object->operate($mB, $mA);
    }

    public function testComputeReturnsEmptyIfMatrixIsEmpty()
    {
        $mA = new LogicalMatrix([]);
        $mB = new LogicalMatrix([1]);
        $this->assertTrue($this->object->operate($mA, $mB)->is('empty'));
        $this->assertTrue($this->object->operate($mB, $mA)->is('empty'));
    }

    public function testComputeReturnsMatrix()
    {
        $this->object
                ->expects($this->once())
                ->method('doOperation')
                ->will($this->returnValue(new LogicalMatrix([true])));
        $m = new LogicalMatrix([[1]]);
        $test = $this->object->operate($m,$m);
        $this->assertInstanceOf('Chippyash\Logic\Matrix\LogicalMatrix', $test);
        $this->assertEquals([[true]], $test->toArray());
    }
}
