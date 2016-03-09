# chippyash/logical-matrix

## Quality Assurance

Certified for PHP 5.4 - 5.6

[![Build Status](https://travis-ci.org/chippyash/Logical-matrix.svg?branch=master)](https://travis-ci.org/chippyash/Logical-matrix)
[![Test Coverage](https://codeclimate.com/github/chippyash/Logical-matrix/badges/coverage.svg)](https://codeclimate.com/github/chippyash/Logical-matrix/coverage)
[![Code Climate](https://codeclimate.com/github/chippyash/Logical-matrix/badges/gpa.svg)](https://codeclimate.com/github/chippyash/Logical-matrix)

## What?

This library aims to provide logic matrix functionality and builds on the
chippyash/Matrix matrix data structure library:

*  Everything has a test case
*  It's PHP 5.4+

## When

The current library covers basic logical matrix manipulation.

If you want more, either suggest it, or better still, fork it and provide a pull request.

Check out [chippyash/Matrix](https://github.com/chippyash/Matrix) for Matrix data type support.

Check out [chippyash/Math-Matrix](https://github.com/chippyash/Math-Matrix) for mathematical matrix operations

Check out [chippyash/Strong-Type](https://github.com/chippyashl/Strong-Type) for strong type including numeric,
rational and complex type support

Check out [chippyash/Math-Type-Calculator](https://github.com/chippyash/Math-Type-Calculator) for arithmetic operations on aforementioned strong types

Check out [chippyash/Builder-Pattern](https://github.com/chippyash/Builder-Pattern) for an implementation of the Builder Pattern for PHP

### Operations supported

*  AndMatrix - return the result of two matrices ANDed
*  AndOperand - return matrix ANDed with a boolean operand
*  Not - return !matrix
*  OrMatrix - return the result of two matrices ORed
*  OrOperand - return matrix ORed with a boolean operand
*  XorMatrix - return the result of two matrices XORed
*  XorOperand - return matrix XORed with a boolean operand

The library is released under the [GNU GPL V3 or later license](http://www.gnu.org/copyleft/gpl.html)

## How

Please see the [chippyash/Matrix](https://github.com/chippyash/Matrix) for underlying
functionality.  Anything you can do with a Matrix, you can do with a LogicalMatrix.

### Coding Basics

A LogicalMatrix is a matrix for which all entries are a boolean value; true or false

A shortcut for a single item matrix is to supply a single array

<pre>
    use chippyash\Logic\Matrix\LogicalMatrix;

    $mA = new LogicalMatrix([]);  //empty matrix
    $mA = new LogicalMatrix([[]]);  //empty matrix
    $mA = new LogicalMatrix([true]);  //single item matrix
    $mA = new LogicalMatrix([2, false]);  //1x2 matrix
    $mA = new LogicalMatrix([2, false],[true, 'foo']);  //2x2 matrix
</pre>

N.B.  A matrix construction values are converted to their boolean equivalent, so
'' = false, 'foo' = true, 1 = true, 0 = false etc, according to normal PHP casting
rules for boolean.

As with any TDD application, the tests tell you everything you need to know about
the SUT.  Read them!  However for the short of temper amongst us, the salient
points are:

A Logical Matrix type is supplied

*  LogicalMatrix(array $source, bool $normalizeDefault = false)

#### Logical Matrices have additional attributes over and above a Matrix

*  Attributes always return a boolean.
*  You can use the is() method of a Matrix to test for an attribute
*  Attributes implement the chippyash\Matrix\Interfaces\AttributeInterface

<pre>
    //assuming $mA is a LogicalMatrix - this will return true
    if ($mA->is('Logical')) {}
    //is the same as, which can also be used on ordinary matrices
    $attr = new Logic\Matrix\Attribute\IsLogical();
    if ($attr($mA) {}
</pre>

#### Logical Matrices have operations

*  Operations always returns a Logical Matrix
*  The original matrix is untouched
*  You can use the magic __invoke functionality
*  Operations implement the chippyash\Logical\Matrix\Interfaces\OperationInterface

<pre>
    $mC = $mA("AndMatrix", $mB);
    //same as :
    $op = new Logic\Matrix\Operation\AndMatrix;
    $mC = $op($mA, $mB);
</pre>

The following operations are supplied:

- AndMatrix - AND two matrices
- AndOperand - AND matrix with boolean
- Not - NOT a matrix
- OrMatrix - OR two matrices
- OrOperand - OR matrix with boolean
- XorMatrix - XOR two matrices
- XorOperand - XOR matrix with boolean

#### The magic invoke methods allow you to write in a functional way

<pre>
        $fAnd = new AndMatrix();
        $fOr = new OrOperand();
        //($mA && $mB) || true
        return $fOr($fAnd($mA, $mB), true);
</pre>

### Changing the library

1.  fork it
2.  write the test
3.  amend it
4.  do a pull request

Found a bug you can't figure out?

1.  fork it
2.  write the test
3.  do a pull request

NB. Make sure you rebase to HEAD before your pull request

## Where?

The library is hosted at [Github](https://github.com/chippyash/Logical-matrix). It is
available at [Packagist.org](https://packagist.org/packages/chippyash/logical-matrix)

### Installation

Install [Composer](https://getcomposer.org/)

#### For production

add

<pre>
    "chippyash/logical-matrix": "~2.0"
</pre>

to your composer.json "requires" section

#### For development

Clone this repo, and then run Composer in local repo root to pull in dependencies

<pre>
    git clone git@github.com:chippyash/Logical-matrix.git LogicMatrix
    cd LogicMatrix
    composer update
</pre>

To run the tests:

<pre>
    cd LogicMatrix
    vendor/bin/phpunit -c test/phpunit.xml test/
</pre>

## License

This software library is released under the [GNU GPL V3 or later license](http://www.gnu.org/copyleft/gpl.html)

This software library is Copyright (c) 2015-2016, Ashley Kitson, UK

A commercial license is available for this software library, please contact the author. 
It is normally free to deserving causes, but gets you around the limitation of the GPL
license, which does not allow unrestricted inclusion of this code in commercial works.

## History

V0...  pre releases

V1.0.0 Original release

V1.0.5 Update for underlying library dependency

V1.0.6 Update phpunit version

V2.0.0 BC Break: change namespace from chippyash to Chippyash
