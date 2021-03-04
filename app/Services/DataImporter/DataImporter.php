<?php

namespace App\Services\DataImporter;

use App\Services\DataImporter\Contracts\Importer;
use App\Services\DataProvider\BaseProvider;
use Illuminate\Support\Facades\Http;

class DataImporter implements Importer
{
    private BaseProvider $dataProvider;

    /**
     * DataImporter constructor.
     * @param BaseProvider $dataProvider
     */
    public function __construct(BaseProvider $dataProvider)
    {
        $this->dataProvider = $dataProvider;
    }

    /**
     * @param int $limit
     */
    public function run(int $limit): void
    {
        $uri = $this->dataProvider->getProviderUri(2);
        $response = Http::get($uri);

        file_put_contents("c://log.log", "\n response \n" . print_r($response, true), FILE_APPEND);

    }
}
