<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        return view('settings.groups', [
            'groups' => Group::orderBy('name')->pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:3', 'unique:groups,name' ],
        ]);

        $group = Group::create($data);

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addSuccess('Grupo: ' . $group->name . ' creado.');

        return redirect()->route('settings.groups.index');
    }

    public function destroy(Request $request)
    {
        $group = Group::findOrFail($request->id);

        $group->delete();

        notyf()
            ->ripple(true)
            ->duration(2000)
            ->addInfo('Grupo eliminado.');

        return redirect()->route('settings.groups.index');
    }
}
