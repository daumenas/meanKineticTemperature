<?php

namespace App\Domain\FileManagement\Model\Exceptions;

class InvalidFileException extends \Exception {
    public function __construct(string $message = "")
    {
        $reason = "Invalid file: {$message}";
        parent::__construct($reason);
    }
}