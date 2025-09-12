<?php

namespace App\Console\Commands;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Validation\ValidationException;

class AddBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-balance {user_id} {total} {currency}';

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
        $arguments = array_slice($this->arguments(), 1);

        if(Balance::where(['user_id'=>$arguments['user_id'],'currency'=>$arguments['currency']])->first()){
            throw ValidationException::withMessages(['user_id,email'=>'user_id and email not unique']);
        };

        $user = User::find($arguments['user_id']);
        $balance = new Balance(['total' => $arguments['total'], 'currency' => $arguments['currency']]);
        $user->balances()->save($balance);
    }
}
