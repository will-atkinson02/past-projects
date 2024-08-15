<?php

require_once 'src/ProductCodes/validateCodes.php';

use PHPUnit\Framework\TestCase;

class validateCodesTest extends TestCase {

    public function testFirstCharacter(): void
    {
        $code = '45RETY';

        $this->expectException(Exception::class);

        validateCode($code);
    }

    public function testLastCharacter(): void
    {
        $code = 'Z5RETB';

        $result = validateCode($code);

        $this->assertFalse($result);
    }

    public function testCodeLength(): void
    {
        $code = 'Z5RETBT34GH';

        $result = validateCode($code);

        $this->assertFalse($result);
    }

    public function testForMinus()
    {
        $code = 'Z5R-ETC';

        $result = validateCode($code);

        $this->assertFalse($result);
    }
}