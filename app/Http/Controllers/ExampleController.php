<?php

namespace App\Http\Controllers;

use App\Integrations\Payment\Client;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index(Request $request)
    {
        $placetopay = new Client();
        $randomInt = random_int(0, 10000);
        dd($placetopay->queryByRequestId($randomInt));
    }
}
