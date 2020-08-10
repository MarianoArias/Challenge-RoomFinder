<?php

namespace App\Mapper;

use App\Entity\Tax;

class TaxMapper
{
    public function toArray(Tax $tax): array
    {
        return [
            'amount' => $tax->getAmount(),
            'currency' => $tax->getCurrency(),
            'type' => $tax->getType(),
        ];
    }
    
    public function toArrayCollection($taxes): array
    {
        $taxesArray = [];
        
        foreach ($taxes as $tax) {
            $taxesArray[] = $this->toArray($tax);
        }
        
        return $taxesArray;
    }
}
