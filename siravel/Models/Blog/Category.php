<?php

namespace Siravel\Models\Blog;

use Siravel\Models\Model;
use Siravel\Models\User;
use App\System\Language;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $guarded  = array('id');

	/**
	 * Returns a formatted post content entry,
	 * this ensures that line breaks are returned.
	 *
	 * @return string
	 */
	public function description()
	{
		return nl2br($this->description);
	}

	/**
	 * Get the author.
	 *
	 * @return User
	 */
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	/**
	 * Get the slider's images.
	 *
	 * @return array
	 */
	public function articles()
	{
		return $this->hasMany(Article::class,'article_category_id');
	}

	/**
	 * Get the slider's images.
	 *
	 * @return array
	 */
	public function posts()
	{
		return $this->hasMany(Article::class,'article_category_id');
	}

	/**
	 * Get the category's language.
	 *
	 * @return Language
	 */
	public function language()
	{
		return $this->belongsTo(Language::class,'language_code');
	}
}
