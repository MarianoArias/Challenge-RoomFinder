<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Mapper\RoomMapper;

use App\Service\RedisCache;
use App\Service\RoomFinder;

/**
 * @Route(path="/rooms")
 */
class RoomController extends AbstractController
{
    public function __construct(RedisCache $redisCache, RoomMapper $roomMapper, RoomFinder $roomFinder)
    {
        $this->redisCache = $redisCache;
        $this->roomMapper = $roomMapper;
        $this->roomFinder = $roomFinder;
    }
    
    /**
     * @Route("/", name="customer_get", methods={"GET"})
     */
    public function getAction(Request $request): JsonResponse
    {
        $rooms = $this->redisCache->getObject("rooms");
        
        if (!$rooms) {
            $rooms = $this->roomFinder->findRooms();
            $rooms = $this->roomMapper->toArrayCollection($rooms);
            $this->redisCache->setObject("rooms", $rooms, RedisCache::TTL_TEN_MINUTES);
        }

        return new JsonResponse($rooms, Response::HTTP_OK);
    }
}
