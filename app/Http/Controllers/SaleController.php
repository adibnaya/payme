<?php

namespace App\Http\Controllers;

use App\Exceptions\ActionFailedException;
use App\Http\Requests\Save;
use App\Http\Resources\Sale\SaleCollection;
use App\Models\Sale;
use App\Services\Models\SaleService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class SaleController extends Controller
{

    private $saleService;

    /**
     * SaleController constructor.
     *
     * @param SaleService $saleService
     */
    public function __construct(SaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function list()
    {
        $sales = Sale::paginate(20);

        return view('sale.index', compact('sales'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return SaleCollection
     * @throws AuthorizationException
     */
    public function index(): SaleCollection
    {
        return new SaleCollection(Sale::paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $currencies = Sale::getCurrencies();
        return view('sale.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Save $request
     * @return Application|RedirectResponse|Redirector
     * @throws ActionFailedException
     */
    public function store(Save $request)
    {
        $data = $request->validated();

        $payme_request = Http::withOptions([
            'verify' => false,
        ])->post('https://preprod.paymeservice.com/api/generate-sale', [
            "seller_payme_id" => env('SELLER_PAYMENT_ID'),
            "sale_price" => $data['amount'],
            "currency" => $data['currency'],
            "product_name" => $data['description'],
            "installments" => "1",
            "language" => "en",
        ]);
        if ($payme_request->status() != 200) {
            $res = json_decode($payme_request->body());
            $message = "";
            switch ($res->status_error_details) {
                case "Number must be an integer":
                case "Invalid price, out of min-max bounds":
                    $message = "Amount is wrong";
                    break;
                case "Invalid description":
                    $message = "description is wrong";
                    break;
            }
            $currencies = Sale::getCurrencies();
            echo $message;
            return view('sale.create', compact('currencies'));
        }

        $this->saleService->create($data, json_decode($payme_request->body()));

        return redirect(route('sale.list'));
    }
}
