<?php
namespace Chippyash\Test\Logic\Matrix\Computation;
use Chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AbstractOperationTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Chippyash\Logic\Matrix\Operation\AbstractOperation');
    }

    /**
     * @expectedException Chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Invoke method expects 0<n<3 arguments
     */
    public function testInvokeExpectsAtLeastOneArgument()
    {
        $f = $this->object;
        $f();
    }

    /**
     * @expectedException Chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Invoke method expects 0<n<3 arguments
     */
    public function testInvokeExpectsLessThanThreeArguments()
    {
        $f = $this->object;
        $f('foo','bar','baz');
    }

    /**
     * @covers Chippyash\Logic\Matrix\Operation\AbstractOperation::__invoke
     * @covers Chippyash\Logic\Matrix\Operation\AbstractOperation::operate
     */
    public function testInvokeCanAcceptTwoArguments()
    {
        $f = $this->object;
        $f(new LogicalMatrix([]),'bar');
    }

    /**
     * @covers Chippyash\Logic\Matrix\Operation\AbstractOperation::__invoke
     */
    public function testInvokeProxiesToCompute()
    {
        $this->object->expects($this->exactly(2))
                ->method('operate')
                ->will($this->returnValue(new LogicalMatrix([[true]])));
        $f = $this->object;
        $m = new LogicalMatrix(array());
        $this->assertInstanceOf('Chippyash\Logic\Matrix\LogicalMatrix', $f($m));
        $this->assertEquals([[true]], $f($m)->toArray());
    }
}
