<?php

namespace SiObjects\Manipule\Managers\Location;

use App\Models\Location;
use SiObjects\Support\Contracts\LocationManager;
use SiObjects\Manipule\Entities\LocationEntity;
use Informate\ValueObjects\Coordinates;
use Informate\ValueObjects\Latitude;
use Informate\ValueObjects\Longitude;
use Illuminate\Database\ConnectionInterface as Database;

/**
 * Class ARLocationManager.
 *
 * @package SiObject\Manipule\Managers\Location
 */
class ARLocationManager implements LocationManager
{
    /**
     * @var Database
     */
    private $database;

    /**
     * @var LocationValidator
     */
    private $validator;

    /**
     * ARLocationManager constructor.
     *
     * @param Database $database
     * @param LocationValidator $validator
     */
    public function __construct(Database $database, LocationValidator $validator)
    {
        $this->database = $database;
        $this->validator = $validator;
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes): LocationEntity
    {
        $attributes = $this->validator->validateForCreate($attributes);

        $coordinates = new Coordinates(new Latitude($attributes['latitude']), new Longitude($attributes['longitude']));

        $location = (new Location)->fill(['coordinates' => $coordinates]);

        $location->save();

        return $location->toEntity();
    }
}
