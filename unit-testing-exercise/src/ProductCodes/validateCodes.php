<?php

declare(strict_types=1);

function validateCode(string $codeUppercase): bool {
    //$codeUppercase = strtoupper(string $code);

    if ($codeUppercase[0] !== 'Z') {
        throw new Exception("Error: First character must be 'Z'");
    }

    if (substr($codeUppercase, -1) === 'B') {
        return false;
    }

    if(strlen($codeUppercase) > 10) {
        return false;
    }

    if(str_contains($codeUppercase, '-')) {
        return false;
    }
    return true;
}