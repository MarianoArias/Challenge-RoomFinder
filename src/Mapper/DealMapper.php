<?php

namespace App\Mapper;

use App\Entity\Deal;

class DealMapper
{
    public function __construct(TaxMapper $taxMapper)
    {
        $this->taxMapper = $taxMapper;
    }
    
    public function toArray(Deal $deal): array
    {
        return [
            'advertiser' => $deal->getAdvertiser(),
            'net_rate' => $deal->getNetRate(),
            'taxes' => $this->taxMapper->toArrayCollection($deal->getTaxes()),
            'total' => $deal->getTotal(),
        ];
    }
    
    public function toArrayCollection($deals): array
    {
        $dealsArray = [];
        
        foreach ($deals as $deal) {
            $dealsArray[] = $this->toArray($deal);
        }
        
        return $dealsArray;
    }
}
