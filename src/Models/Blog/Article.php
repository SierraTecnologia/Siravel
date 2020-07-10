<?php

namespace Siravel\Models\Blog;


use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;
use Siravel\Models\CmsModel as BaseModel;
use Cviebrock\EloquentSluggable\Sluggable;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Overtrue\LaravelFollow\Traits\CanBeVoted;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;

use Siravel\Contracts\Business\BusinessTrait;

class Article extends BaseModel {

	use SoftDeletes;
    use Sluggable;
    use BusinessTrait;

    use CanBeLiked, CanBeFavorited, CanBeVoted, CanBeBookmarked;

	protected $dates = ['deleted_at'];

	protected $sluggable = [
		'save_to'    => 'slug',
		'build_from' => 'title',
	];


    protected $translatable = ['slug', 'title'];

	protected $guarded  = array('id');

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function content()
	{
		return nl2br($this->content);
	}

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function introduction()
	{
		return nl2br($this->introduction);
	}

	/**
	 * Get the post's author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}


	/**
	 * Get the post's category.
	 *
	 * @return Category
	 */
	public function category()
	{
		return $this->belongsTo(Category::class,'category_id');
	}

}