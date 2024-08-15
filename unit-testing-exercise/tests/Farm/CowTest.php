<?php

declare(strict_types=1);

require_once 'src/Farm/Cow.php';

use PHPUnit\Framework\TestCase;

class CowTest extends TestCase {
    public function testCreateCow(): void
    {
        $cow = new Cow();
        $this->assertInstanceOf(Cow::class, $cow);
    }

    public function testFeedSuccess(): void
    {
        // Arrange
        $cow = new Cow();
        $grassMock = $this->createMock(Grass::class);
        $grassMock->method('getFoodType')->willReturn('Grass');

        // Act
        $result = $cow->feed($grassMock);

        // Assert
        $expected  = 'mmmm Grass.';
        $this->assertEquals($expected, $result);
    }
}