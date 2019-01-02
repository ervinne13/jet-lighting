<?php

namespace App\Console\Commands;

use App\Imports\ItemsImport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Excel;

class ImportItemsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:items';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports items at a set location and file name. Please put the import file at the storage path with name items-import.xlsx';

    /**
     * @var Excel
     */
    private $excel;

    public function __construct(Excel $excel)
    {
        parent::__construct();
        $this->excel = $excel;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->excel->import(app(ItemsImport::class), 'items-import.xlsx');
    }
}
