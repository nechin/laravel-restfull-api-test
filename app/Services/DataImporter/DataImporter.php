<?php

namespace App\Services\DataImporter;

use App\Repositories\Contracts\BaseRepository;
use App\Services\DataImporter\Contracts\Importer;
use App\Services\DataProvider\BaseProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class DataImporter implements Importer
{
    private $count;
    private $dataProvider;
    private $repository;
    private $message;

    /**
     * DataImporter constructor.
     * @param BaseProvider $dataProvider
     * @param BaseRepository $repository
     */
    public function __construct(BaseProvider $dataProvider, BaseRepository $repository)
    {
        $this->dataProvider = $dataProvider;
        $this->repository = $repository;
    }

    /**
     * @param string $count
     */
    public function setCount(string $count): void
    {
        $this->count = $count ?: 100;
    }

    /**
     * @return string
     */
    public function run(): string
    {
        $data = $this->getDataFromProvider();
        $this->importData($data);
        return $this->message;
    }

    /**
     * @return array
     */
    private function getDataFromProvider(): array
    {
        $uri = $this->dataProvider->getProviderUri($this->count);
        $response = Http::get($uri);
        if ($response->failed()) {
            $this->message = $response->body() . ' - Status [' . $response->status() . ']';
            return [];
        }

        $responseData = $response->json();
        if (!isset($responseData['results'])) {
            $this->message = 'Key "results" not found in response';
            return [];
        }

        $results = $responseData['results'];
        $this->message = 'Processed records: ' . count($results);
        return $results;
    }

    /**
     * @param array $dataList
     */
    private function importData(array $dataList): void
    {
        if (empty($dataList)) {
            return;
        }

        $fieldsMap = $this->dataProvider->getFieldsMap();

        foreach ($dataList as $data) {
            $insertData = [
                'firstName' => Arr::get($data, $fieldsMap['firstName']),
                'lastName' => Arr::get($data, $fieldsMap['lastName']),
                'email' => Arr::get($data, $fieldsMap['email']),
                'country' => Arr::get($data, $fieldsMap['country']),
                'username' => Arr::get($data, $fieldsMap['username']),
                'gender' => Arr::get($data, $fieldsMap['gender']),
                'city' => Arr::get($data, $fieldsMap['city']),
                'phone' => Arr::get($data, $fieldsMap['phone']),
            ];

            if ($this->isAvailableData($insertData)) {
                $this->repository->insertOrUpdateByEmail($insertData);
            }
        }
    }

    /**
     * Check that filtered values not in $data array
     *
     * @param array $data
     * @return bool
     */
    private function isAvailableData(array $data): bool
    {
        $filters = $this->dataProvider->getFilters();
        if (empty($filters)) {
            return true;
        }

        return count($filters) === count(array_diff_assoc($filters, $data));
    }
}
