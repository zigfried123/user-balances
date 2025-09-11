<?php

namespace App\Console\Commands;

use App\Models\Balance;
use App\Models\User;
use Illuminate\Console\Command;

class AddBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-balance {user_id} {balance}';

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
        $user = User::find($this->argument('user_id'));
        $balance = new Balance(['balance' => $this->argument('balance')]);
        $user->balance()->save($balance);
    }
}
