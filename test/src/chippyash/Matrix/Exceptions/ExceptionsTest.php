<?php
namespace chippyash\Test\Logic\Matrix\Exceptions;
use chippyash\Logic\Matrix\Exceptions;

/**
 * Unit test for alll Exception Classes
 */
class ExceptionsTest extends \PHPUnit_Framework_TestCase
{

    protected $exceptions = array();

    public function setUp()
    {
        $this->exceptions = array(
            'logic' => new Exceptions\LogicException('foo')
        );
    }

    /**
     *
     * @param \Exception $ex
     */
    public function testExceptionsDerivedFromComputationException()
    {
        foreach ($this->exceptions as $ex) {
            $this->assertInstanceOf('chippyash\Logic\Matrix\Exceptions\LogicException', $ex);
        }
    }


}
