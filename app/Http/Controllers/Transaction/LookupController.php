<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Libraries\Activity;

class LookupController extends Controller
{
    public function home()
    {
        return Activity::getActivityAndMakeView('pages.lookup', true);
    }
}
