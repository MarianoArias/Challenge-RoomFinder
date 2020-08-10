<?php

namespace App\Tests\Controller;

use Symfony\Component\HttpFoundation\Response;

class RoomControllerTest extends TestConfiguration
{
    const PATH = "/rooms/";
    
    public function testGetAction()
    {
        $this->client->request('GET', self::PATH);
        
        $content = $this->getClientContent();
        $statusCode = $this->getClientStatusCode();

        $this->assertEquals(Response::HTTP_OK, $statusCode);
        $this->assertNotEmpty($content);
    }
    
    public function testListIsOrderedFromCheapestToMostExpensive()
    {
        $this->client->request('GET', self::PATH);
        
        $content = $this->getClientContent();
        
        $previousTotal = 0;
        foreach ($content as $room) {
            $this->assertGreaterThanOrEqual($previousTotal, $room->cheapestDeal->total);
            $previousTotal = $room->cheapestDeal->total;
        }
    }
    
    public function testOtherDealsAreMoreExpensiveThanCheapestDeal()
    {
        $this->client->request('GET', self::PATH);
        
        $content = $this->getClientContent();

        foreach ($content as $room) {
            foreach ($room->otherDeals as $otherDeal) {
                $this->assertGreaterThanOrEqual($room->cheapestDeal->total, $otherDeal->total);
            }
        }
    }
    
    public function testOtherDealsAreOrderedFromCheapestToMostExpensive()
    {
        $this->client->request('GET', self::PATH);
        
        $content = $this->getClientContent();

        foreach ($content as $room) {
            $previousTotal = 0;
            foreach ($room->otherDeals as $otherDeal) {
                $this->assertGreaterThanOrEqual($previousTotal, $otherDeal->total);
                $previousTotal = $otherDeal->total;
            }
        }
    }
}
