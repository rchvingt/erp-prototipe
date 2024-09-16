@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="mb-6 col-xxl-8 order-0">
                <div class="card">
                    <div class="d-flex align-items-start row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="mb-3 card-title text-primary">Selamat Datang! 🎉</h5>
                                <p class="mb-6">
                                    Dasbor ERP
                                </p>
                            </div>
                        </div>
                        <div class="text-center col-sm-5 text-sm-left">
                            <div class="px-0 pb-0 card-body px-md-6">
                                <img src="../assets/img/illustrations/man-with-laptop.png" height="175"
                                    class="scaleX-n1-rtl" alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- if you need some js --}}
@push('scriptjs')
    <script></script>
@endpush
