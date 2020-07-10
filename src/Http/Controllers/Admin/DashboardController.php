<?php

namespace Siravel\Http\Controllers\Admin;

use Tracking\Services\AnalyticsService;
use Illuminate\Support\Facades\Schema;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;
use Siravel\Models\Blog\Blog;
use Stalker\Models\Photo;
use Siravel\Models\Negocios\Subscription;
use Siravel\Models\Negocios\Page;
use Facilitador\Models\UserMeta;

class DashboardController extends Controller
{
    protected $service;

    public function __construct(AnalyticsService $service)
    {
        parent::__construct();

        $this->service = $service;
    }
    
    /**
     * Dashboard
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
	{
        $title = "Home";

        $blogs = Blog::count();
        $pages = Page::count();
        $members = UserMeta::count();
        // $subscriptions = Subscription::count();
        $photos = Photo::count();

		return view(
            'admin.dashboard.home', 
            compact(
                'title',
                'articles',
                'pages',
                'photos',
                'members',
                // 'subscriptions'
            )
        );
	}

    public function analytics()
    {
        if (!is_null(config('analytics.view_id')) && config('cms.analytics') == 'google') {
            $period = Period::days(7);

            foreach (app(Analytics::class)->fetchVisitorsAndPageViews($period) as $view) {
                $visitStats['date'][] = $view['date']->format('Y-m-d');
                $visitStats['visitors'][] = $view['visitors'];
                $visitStats['pageViews'][] = $view['pageViews'];
            }

            return view('admin.dashboard.analytics-google', compact('visitStats', 'period'));
        } elseif (is_null(config('cms.analytics')) || config('cms.analytics') == 'internal') {
            if (Schema::hasTable(config('cms.db-prefix', '').'analytics')) {
                return view('admin.dashboard.analytics-internal')
                    ->with('stats', $this->service->getDays(15))
                    ->with('topReferers', $this->service->topReferers(15))
                    ->with('topBrowsers', $this->service->topBrowsers(15))
                    ->with('topPages', $this->service->topPages(15));
            }
        }

        return view('admin.dashboard.empty');
    }
}
