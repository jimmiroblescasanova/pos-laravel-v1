<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('settings.groups', [
            'groups' => Group::pluck('name', 'id'),
        ]);
    }
}
