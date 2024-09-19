@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                @include('alert')
                <div class="mb-6 card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Tambah Supplier</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('ref-supplier.store') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-supplier">Supplier</label>
                                <input type="text" class="form-control" id="basic-default-supplier" name="nama_supplier"
                                    placeholder="Nama Supplier">
                                @error('nama_supplier')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-alamat">Alamat</label>
                                <input type="text" class="form-control" id="basic-default-alamat" name="alamat"
                                    placeholder="MAT##">
                                @error('alamat')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-telepon">Telepon</label>
                                <input type="text" class="form-control" id="basic-default-telepon" name="telepon"
                                    placeholder="MAT##">
                                @error('telepon')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary me-3" id="send">Simpan</button>
                            <a href="{{ route('ref-supplier.index') }}" class="btn btn-outline-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
