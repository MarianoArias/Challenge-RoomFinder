<?php

namespace App\Service\RoomAdvertiser;

use App\Service\Curl;

use App\Entity\Deal;
use App\Entity\Hotel;
use App\Entity\Room;
use App\Entity\Tax;

class Advertiser2 implements AdvertiserInterface
{
    const ADVERTISER_NAME = "Advertiser 2";
    
    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }
    
    public function findRooms(\Closure $addRoomToResultClousure)
    {
        $rooms = [];
        
        try {
            $result = $this->curl->get($_ENV['ADVERTISER_2_API'], null);
        } catch (HttpException $e) {
            throw new \Exception("Failed to fetch data from " . $_ENV['ADVERTISER_2_API'] . " (status code " . $e->getStatusCode() . ")");
        } catch (\Exception $e) {
            throw new \Exception("Failed to fetch data from " . $_ENV['ADVERTISER_2_API']);
        }
        
        foreach ($result->hotels as $hotel) {
            $hotelEntity = new Hotel();
            $hotelEntity->setName($hotel->name);
            $hotelEntity->setStars($hotel->stars);
            
            foreach ($hotel->rooms as $room) {
                $roomEntity = new Room();
                $roomEntity->setCode($room->code);
                $roomEntity->setName($room->name);
                
                $dealEntity = new Deal();
                $dealEntity->setAdvertiser(self::ADVERTISER_NAME);
                $dealEntity->setNetRate($room->net_rate);
                
                foreach ($room->taxes as $tax) {
                    $taxEntity = new Tax();
                    $taxEntity->setAmount($tax->amount);
                    $taxEntity->setCurrency($tax->currency);
                    $taxEntity->setType($tax->type);
                    $dealEntity->addTax($taxEntity);
                }
                
                $roomEntity->addDeal($dealEntity);
                $roomEntity->setHotel($hotelEntity);
                
                $addRoomToResultClousure($roomEntity);
            }
        }
    }
}
