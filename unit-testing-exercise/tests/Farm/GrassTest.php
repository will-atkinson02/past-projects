<?php

declare(strict_types=1);

require_once 'src/Farm/Grass.php';

use PHPUnit\Framework\TestCase;

class GrassTest extends TestCase {
    public function testCreateGrass(): void
    {
        $grass = new Grass();
        $this->assertInstanceOf(Grass::class, $grass);
    }

    public function  test_getFoodType_success(): void
    {
       $grass = new Grass();

       $result = $grass->getFoodType();

       $expected = 'Grass';

       $this->assertEquals($expected, $result);
    }
}