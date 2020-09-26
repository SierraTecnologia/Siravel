<?php

namespace Tests\Services;

use Facilitador\Services\Normalizer;
use Siravel\Services\EventService;
use Tests\TestCase;

class EventServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(EventService::class);
    }

    public function testGenerate()
    {
        $result = $this->service->generate('2018-03-22');

        $this->assertTrue(is_object($result));
        $this->assertEquals('Siravel\Services\EventService', get_class($result));
    }

    public function testCalendar()
    {
        $result = $this->service->calendar('2018-03-22');

        $this->assertTrue(is_array($result));
        $this->assertEquals(0, count($result));
    }

    public function testAsHtml()
    {
        $result = $this->service->asHtml(
            [
            'class' => '',
            'dates' => [
                '23' => [
                    3 => 'content'
                ]
            ]
            ]
        );

        $this->assertTrue(is_string($result));
        $this->assertEquals('<table class=""><thead><th>Segunda</th><th>Terça</th><th>Quarta</th><th>Quinta</th><th>Sexta</th><th>Sábado</th><th>Domingo</th></thead></table>', $result);
    }

    public function testLinks()
    {
        $result = $this->service->generate('2018-03-22')->links('none');

        $this->assertEquals('<div class="row calendar-links"><div class="col-12"><a class="previous none" href="'.config('app.url').'/events/2018-02-22">Mês Anterior</a><a class="next none" href="'.config('app.url').'/events/2018-04-22">Próximo Mês</a></div></div>', $result);
    }
}
