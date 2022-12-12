<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    /**
     * Devuelve la vista de los accesos
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view('access.index');
    }
}
