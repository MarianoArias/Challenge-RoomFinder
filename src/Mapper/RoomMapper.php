<?php

namespace App\Mapper;

use App\Entity\Room;

class RoomMapper
{
    public function __construct(DealMapper $dealMapper, HotelMapper $hotelMapper)
    {
        $this->dealMapper = $dealMapper;
        $this->hotelMapper = $hotelMapper;
    }
    
    public function toArray(Room $room): array
    {
        return [
            'hotel' => $this->hotelMapper->toArray($room->getHotel()),
            'code' => $room->getCode(),
            'name' => $room->getName(),
            'cheapestDeal' => $this->dealMapper->toArray($room->getCheapestDeal()),
            'otherDeals' => $this->dealMapper->toArrayCollection($room->getOtherDeals()),
        ];
    }
    
    public function toArrayCollection($rooms): array
    {
        $roomsArray = [];
        
        foreach ($rooms as $room) {
            $roomsArray[] = $this->toArray($room);
        }
        
        return $roomsArray;
    }
}
