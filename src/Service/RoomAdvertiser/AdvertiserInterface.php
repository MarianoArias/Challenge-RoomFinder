<?php

namespace App\Service\RoomAdvertiser;

use App\Service\Curl;

interface AdvertiserInterface
{
    public function __construct(Curl $curl);
    public function findRooms(\Closure $addRoomToResultClousure);
}
