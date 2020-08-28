<?php

namespace Tests\Services;

use Support\Services\RiCaService;
use Tests\TestCase;

class RiCaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(RiCaService::class);
    }

    public function testDefaultLanguage()
    {
        $result = $this->service->isDefaultLanguage();

        $this->assertTrue($result);
    }

    public function testNotifications()
    {
        $result = $this->service->notification('testing');

        $this->assertTrue(is_null($result));
        $this->assertEquals('testing', session()->get('notification'));
    }

    public function testBreadcrumbs()
    {
        $result = $this->service->breadcrumbs(['module']);

        $this->assertEquals('<li class="breadcrumb-item">Module</li>', $result);
    }
}
