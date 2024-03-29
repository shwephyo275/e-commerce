<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::orderBy('id', 'desc')->paginate(10);
        return view('admin.supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            "phone" => 'required',
            "address" => "required"
        ], [
            'name.required' => 'supplier အမည်ဖြည့်ပေးပါ'
        ]);

        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Supplier::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Data Not found');
        }
        return view('admin.supplier.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Supplier::where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deleted');
    }
}
