<?php

namespace Tests\Services;

use Siravel\Services\EventService;
use Facilitador\Services\Normalizer;
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
        $result = $this->service->asHtml([
            'class' => '',
            'dates' => [
                '23' => [
                    3 => 'content'
                ]
            ]
        ]);

        $this->assertTrue(is_string($result));
        $this->assertEquals('<table class=""><thead><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></thead></table>', $result);
    }

    public function testLinks()
    {
        $result = $this->service->generate('2018-03-22')->links('none');

        $this->assertEquals('<div class="row calendar-links"><div class="col-12"><a class="previous none" href="http://localhost/events/2018-02-22">Previous Month</a><a class="next none" href="http://localhost/events/2018-04-22">Next Month</a></div></div>', $result);
    }
}
