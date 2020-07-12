<?php

namespace Tests\Services;

use Siravel\Services\SiravelService;
use Tests\TestCase;

class SiravelServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = app(SiravelService::class);
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
