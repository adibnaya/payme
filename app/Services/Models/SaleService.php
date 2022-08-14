<?php

namespace App\Services\Models;

use App\Exceptions\ActionFailedException;
use App\Models\Sale;
use DB;
use Exception;

class SaleService extends Service
{

    /**
     * Create sale
     *
     * @param $data
     * @param $response
     * @return Sale
     * @throws ActionFailedException
     */
    public function create($data, $response): Sale
    {
        try {
            DB::beginTransaction();

            /** @var  Sale */
            $sale = new Sale();
            $sale->sale_number = $response->payme_sale_code;
            $sale->description = $data['description'];
            $sale->amount = $data['amount'];
            $sale->currency = $data['currency'];
            $sale->payment_link = $response->sale_url;

            $sale->save();

            DB::commit();
        } catch (Exception $exception) {
            $this->handleException($exception);
        }

        return $sale;
    }
}
