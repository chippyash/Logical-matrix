<?php
namespace Chippyash\Test\Logic\Matrix\Computation\Logic;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AbstractOpOperationTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Chippyash\Logic\Matrix\Operation\AbstractOpOperation');
        $this->object
                ->expects($this->any())
                ->method('doOperation')
                ->will($this->returnValue(new LogicalMatrix(array())));
    }

    public function testComputeAcceptsBooleanOperand()
    {
        $m = new LogicalMatrix(array());
        $this->object->operate($m, true);
        $this->object->operate($m, false);
    }

    /**
     * @expectedException Chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Operand parameter is not boolean!
     * @dataProvider nonBoolValues
     */
    public function testComputeRejectsNonBooleanOperand($operand)
    {
        $m = new LogicalMatrix(array(1));
        $this->object->operate($m, $operand);
    }

    /**
     * Data provider
     * @return array [[operand],...]
     */
    public function nonBoolValues()
    {
        return array(
            array('foo'),
            array(2),
            array(2.23),
            array(array()),
            array(tmpfile()),
            array(new \stdClass()),
        );
    }

    public function testComputeReturnsEmptyIfMatrixIsEmpty()
    {
        $m = new LogicalMatrix(array());
        $test = $this->object->operate($m, true);
        $this->assertTrue($test->is('empty'));
    }
}
