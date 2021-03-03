<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Transformers\CustomerTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    private $customers;

    /**
     * CustomerController constructor.
     * @param $customers
     */
    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
    }

    public function all(): JsonResponse
    {
        $customers = $this->customers->findAll();
        $transformer = new CustomerTransformer();
        return response()->json(
            $transformer->transformAll($customers)
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function get(Request $request): JsonResponse
    {
        $this->validate($request, [
            'customerId' => 'required|integer'
        ]);

        $customer = $this->customers->find($request->get('customerId'));
        $transformer = new CustomerTransformer();
        return response()->json(
            $transformer->transform($customer)
        );
    }
}
