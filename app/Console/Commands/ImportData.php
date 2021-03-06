<?php

namespace App\Console\Commands;

use App\Services\DataImporter\Contracts\Importer;
use Illuminate\Console\Command;

class ImportData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:run {count=100}';

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
     * @param Importer $importer
     */
    public function handle(Importer $importer)
    {
        $importer->setCount($this->argument('count'));
        echo $importer->run();
    }
}
