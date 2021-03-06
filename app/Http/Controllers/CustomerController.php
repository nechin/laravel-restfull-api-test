<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\BaseRepository;
use App\Transformers\CustomerTransformer;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    private $repository;
    private $transformer;

    /**
     * CustomerController constructor.
     * @param BaseRepository $customers
     */
    public function __construct(BaseRepository $customers)
    {
        $this->repository = $customers;
        $this->transformer = new CustomerTransformer();
    }

    /**
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $customers = $this->repository->findAll();
        return response()->json(
            $this->transformer->transformAll($customers)
        );
    }

    /**
     * @param mixed $customerId
     * @return JsonResponse
     */
    public function get($customerId): JsonResponse
    {
        if (empty($customerId) || !is_numeric($customerId)) {
            return response()->json(
                ['error' => 'Wrong customerId'], 400
            );
        }

        $customer = $this->repository->find($customerId);
        return response()->json(
            $this->transformer->transform($customer)
        );
    }
}
