<?php

namespace App\Entity;

class Room
{
    private $hotel;

    private $code;

    private $name;

    private $deals;
    
    /**
     * Get the value of Hotel
     *
     * @return float
     */
    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }
 
    /**
     * Set the value of Hotel
     *
     * @param Hotel $hotel
     *
     * @return self
     */
    public function setHotel(?Hotel $hotel)
    {
        $this->hotel = $hotel;
        return $this;
    }

    /**
     * Get the value of Code
     *
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }
 
    /**
     * Set the value of Code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode(?string $code)
    {
        $this->code = $code;
        return $this;
    }
 
    /**
     * Get the value of Name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
 
    /**
     * Set the value of Name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }
 
    /**
     * Get the value of Deals
     *
     * @return array
     */
    public function getDeals(): ?array
    {
        return $this->deals;
    }
 
    /**
     * Set the value of Deals
     *
     * @param float $deals
     *
     * @return self
     */
    public function addDeal(?Deal $deal)
    {
        $this->deals[] = $deal;
        return $this;
    }
    
    /**
     * Get the value of Cheapest Deal
     *
     * @return float
     */
    public function getCheapestDeal(): ?Deal
    {
        usort($this->deals, function ($a, $b) {
            return $a->getTotal() > $b->getTotal();
        });
        
        return $this->deals[0];
    }
    
    /**
     * Get the value of Cheapest Deal
     *
     * @return float
     */
    public function getOtherDeals(): ?array
    {
        usort($this->deals, function ($a, $b) {
            return $a->getTotal() > $b->getTotal();
        });
        
        return array_slice($this->deals, 1);
    }
}
