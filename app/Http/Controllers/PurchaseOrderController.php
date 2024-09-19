<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\RefMaterial;
use App\Models\RefSupplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::leftJoin('ref_supplier', 'purchase_orders.id_supplier', '=', 'ref_supplier.id_supplier')
        ->select('purchase_orders.*', 'ref_supplier.nama_supplier')
        ->get();

        $menuActivePurchaseOrder = 'active';

        return view('pages.purchase-order.purchaseOrderIndex', compact('purchaseOrders', 'menuActivePurchaseOrder'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menuActivePurchaseOrder = 'active';

        return view('pages.purchase-order.purchaseOrderCreate', compact('menuActivePurchaseOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_supplier' => 'required|exists:ref_supplier,id_supplier',
                'nomor_order' => 'required|string|max:255|unique:pembelian,nomor_order',
                'tgl_po' => 'required|date',
                'status' => 'required|in:pending,disetujui,ditolak',
                'id_pegawai' => 'required',
                'tgl_kirim' => 'required|date',
            ]);
            //  insert to database
            PurchaseOrder::create([
                'id_supplier' => $request->id_supplier,
                'nomor_order' => $request->nomor_order,
                'tgl_po' => $request->tgl_po,
                'status' => $request->status,
                'id_pegawai' => $request->id_pegawai,
                'tgl_kirim' => $request->tgl_kirim,
            ]);

            return redirect()->back()->with([
                'success' => 'Pembelian berhasil ditambahkan',
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
        return view('pages.purchase-order.purchaseOrderShow');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $edit = PurchaseOrder::find($id);
        $menuActivePurchaseOrder = 'active';

        return view('pages.purchase-order.purchaseOrderEdit', compact('edit', 'menuActivePurchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'id_supplier' => 'required',
                'nomor_order' => 'required',
                'tgl_po' => 'required',
                'status' => 'required',
                'id_pegawai' => 'required',
                'tgl_kirim' => 'required',
            ]);

            $po = PurchaseOrder::find($id);
            $po->id_supplier = $request->id_supplier;
            $po->nomor_order = $request->nomor_order;
            $po->tgl_po = $request->tgl_po;
            $po->status = $request->status;
            $po->id_pegawai = $request->id_pegawai;
            $po->tgl_kirim = $request->tgl_kirim;

            // update PurchaseOrder
            $po->update();

            return redirect()->route('pembelian.index')->with(['success' => 'Pembelian berhasil diperbarui']);
        } catch (\Exception $e) {
            return redirect()->route('pembelian.index')->with(['failed' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $po = PurchaseOrder::find($id);

            // delete material from db
            if ($po) {
                $po->delete();

                return redirect()->back()->with(['success' => 'Pembelian berhasil dihapus']);
            } else {
                return redirect()->back()->with(['failed' => 'Pembelian not found']);
            }
        } catch (\Exception $e) {
            return redirect()->route('purchase-order.index')->with(['failed' => $e->getMessage()]);
        }
    }

    public function getSupplier(Request $request)
    {
        $data = RefSupplier::where('nama_supplier', 'like', '%'.$request->searchItem.'%');

        return $data->paginate(10, ['*'], 'page', $request->page);
    }

    public function getMaterial(Request $request)
    {
        $data = RefMaterial::where('material', 'like', '%'.$request->searchItem.'%');

        return $data->paginate(10, ['*'], 'page', $request->page);
    }

    public function getSalesperson(Request $request)
    {
        $data = User::where('name', 'like', '%'.$request->searchItem.'%');

        return $data->paginate(10, ['*'], 'page', $request->page);
    }
}
