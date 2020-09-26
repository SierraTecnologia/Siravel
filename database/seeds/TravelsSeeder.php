<?php

use Illuminate\Database\Seeder;

class TravelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Models\Travels\Hotel::class, 2)->create()->each(
            function ($hotel) {
                $hotel->rooms()->save(
                    factory(App\Models\Travels\Room::class, rand(1, 100))->create()->each(
                        function ($room) {
                            // $room->travels()->save(factory(App\Models\Travels\Travel::class, rand(1, 100))->make());  @todo 
                            return true;
                        }
                    )
                );
            }
        );
    }
}
