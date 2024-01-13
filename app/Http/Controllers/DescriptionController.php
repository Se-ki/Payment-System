<?php

namespace App\Http\Controllers;

use App\Http\Requests\DescriptionRequest;
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
    public function store(DescriptionRequest $request, Description $description): RedirectResponse
    {
        $description->createDescription($request);
        return back()->with('success', 'Added!');
    }

    public function edit($id): View
    {
        return view('description.show', ['description' => Description::find($id)]);
    }

    public function update(int $id, Description $description, DescriptionRequest $request): RedirectResponse
    {
        $description->updateDescription($id, $request);
        return back()->with('success', 'Updated!');
    }
    public function destroy(int $id, Description $description)
    {
        $description->deleteDescription($id);
        return back()->with('success', 'Deleted!');
    }
}
