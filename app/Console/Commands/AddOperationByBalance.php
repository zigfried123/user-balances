<?php

namespace App\Console\Commands;

use App\Jobs\OperationJob;
use Illuminate\Console\Command;

class AddOperationByBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-operation-by-balance {balance_id} {type} {sum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OperationJob::dispatch(array_slice($this->arguments(),1));

    }
}
