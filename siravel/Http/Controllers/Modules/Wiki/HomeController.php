<?php

namespace Siravel\Http\Controllers\Modules\Wiki;

class HomeController extends Controller
{
	/**
	 * Show home page.
	 * If the user is already logged in, show categories, otherwise show README.
	 *
	 * @return Response
	 */
	public function showHomePage()
	{
		if(auth()->check()) {
			return redirect(route('category.index'));
        }
        
		$readme = markup(\File::get(base_path('readme.md')));

		return view('wiki.home')->withTitle(_('Home'))->withContent($readme);
	}

	/**
	 * Change the application language.
	 *
	 * @param  string
	 * @return Response
	 */
	public function changeApplicationLanguage($code)
	{
		if($language = \Siravel\Models\System\Language::whereCode($code)->first())
			event('language.change', $language);

		return redirect(\URL::previous() ?: route('home'));
	}
}
