<?php

declare(strict_types=1);

require_once 'src/Game/Weapon.php';

use PHPUnit\Framework\TestCase;

class WeaponTest extends TestCase {

    public function testSuccess(): void
    {
        $weapon = new Weapon();
        $result =  $weapon->dealDamage();

        $expected = 20;

        $this->assertEquals($result, $expected);
    }
}