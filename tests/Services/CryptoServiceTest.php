<?php

namespace Tests\Services;

use Crypto;
use Tests\TestCase;

class CryptoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(Crypto::class);
    }


    public function testEncrypt()
    {
        $result = $this->service->encrypt('test');

        $this->assertContains('--', $result);
    }

    public function testDecrypt()
    {
        $value = $this->service->encrypt('test');

        $result = $this->service->decrypt($value);

        $this->assertEquals('test', $result);
    }
}
