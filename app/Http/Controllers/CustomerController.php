<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use App\Transformers\CustomerTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private CustomerRepository $customers;
    private CustomerTransformer $transformer;

    /**
     * CustomerController constructor.
     * @param $customers
     */
    public function __construct(CustomerRepository $customers)
    {
        $this->customers = $customers;
        $this->transformer = new CustomerTransformer();
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $customers = $this->customers->findAll();
        return response()->json(
            $this->transformer->transformAll($customers)
        );
    }

    /**
     * @param Request $request
     * @param mixed $customerId
     * @return JsonResponse
     */
    public function get(Request $request, $customerId): JsonResponse
    {
        if (empty($customerId) || !is_numeric($customerId)) {
            return response()->json(
                ['error' => 'Wrong customerId'], 400
            );
        }

        $customer = $this->customers->find($request->get('customerId'));
        return response()->json(
            $this->transformer->transform($customer)
        );
    }
}
