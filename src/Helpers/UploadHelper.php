<?php

declare(strict_types=1);

namespace D4Sign\Helpers;

use D4Sign\Exceptions\D4SignInvalidArgumentException;
use GuzzleHttp\Psr7\Utils;

class UploadHelper
{
    public static function getFile(string $filepath): array
    {
        if (! file_exists($filepath)) {
            throw new D4SignInvalidArgumentException("File does not exist: $filepath");
        }

        return [
            'name' => 'file',
            'contents' => Utils::tryFopen($filepath, 'r'),
            'filename' => basename($filepath),
        ];
    }
}
