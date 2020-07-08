<?php

namespace Siravel\Http\Controllers\Articles\Api;

use Siravel\Models\User;
use Siravel\Models\Tag;
use Siravel\Models\Category;
use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;

class ListingController extends Controller
{
    public function tags()
    {
        $tags = Tag::paginate(10);

        return $tags;
    }

    public function categories()
    {
        $categories = Category::paginate(10);

        return $categories;
    }

    public function users()
    {
        $users = User::paginate(10);

        return $users;
    }
}
