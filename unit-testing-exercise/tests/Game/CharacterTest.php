<?php

declare(strict_types=1);

require_once 'src/Game/Character.php';

use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase {

    public function testCreateCharacter(): void
    {
        $weaponMock = $this->createMock(Weapon::class);

        $character = new Character('Sir Bob', $weaponMock);

        $this->assertInstanceOf(Character::class, $character);
    }

    public function testAttackSuccess(): void
    {
        $weaponMock = $this->createMock(Weapon::class);
        $weaponMock->method('dealDamage')->willReturn(20);

        $character = new Character('Sir Bob', $weaponMock);

        $result = $character->attack();

        $expected = "Sir Bob hit you for 20 damage.";

        $this->assertEquals($result, $expected);

    }
}