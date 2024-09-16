<?php

namespace App\Http\Controllers;

use App\Models\RefSupplier;
use Illuminate\Http\Request;

class RefSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supp = RefSupplier::all();
        $menuActiveSupplier = 'active';
        // dd(DB::getQueryLog());

        return view('pages.supplier.supplierIndex', compact('supp', 'menuActiveSupplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuActiveSupplier = 'active';

        return view('pages.supplier.supplierCreate', compact('menuActiveSupplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_supplier' => 'required|string|max:250',
                'alamat' => 'required|string|max:250|',
                'telepon' => 'required|string|max:25|',
            ]);
            //  insert to database
            RefSupplier::create([
                'nama_supplier' => $request->nama_supplier,
                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
            ]);

            return redirect()->back()->with([
                'success' => 'Master supplier berhasil ditambahkan',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'failed' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = RefSupplier::find($id);
        $menuActiveSupplier = 'active';

        return view('pages.supplier.supplierEdit', compact('edit', 'menuActiveSupplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'nama_supplier' => 'required',
                'alamat' => 'required',
                'telepon' => 'required',
            ]);

            $supp = RefSupplier::find($id);
            $supp->nama_supplier = $request->nama_supplier;
            $supp->alamat = $request->alamat;
            $supp->telepon = $request->telepon;

            // update supplier
            $supp->update();

            return redirect()->route('ref-supplier.index')->with(['success' => 'Master supplier berhasil diperbarui']);
        } catch (\Exception $e) {
            return redirect()->route('ref-supplier.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $supp = RefSupplier::find($id);

            // delete supplier from db
            if ($supp) {
                $supp->delete();

                return redirect()->back()->with(['success' => 'Master supplier berhasil dihapus']);
            } else {
                return redirect()->back()->with(['failed' => 'Master supplier not found']);
            }
        } catch (\Exception $e) {
            return redirect()->route('ref-supplier.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
