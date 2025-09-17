<?php

namespace App\Services;

use App\Models\Balance;
use Exception;

class OperationService
{
    /**
     * @param Balance $balance
     * @param array $data Содержит тип операции и сумму
     * @return void
     * @throws Exception
     */
    public function changeBalanceByType(Balance $balance, array $data) {
        if($data['type'] === 'credit') {
            $balance->total += $data['sum'];
        }elseif($data['type'] === 'debit' && $balance->total >= $data['sum']){
            $balance->total -= $data['sum'];
        }else {
            throw new Exception('Баланса недостаточно');
        }
    }
}
