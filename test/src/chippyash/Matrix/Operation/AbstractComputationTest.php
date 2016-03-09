<?php
namespace chippyash\Test\Logic\Matrix\Computation;
use chippyash\Logic\Matrix\LogicalMatrix;

/**
 *
 * @author akitson
 */
class AbstractOperationTest extends \PHPUnit_Framework_TestCase
{
    protected $object;

    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('chippyash\Logic\Matrix\Operation\AbstractOperation');
    }

    /**
     * @expectedException chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Invoke method expects 0<n<3 arguments
     */
    public function testInvokeExpectsAtLeastOneArgument()
    {
        $f = $this->object;
        $f();
    }

    /**
     * @expectedException chippyash\Logic\Matrix\Exceptions\LogicException
     * @expectedExceptionMessage Logic Error: Invoke method expects 0<n<3 arguments
     */
    public function testInvokeExpectsLessThanThreeArguments()
    {
        $f = $this->object;
        $f('foo','bar','baz');
    }

    /**
     * @covers chippyash\Logic\Matrix\Operation\AbstractOperation::__invoke
     * @covers chippyash\Logic\Matrix\Operation\AbstractOperation::operate
     */
    public function testInvokeCanAcceptTwoArguments()
    {
        $f = $this->object;
        $f(new LogicalMatrix([]),'bar');
    }

    /**
     * @covers chippyash\Logic\Matrix\Operation\AbstractOperation::__invoke
     */
    public function testInvokeProxiesToCompute()
    {
        $this->object->expects($this->exactly(2))
                ->method('operate')
                ->will($this->returnValue(new LogicalMatrix([[true]])));
        $f = $this->object;
        $m = new LogicalMatrix(array());
        $this->assertInstanceOf('chippyash\Logic\Matrix\LogicalMatrix', $f($m));
        $this->assertEquals([[true]], $f($m)->toArray());
    }
}
