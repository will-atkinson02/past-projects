<?php

declare(strict_types=1);

require_once 'src/Maths/double.php';

use PHPUnit\Framework\TestCase;

class DoubleTest extends TestCase{
    public function testSuccess(): void
    {
        $x = 2;

        $result =  double($x);

        $expected = 4;

        $this->assertEquals($result, $expected);
    }
}