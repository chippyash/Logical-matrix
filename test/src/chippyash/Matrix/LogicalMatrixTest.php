<?php

namespace chippyash\Test\Logic\Matrix;

use chippyash\Logic\Matrix\LogicalMatrix;

/**
 * Unit test for LogicalMatrix Class
 */
class LogicalMatrixTest extends \PHPUnit_Framework_TestCase
{

    const NSUT = 'chippyash\Logic\Matrix\LogicalMatrix';

    /**
     * @var Matrix
     */
    protected $object;

    public function testConstructEmptyArrayGivesEmptyMatrix()
    {
        $this->object = new LogicalMatrix([]);
        $this->assertInstanceOf(self::NSUT, $this->object);
        $this->assertTrue($this->object->is('empty'));
    }

    public function testConstructNonEmptyArrayGivesNonEmptyMatrix()
    {
        $this->object = new LogicalMatrix([[1]]);
        $this->assertInstanceOf(self::NSUT, $this->object);
        $this->assertFalse($this->object->is('empty'));
    }

    public function testConstructShorthandSingleItemArrayGivesSingleItemMatrix()
    {
        $test = [true];
        $expected = [$test];

        $this->object = new LogicalMatrix($test);
        $this->assertEquals($expected, $this->object->toArray());
    }

    public function testConstructWithIncompleteMatrixReturnsCompleteMatrix()
    {
        $mA = new LogicalMatrix([[true, false],[]]);
        $this->assertInstanceOf(self::NSUT, $mA);
        $this->assertTrue($mA->is('complete'));
        $this->assertEquals([[true, false],[false, false]], $mA->toArray());
    }

    public function testConstructWithIncompleteMatrixUsingNonDefaultValue()
    {
        $mA = new LogicalMatrix([[true, false],[]], true);
        $this->assertInstanceOf(self::NSUT, $mA);
        $this->assertTrue($mA->is('complete'));
        $this->assertEquals([[true, false],[true, true]], $mA->toArray());
    }

    public function testConstructWithNonBooleanValuesReturnsLogicalMatrix()
    {
        $mA = new LogicalMatrix([[1, 0, -3.6, 'foo', '', new \stdClass()]]);
        $this->assertEquals([[true,false,true,true,false,true]], $mA->toArray());
    }

    public function testCallTestWithValidClassReturnsResult()
    {
        $this->object = new LogicalMatrix([]);
        $mA = new LogicalMatrix([]);
        $this->assertTrue($this->object->test('Logical', $mA));
    }

    /**
     * @expectedException chippyash\Matrix\Exceptions\NotAnAttributeInterfaceException
     */
    public function testCallTestWithNonAttributeInterfaceClassThrowsException()
    {
        $this->object = new LogicalMatrix([]);
        $mA = new LogicalMatrix([]);
        $this->assertTrue($this->object->test(new \stdClass(), $mA));
    }

    /**
     * @covers chippyash\Logic\Matrix\LogicalMatrix::__invoke()
     * @expectedException \InvalidArgumentException
     */
    public function testInvokeWithBadComputationNameThrowsException()
    {
        $mA = new LogicalMatrix([]);
        $mA('foobar');
    }

    /**
     * @covers chippyash\Logic\Matrix\LogicalMatrix::__invoke()
     * @covers chippyash\Logic\Matrix\LogicalMatrix::operate()
     */
    public function testInvokeProxiesToOperateWithTwoParams()
    {
        $testArray = [[true, false], [false, true]];
        $expectedArray = [[true, false], [false, true]];
        $object = new LogicalMatrix($testArray);
        $this->assertEquals($expectedArray, $object("AndOperand", true)->toArray());
    }

    /**
     * @covers chippyash\Logic\Matrix\LogicalMatrix::__invoke()
     * @covers chippyash\Logic\Matrix\LogicalMatrix::operate()
     */
    public function testInvokeProxiesToOperateWithOneParam()
    {
        $testArray = [[true, false], [false, true]];
        $expectedArray = [[false,true], [true, false]];
        $object = new LogicalMatrix($testArray);
        $this->assertEquals($expectedArray, $object("Not")->toArray());
    }

    /**
     * @covers chippyash\Logic\Matrix\LogicalMatrix::__invoke()
     * @covers chippyash\Matrix\Matrix::transform()
     */
    public function testInvokeWillAlsoProxyToTransform()
    {
        $testArray = [[true, true], [false, false]];
        $expectedArray = [[true, false], [true, false]];
        $object = new LogicalMatrix($testArray);
        $this->assertEquals($expectedArray, $object("Transpose")->toArray());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid number of arguments to invoke method
     */
    public function testInvokeWithNoParamsThrowsException()
    {
        $mA = new LogicalMatrix([]);
        $mA();
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Invalid number of arguments to invoke method
     */
    public function testInvokeMoreThanTwoNoParamsThrowsException()
    {
        $mA = new LogicalMatrix([]);
        $mA('foo','bar','baz');
    }


}
