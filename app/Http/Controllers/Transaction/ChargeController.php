<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;

class ChargeController extends Controller
{
    use TransactionTrait;
    public function __construct()
    {
        $this->view = 'pages.charge';
        $this->type = 1;
        $this->message = '충전 완료';
    }
}
