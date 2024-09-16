<?php

namespace App\Http\Controllers;

use App\Models\RefMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RefMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = RefMaterial::all();
        $menuActiveMaterial = 'active';
        // dd(DB::getQueryLog());

        return view('pages.material.materialsIndex', compact('materials', 'menuActiveMaterial'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuActiveMaterial = 'active';

        return view('pages.material.materialsCreate', compact('menuActiveMaterial'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'material' => 'required|string|max:250',
                'kode' => 'required|string|max:100|unique:ref_material,kode',
            ]);
            //  insert to database
            RefMaterial::create([
                'material' => $request->material,
                'kode' => $request->kode,
            ]);

            return redirect()->back()->with([
                'success' => 'Master material berhasil ditambahkan',
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
    public function show(int $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $edit = RefMaterial::find($id);
        $menuActiveMaterial = 'active';

        return view('pages.material.materialEdit', compact('edit', 'menuActiveMaterial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $request->validate([
                'material' => 'required',
                'kode' => 'required',
            ]);

            $mat = RefMaterial::find($id);
            $mat->material = $request->material;
            $mat->kode = $request->kode;

            // update material
            $mat->update();

            return redirect()->route('ref-material.index')->with(['success' => 'Master material berhasil diperbarui']);
        } catch (\Exception $e) {
            return redirect()->route('ref-material.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $mat = RefMaterial::find($id);

            // delete material from db
            if ($mat) {
                $mat->delete();

                return redirect()->back()->with(['success' => 'Master material berhasil dihapus']);
            } else {
                return redirect()->back()->with(['failed' => 'Master material not found']);
            }
        } catch (\Exception $e) {
            return redirect()->route('ref-material.index')->with(['failed' => $e->getMessage()]);
        }
    }
}
