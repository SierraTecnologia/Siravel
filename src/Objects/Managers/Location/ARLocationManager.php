<?php

namespace App\Managers\Location;

use App\Models\Location;
use App\Features\Photos\Contracts\LocationManager;
use App\Features\Photos\Entities\LocationEntity;
use App\Features\Photos\ValueObjects\Coordinates;
use App\Features\Photos\ValueObjects\Latitude;
use App\Features\Photos\ValueObjects\Longitude;
use Illuminate\Database\ConnectionInterface as Database;

/**
 * Class ARLocationManager.
 *
 * @package App\Managers\Location
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
