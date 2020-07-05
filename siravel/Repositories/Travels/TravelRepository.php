<?php

namespace Siravel\Repositories\Travels;

use Carbon\Carbon;
use Siravel\Models\Calendar\Travel;
use Siravel\Repositories\CmsRepository;
use RicardoSierra\Translation\Repositories\ModelTranslationRepository;

class TravelRepository extends CmsRepository
{
    public $model;

    public $translationRepo;

    public $table;

    public function __construct(Travel $model, TranslationRepository $translationRepo)
    {
        $this->model = $model;
        $this->translationRepo = $translationRepo;
        $this->table = \Illuminate\Support\Facades\Config::get('cms.db-prefix').'travels';
    }

    /**
     * Returns all published Travels.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findTravelsByDate($date)
    {
        return $this->model->where('is_published', 1)
            ->where('published_at', '<=', Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s'))
            ->orderBy('created_at', 'desc')->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date)->get();
    }

    /**
     * Stores Travel into database.
     *
     * @param array $payload
     *
     * @return Travel
     */
    public function store($payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
        $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

        return $this->model->create($payload);
    }

    /**
     * Updates Travel into database.
     *
     * @param Travel $travel
     * @param array  $input
     *
     * @return Travel
     */
    public function update($travel, $payload)
    {
        $payload['title'] = htmlentities($payload['title']);
        if (!empty($payload['lang']) && $payload['lang'] !== \Illuminate\Support\Facades\Config::get('cms.default-language', 'en')) {
            return $this->translationRepo->createOrUpdate($travel->id, 'Siravel\Models\Calendar\Travel', $payload['lang'], $payload);
        } else {
            $payload['is_published'] = (isset($payload['is_published'])) ? (bool) $payload['is_published'] : 0;
            $payload['published_at'] = (isset($payload['published_at']) && !empty($payload['published_at'])) ? Carbon::parse($payload['published_at'])->format('Y-m-d H:i:s') : Carbon::now(\Illuminate\Support\Facades\Config::get('app.timezone'))->format('Y-m-d H:i:s');

            unset($payload['lang']);

            return $travel->update($payload);
        }
    }
}
