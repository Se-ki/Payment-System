<?php

namespace App\Http\Controllers;

use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller {
    public function index() {
        return view('description.index', ['descriptions' => Description::all()]);
    }
    public function store(Request $request) {
        Description::create($request->all());
        return redirect('payments/description');
    }

    public function edit($id) {
        return view('description.show', ['description' => Description::find($id)]);
    }

    public function update($id, Request $request) {
        Description::find($id)->update($request->all());
        return redirect('payments/description');
    }
}
