<?php

declare(strict_types=1);

require_once 'src/UserDataValidator.php';

use PHPUnit\Framework\TestCase;

class UserDataValidatorTest extends TestCase
{
    public function test_create(): void
    {
        $this->assertInstanceOf(UserDataValidator::class, new UserDataValidator());
    }

    /**
     * Part one - Validate email method
     */

    public function test_validateEmail_malformed(): void
    {
        $input = ['test'];

        $subject = new UserDataValidator();

        $this->expectException(TypeError::class);

        $subject->validateEmail($input);
    }

    public function test_validateEmail_validEmail(): void
    {
        $input = 'test@test.com';

        $subject = new UserDataValidator();

        $actual = $subject->validateEmail($input);

        $this->assertTrue($actual);
    }

    public function test_validateEmail_invalidEmail(): void
    {
        $input = 'test';

        $subject = new UserDataValidator();

        $actual = $subject->validateEmail($input);

       $this->assertFalse($actual);
    }

    /**
     * Part two - Validate username method
     */

    public function test_validateUsername_malformed(): void
    {
        $input = ['test'];

        $subject = new UserDataValidator();

        $this->expectException(TypeError::class);

        $subject->validateUsername($input);
    }

    public function test_validateUsername_tooLong(): void
    {
        $input = 'testingtestingtestingtesting';

        $subject = new UserDataValidator();

        $actual = $subject->validateUsername($input);

        $this->assertFalse($actual, 'Usernames must not be longer than 20 characters');
    }

    public function test_validateUsername_tooShort(): void
    {
        $input = 'test';

        $subject = new UserDataValidator();

        $actual = $subject->validateUsername($input);

        $this->assertFalse($actual, 'Usernames must not be less than 5 characters');
    }

    public function test_validateUsername_containsSpaces(): void
    {
        $input = 'test test';

        $subject = new UserDataValidator();

        $actual = $subject->validateUsername($input);

        $this->assertFalse($actual, 'Usernames must not contain spaces');
    }

    public function test_validateUsername_valid(): void
    {
        $input = 'testtest';

        $subject = new UserDataValidator();

        $actual = $subject->validateUsername($input);

        $this->assertTrue($actual);
    }

    /**
     * Part three - Validate password method
     */

    public function test_validatePassword_malformed(): void
    {
        $input = ['test'];

        $subject = new UserDataValidator();

        $this->expectException(TypeError::class);

        $subject->validatePassword($input);
    }

    public function test_validatePassword_tooShort(): void
    {
        $input = 'test';

        $subject = new UserDataValidator();

        $actual = $subject->validatePassword($input);

        $this->assertFalse($actual, 'Passwords must not be less than 8 characters');
    }

    public function test_validatePassword_valid(): void
    {
        $input = 'testtesttesttest';

        $subject = new UserDataValidator();

        $actual = $subject->validatePassword($input);

        $this->assertTrue($actual);
    }

    /**
     * Part four - Validate age method
     */

    public function test_validateAge_malformed(): void
    {
        $input = 'sixteen';

        $subject = new UserDataValidator();

        $this->expectException(TypeError::class);

        $subject->validateAge($input);
    }

    public function test_validateAge_tooYoung(): void
    {
        $input = 6;

        $subject = new UserDataValidator();

        $actual = $subject->validateAge($input);

        $this->assertFalse($actual, 'Users cannot be less than 16');
    }

    public function test_validateAge_valid(): void
    {
        $input = 16;

        $subject = new UserDataValidator();

        $actual = $subject->validateAge($input);

        $this->assertTrue($actual);
    }

    /**
     * Part one - Validate type method
     */

    public function test_validateType_malformed(): void
    {
        $input = ['user'];

        $subject = new UserDataValidator();

        $this->expectException(TypeError::class);

        $subject->validateType($input);
    }

    public function test_validateType_invalid(): void
    {
        $input = 'test';

        $subject = new UserDataValidator();

        $actual = $subject->validateType($input);

        $this->assertFalse($actual, "Type must be one of: admin, editor or user");
    }

    public function test_validateType_validLowercase(): void
    {
        $input = 'admin';

        $subject = new UserDataValidator();

        $actual = $subject->validateType($input);

        $this->assertTrue($actual, "The type validator must be case insensitive");
    }

    public function test_validateType_validUppercase(): void
    {
        $input = 'Editor';

        $subject = new UserDataValidator();

        $actual = $subject->validateType($input);

        $this->assertTrue($actual, "The type validator must be case insensitive");
    }

    public function test_validateType_validExtra(): void
    {
        $input = 'user';

        $subject = new UserDataValidator();

        $actual = $subject->validateType($input);

        $this->assertTrue($actual, "The type validator must be case insensitive");
    }

}
