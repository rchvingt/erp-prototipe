@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                @include('alert')
                <div class="mb-6 card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Ubah Material</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('ref-material.update', $edit->id_material) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-material">Material</label>
                                <input type="text" class="form-control" id="basic-default-material" name="material"
                                    placeholder="Resistor" value="{{ $edit->material }}">
                                @error('material')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-kode">Kode</label>
                                <input type="text" class="form-control" id="basic-default-kode" name="kode"
                                    placeholder="MAT##" value="{{ $edit->kode }}">
                                @error('kode')
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
