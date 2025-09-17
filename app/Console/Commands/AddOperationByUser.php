<?php

namespace App\Console\Commands;

use App\Models\Balance;
use App\Models\Operation;
use App\Services\OperationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddOperationByUser extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-operation-by-user {user_id} {currency} {type} {sum}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Operation $operation)
    {
        $data = array_slice($this->arguments(), 1);

        try {
            DB::transaction(function () use ($data, $operation) {
                $balance = Balance::where(['user_id' => $data['user_id'], 'currency' => $data['currency']])->first();

                $data['balance_id'] = $balance->id;

                (new OperationService)->changeBalanceByType($balance, $data);

                $operation->create($data);

                $balance->save();

            });
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
        }
    }
}
