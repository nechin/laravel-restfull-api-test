<?php

namespace App\Console\Commands;

use App\Services\DataImporter\DataImporter;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:run {limit=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import customers from a 3rd party data provider';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param DataImporter $importer
     */
    public function handle(DataImporter $importer)
    {
        $importer->run($this->argument('limit'));
    }
}
