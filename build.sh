#!/bin/bash
cd ~/Projects/chippyash/source/Logical-Matrix/
vendor/phpunit/phpunit/phpunit -c test/phpunit.xml --testdox-html contract.html test/
tdconv -t "Chippyash Logical Matrix" contract.html docs/Test-Contract.md
rm contract.html

