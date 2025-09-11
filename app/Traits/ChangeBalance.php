<?php

namespace App\Traits;

Trait ChangeBalance{
    public function changeBalanceByType($balance, $data) {
        if($data['type'] === 'credit') {
            $balance->balance += $data['sum'];
        }elseif($data['type'] === 'debit'){
            $balance->balance -= $data['sum'];
        }
    }
}
