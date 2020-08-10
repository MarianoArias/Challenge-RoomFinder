<?php

namespace App\Mapper;

use App\Entity\Hotel;

class HotelMapper
{
    public function toArray(Hotel $hotel): array
    {
        return [
            'name' => $hotel->getName(),
            'stars' => $hotel->getStars(),
        ];
    }
    
    public function toArrayCollection($hotels): array
    {
        $hotelsArray = [];
        
        foreach ($hotels as $hotel) {
            $hotelsArray[] = $this->toArray($hotel);
        }
        
        return $hotelsArray;
    }
}
