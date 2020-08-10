<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\Tools\SchemaTool;

class TestConfiguration extends WebTestCase
{
    protected static $inited = false;
    
    protected function setUp(): void
    {
        $this->client = static::createClient();
    }
        
    protected function getClientStatusCode()
    {
        return $this->client->getResponse()->getStatusCode();
    }
        
    protected function getClientContent()
    {
        return json_decode($this->client->getResponse()->getContent());
    }
        
    protected function getClientHeader($headerName)
    {
        return $this->client->getResponse()->headers->all()[$headerName][0];
    }
}
