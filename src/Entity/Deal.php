<?php

namespace App\Entity;

class Deal
{
    private $advertiser;

    private $netRate;

    private $taxes;
 
    /**
     * Get the value of Advertiser
     *
     * @return string
     */
    public function getAdvertiser(): ?string
    {
        return $this->advertiser;
    }
 
    /**
     * Set the value of Advertiser
     *
     * @param string $advertiser
     *
     * @return self
     */
    public function setAdvertiser(?string $advertiser)
    {
        $this->advertiser = $advertiser;
        return $this;
    }
    
    /**
     * Get the value of Net Rate
     *
     * @return float
     */
    public function getNetRate(): ?float
    {
        return $this->netRate;
    }
 
    /**
     * Set the value of Net Rate
     *
     * @param float $netRate
     *
     * @return float
     */
    public function setNetRate(?float $netRate)
    {
        $this->netRate = $netRate;
        return $this;
    }
 
    /**
     * Get the value of Taxes
     *
     * @return array
     */
    public function getTaxes(): ?array
    {
        return $this->taxes;
    }
 
    /**
     * Set the value of Taxes
     *
     * @param float $taxes
     *
     * @return self
     */
    public function addTax(?Tax $tax)
    {
        $this->taxes[] = $tax;
        return $this;
    }
    
    /**
     * Get the value of Taxes
     *
     * @return float
     */
    public function getTotal(): ?float
    {
        $total = $this->getNetRate();
        
        foreach ($this->getTaxes() as $tax) {
            $total += $tax->getAmount();
        }
        
        return $total;
    }
}
