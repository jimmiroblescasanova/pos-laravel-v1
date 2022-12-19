<?php

namespace App\Http\Controllers\Settings;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(): View
    {
        return view('settings.business');
    }
}
