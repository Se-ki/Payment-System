<?php

namespace App\Http\Controllers;

use App\Models\Description;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DescriptionController extends Controller
{
    public function index(): View
    {
        $descriptions = Description::all();
        return view('description.index', compact('descriptions'));
    }
    public function store(Request $request): RedirectResponse
    {
        if ($request->status !== 1 && $request->status !== 2) {
        }
        Description::create([
            'name' => ucwords($request->name),
            'status' => $request->status,
        ]);
        return redirect(route('description.index'));
    }

    public function edit($id): View
    {
        return view('description.show', ['description' => Description::find($id)]);
    }

    public function update(int $id, Request $request): RedirectResponse
    {
        Description::find($id)->update([
            'name' => ucwords($request->name),
            'status' => $request->status,
        ]);
        return redirect(route('description.index'));
    }
}
