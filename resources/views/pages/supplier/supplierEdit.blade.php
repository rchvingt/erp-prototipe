@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                @include('alert')
                <div class="mb-6 card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Ubah Supplier</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('ref-supplier.update', $edit->id_supplier) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-supplier">Supplier</label>
                                <input type="text" class="form-control" id="basic-default-supplier" name="nama_supplier"
                                    placeholder="Resistor" value="{{ $edit->nama_supplier }}">
                                @error('supplier')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-alamat">Alamat</label>
                                <input type="text" class="form-control" id="basic-default-alamat" name="alamat"
                                    placeholder="MAT##" value="{{ $edit->alamat }}">
                                @error('alamat')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-telepon">Telepon</label>
                                <input type="text" class="form-control" id="basic-default-telepon" name="telepon"
                                    placeholder="MAT##" value="{{ $edit->telepon }}">
                                @error('telepon')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary" id="send">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
