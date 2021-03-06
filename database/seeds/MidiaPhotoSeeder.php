<?php

use Illuminate\Database\Seeder;

use Stalker\Models\Photo;
use Stalker\Models\Thumbnail;
use App\Models\Tag;
/**
 * Class ProtoSeeder
 */
class MidiaPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Photo::class, 20)->create()->each(function (Photo $photo) {
            $photo->thumbnails()->save(factory(Thumbnail::class)->make());
            $photo->thumbnails()->save(factory(Thumbnail::class)->make());
            // @todo 
            // $photo->tags()->save(factory(Tag::class)->make());
            // $photo->tags()->save(factory(Tag::class)->make());
            // $photo->tags()->save(factory(Tag::class)->make());
        });
    }
}
