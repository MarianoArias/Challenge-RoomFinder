<?php

namespace App\Entity;

class Tax
{
    private $amount;

    private $currency;

    private $type;

    /**
     * Get the value of Amount
     *
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }
 
    /**
     * Set the value of Amount
     *
     * @param float $amount
     *
     * @return self
     */
    public function setAmount(?float $amount)
    {
        $this->amount = $amount;
        return $this;
    }
 
    /**
     * Get the value of Currency
     *
     * @return string
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }
 
    /**
     * Set the value of Currency
     *
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency(?string $currency)
    {
        $this->currency = $currency;
        return $this;
    }
 
    /**
     * Get the value of Type
     *
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }
 
    /**
     * Set the value of Type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(?string $type)
    {
        $this->type = $type;
        return $this;
    }
}
