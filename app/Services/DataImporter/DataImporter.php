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
        $results = $this->getResults();
        $this->importResults($results);
        return $this->message;
    }

    /**
     * @return array|string
     */
    private function getResults(): array
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
     * @param array $results
     */
    private function importResults(array $results): void
    {
        if (empty($results)) {
            return;
        }

        $fieldsMap = $this->dataProvider->getFieldsMap();

        foreach ($results as $result) {
            $insertData = [
                'firstName' => Arr::get($result, $fieldsMap['firstName']),
                'lastName' => Arr::get($result, $fieldsMap['lastName']),
                'email' => Arr::get($result, $fieldsMap['email']),
                'country' => Arr::get($result, $fieldsMap['country']),
                'username' => Arr::get($result, $fieldsMap['username']),
                'gender' => Arr::get($result, $fieldsMap['gender']),
                'city' => Arr::get($result, $fieldsMap['city']),
                'phone' => Arr::get($result, $fieldsMap['phone']),
            ];

            $this->repository->insertOrUpdateByEmail($insertData);
        }
    }
}
