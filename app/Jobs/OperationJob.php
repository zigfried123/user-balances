<?php

namespace App\Jobs;

use App\Models\Balance;
use App\Models\Operation;
use App\Models\User;
use App\Traits\ChangeBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class OperationJob implements ShouldQueue
{
    use Queueable, ChangeBalance;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->data;
        try {
            DB::transaction(function () use ($data) {
                $balance = Balance::find($this->data['balance_id']);

                $this->changeBalanceByType($balance, $data);

                $data['user_id'] = $balance->user->id;

                Operation::create($data);

                $balance->save();
            });
        } catch (\Throwable $e) {
            var_dump($e->getMessage());
        }

    }
}
