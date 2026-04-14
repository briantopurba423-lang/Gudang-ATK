<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
   public function index()
    {
        $supplier = Supplier::all();
        return view('supplier.index', compact('supplier'));
    }

    public function store(Request $request)
    {
        Supplier::create($request->all());
        return back();
    }

    public function update(Request $request, $id)
    {
        Supplier::findOrFail($id)->update($request->all());
        return back();
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return back();
    }
} 