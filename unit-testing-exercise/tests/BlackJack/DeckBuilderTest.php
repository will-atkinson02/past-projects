<?php

declare(strict_types=1);

require_once 'src/Blackjack/DeckBuilder.php';

use PHPUnit\Framework\TestCase;

class DeckBuilderTest extends TestCase {

    public function testTypeIsArray(): void
    {
        $newDeck = new DeckBuilder();
        $generatedDeck = $newDeck->generate();

        $this->assertIsArray($generatedDeck);
    }

    public function testNumberOfItems(): void
    {
        $newDeck = new DeckBuilder();
        $generatedDeck = $newDeck->generate();

        $numberOfItems = count($generatedDeck);

        $expected = 52;

        $this->assertEquals($expected, $numberOfItems);
    }

    public function testKeysOfItems(): void
    {
        $newDeck = new DeckBuilder();
        $generatedDeck = $newDeck->generate();

        $expected = ['card', 'score'];

        foreach ($generatedDeck as $card) {
            $result = array_keys($card);
            $this->assertEquals($expected, $result);
        }

    }

    public function testForDuplicateCards(): void
    {
        $newDeck = new DeckBuilder();
        $generatedDeck = $newDeck->generate();

        $allCards = [];

        foreach ($generatedDeck as $card) {
            $allCards[] = $card['card'];
        }

        $numberOfUniqueCards = array_unique($allCards);
        $result = count($numberOfUniqueCards);

        $expected = 52;

        $this->assertEquals($expected, $result);
    }
}
