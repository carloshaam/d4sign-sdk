<?php

declare(strict_types=1);

use D4Sign\Contracts\SafeServiceInterface;
use D4Sign\D4Sign;
use PHPUnit\Framework\TestCase;

class D4SignTest extends TestCase
{
    public function testSafesServiceInstantiation()
    {
        $sdk = new D4Sign('tokenAPI', 'cryptKey');
        $safeService1 = $sdk->safes();
        $safeService2 = $sdk->safes();

        $this->assertInstanceOf(SafeServiceInterface::class, $safeService1);
        $this->assertSame($safeService1, $safeService2);
    }
}