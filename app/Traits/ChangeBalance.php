<?php

namespace App\Traits;

use Exception;

Trait ChangeBalance{
    public function changeBalanceByType($balance, $data) {
        if($data['type'] === 'credit') {
            $balance->total += $data['sum'];
        }elseif($data['type'] === 'debit' && $balance->total >= $data['sum']){
            $balance->total -= $data['sum'];
        }else {
            throw new Exception('Баланса недостаточно');
        }
    }
}
