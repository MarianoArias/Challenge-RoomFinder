<?php

namespace App\Entity;

class Hotel
{
    private $name;

    private $stars;
 
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
     * Get the value of Stars
     *
     * @return int
     */
    public function getStars(): ?int
    {
        return $this->stars;
    }
 
    /**
     * Set the value of Stars
     *
     * @param int $stars
     *
     * @return self
     */
    public function setStars(?int $stars)
    {
        $this->stars = $stars;
        return $this;
    }
}
