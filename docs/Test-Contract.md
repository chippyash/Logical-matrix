# Chippyash Logical Matrix

## Chippyash\Test\Logic\Matrix\Exceptions\Exceptions

*  Exceptions derived from computation exception

## Chippyash\Test\Logic\Matrix\LogicalMatrix

*  Construct empty array gives empty matrix
*  Construct non empty array gives non empty matrix
*  Construct shorthand single item array gives single item matrix
*  Construct with incomplete matrix returns complete matrix
*  Construct with incomplete matrix using non default value
*  Construct with non boolean values returns logical matrix
*  Construct with matrix param returns logical matrix data clone
*  Construct with logical matrix param returns logical matrix data clone
*  Call test with valid class returns result
*  Call test with non attribute interface class throws exception
*  Invoke with bad computation name throws exception
*  Invoke proxies to operate with two params
*  Invoke proxies to operate with one param
*  Invoke will also proxy to transform
*  Invoke with no params throws exception
*  Invoke more than two no params throws exception
*  Transform returns logical matrix

## Chippyash\Test\Logic\Matrix\Computation\AbstractOperation

*  Invoke expects at least one argument
*  Invoke expects less than three arguments
*  Invoke can accept two arguments
*  Invoke proxies to compute

## Chippyash\Test\Logic\Matrix\Operation\AbstractMatrixOperation

*  Compute throws exception if second param not matrix
*  Compute throws exception if matrix is incomplete
*  Compute throws exception if extra is incomplete
*  Compute throws exception if matrices are dissimilar in rows
*  Compute throws exception if matrices are dissimilar in columns
*  Compute returns empty if matrix is empty
*  Compute returns matrix

## Chippyash\Test\Logic\Matrix\Computation\Logic\AbstractOpOperation

*  Compute accepts boolean operand
*  Compute rejects non boolean operand
*  Compute returns empty if matrix is empty

## Chippyash\Test\Logic\Matrix\Operation\AndMatrix

*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\AndOperand

*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\Not

*  Compute returns empty if matrix is empty
*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\OrMatrix

*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\OrOperand

*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\XorMatrix

*  Compute returns correct result

## Chippyash\Test\Logic\Matrix\Operation\XorOperand

*  Compute returns correct result


Generated by [chippyash/testdox-converter](https://github.com/chippyash/Testdox-Converter)