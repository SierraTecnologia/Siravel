<?php

use Tests\TestCase;
use Siravel\Services\FeatureService;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeatureServiceTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $role = factory(Siravel\Models\Role::class)->create();
        $user = factory(Siravel\Models\User::class)->create();
        $this->app->make(Siravel\Services\UserService::class)->create($user, 'password');

        $this->service = $this->app->make(FeatureService::class);
        $this->originalArray = [
            'id' => 1,
            'key' => 'signup',
        ];
        $this->editedArray = [
            'id' => 1,
            'key' => 'registration',
        ];
        $this->searchTerm = '';
    }

    public function testPaginated()
    {
        $response = $this->service->paginated(25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testSearch()
    {
        $response = $this->service->search($this->searchTerm, 25);
        $this->assertEquals(get_class($response), 'Illuminate\Pagination\LengthAwarePaginator');
        $this->assertEquals(0, $response->total());
    }

    public function testCreate()
    {
        $response = $this->service->create($this->originalArray);
        $this->assertEquals(get_class($response), 'Siravel\Models\Feature');
        $this->assertEquals(1, $response->id);
    }

    public function testFind()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->find($item->id);
        $this->assertEquals(1, $response->id);
    }

    public function testUpdate()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->update($item->id, $this->editedArray);

        $this->assertEquals(1, $response->id);
        $this->assertDatabaseHas('features', $this->editedArray);
    }

    public function testDestroy()
    {
        // create the item
        $item = $this->service->create($this->originalArray);

        $response = $this->service->destroy($item->id);
        $this->assertTrue($response);
    }
}
