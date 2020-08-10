<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

use App\Entity\Room;

use App\Service\RoomAdvertiser\Advertiser1;
use App\Service\RoomAdvertiser\Advertiser2;

class RoomFinder
{
    public function __construct(Advertiser1 $advertiser1, Advertiser2 $advertiser2, LoggerInterface $logger)
    {
        $this->advertisers = [
            $advertiser1,
            $advertiser2
        ];
        $this->logger = $logger;
    }
    
    public function findRooms()
    {
        $resultRooms = [];
        
        foreach ($this->advertisers as $advertiser) {
            try {
                $advertiser->findRooms(function ($advertiserRoom) use (&$resultRooms) {
                    $foundRoom = current(array_filter(
                        $resultRooms,
                        function ($e) use ($advertiserRoom) {
                            return $e->getCode() == $advertiserRoom->getCode();
                        }
                    ));
                    
                    if (!$foundRoom) {
                        $resultRooms[] = $advertiserRoom;
                    } else {
                        $this->completeRoomData($foundRoom, $advertiserRoom);
                    }
                });
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
        
        usort($resultRooms, function ($a, $b) {
            return $a->getCheapestDeal()->getTotal() > $b->getCheapestDeal()->getTotal();
        });
        
        return $resultRooms;
    }
    
    private function completeRoomData($foundRoom, $advertiserRoom)
    {
        $foundRoom->setName($foundRoom->getName() ? : $advertiserRoom->getName());
        $foundRoom->addDeal($advertiserRoom->getDeals()[0]);
        $foundRoom->getHotel()->setName($foundRoom->getHotel()->getName() ? : $advertiserRoom->getHotel()->getName());
        $foundRoom->getHotel()->setStars($foundRoom->getHotel()->getStars() ? : $advertiserRoom->getHotel()->getStars());
    }
}
