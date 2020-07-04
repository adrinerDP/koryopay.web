<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;

class PayController extends Controller
{
    use TransactionTrait;
    public function __construct()
    {
        $this->view = 'pages.pay';
        $this->type = 2;
        $this->message = '결제 완료';
    }
}
