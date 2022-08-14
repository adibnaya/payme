<?php

namespace App\Http\Resources\Sale;

use App\Http\Resources\Resource;
use Illuminate\Http\Request;

class SaleResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'sale_number' => $this->sale_number,
            'description' => $this->description,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'payment_link' => $this->payment_link,
        ];

        return $data;
    }
}
