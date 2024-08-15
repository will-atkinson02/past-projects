<?php

declare(strict_types=1);

require_once 'src/Maths/circleArea.php';

use PHPUnit\Framework\TestCase;

class circleAreaTest extends TestCase {

    public function testSuccess(): void
    {
        $radius = 10;

        $result = circleArea($radius);

        $expected = 314.1592653589793;

        $this->assertEquals($result, $expected);

    }
}