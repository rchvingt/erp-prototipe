@extends('layouts.home')
@section('content')
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />

    <div class="container-xxl flex-grow-1 container-p-y">
        <div
            class="row-gap-4 mb-6 d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">

            <div class="d-flex flex-column justify-content-center">
                <h4 class="mb-1">Tambah Pembelian</h4>
                <p class="mb-0">Orders placed across your store</p>
            </div>


        </div>
        <div class="row">

            <!-- First column-->
            <div class="mb-6 col-lg-9 col-12 mb-lg-0">
                <div class="p-6 card invoice-preview-card p-sm-12">
                    <div class="rounded card-body invoice-preview-header" style="background-color: rgba(34,48,62,.06)">
                        <div class="flex-wrap d-flex flex-column flex-sm-row text-heading">

                            <div class="col-md-12 col-8 pe-0 ps-0 ps-md-2">
                                <dl class="mb-0 row gx-4">
                                    <dt class="mb-2 col-sm-5 d-md-flex align-items-center justify-content-start">
                                        <span class="mb-0 h5 text-capitalize text-nowrap">Nomor Order</span>
                                    </dt>
                                    <dd class="col-sm-7">
                                        <input type="text" class="form-control" disabled="" placeholder="#3905"
                                            value="#3905" id="invoiceId">
                                    </dd>
                                    <dt class="mb-1 col-sm-5 d-md-flex align-items-center justify-content-start">
                                        <span class="fw-normal">Date Issued:</span>
                                    </dt>
                                    <dd class="col-sm-7">
                                        <input type="date" class="form-control invoice-date" placeholder="DD/MM/YYYY">
                                    </dd>
                                    <dt class="col-sm-5 d-md-flex align-items-center justify-content-start">
                                        <span class="fw-normal">Due Date:</span>
                                    </dt>
                                    <dd class="mb-0 col-sm-7">
                                        <input type="date" class="form-control due-date" placeholder="DD/MM/YYYY">
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="px-0 card-body">

                        <div class="row">
                            <div class="mb-6 col-md-6 col-sm-5 col-12 mb-sm-0">
                                <h6>Supplier</h6>

                                <select id="ajax-select-supplier" class="mb-4 form-select w-50"
                                    data-allow-clear="true"></select>
                                {{-- <p class="mb-1">Shelby Company Limited</p>
                                <p class="mb-1">Small Heath, B10 0HF, UK</p>
                                <p class="mb-1">718-986-6062</p>
                                <p class="mb-0">peakyFBlinders@gmail.com</p> --}}
                            </div>

                        </div>
                    </div>
                    <hr class="mt-0 mb-6">
                    <div class="px-0 pt-0 card-body">
                        <h5 class="card-title">Item</h5>
                        <form class="source-item">
                            <div class="mb-4" data-repeater-list="group-a">
                                <div class="pt-0 repeater-wrapper pt-md-9" data-repeater-item="">
                                    <div class="border rounded d-flex position-relative pe-0">

                                        <div class="p-6 row w-100 g-6">
                                            <div class="mb-4 col-md-6 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Material</p>
                                                <select id="ajax-select-material" class="select2 form-select"
                                                    data-allow-clear="true"></select>
                                            </div>
                                            <div class="mb-4 col-md-3 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Harga</p>
                                                <input type="text" class="mb-5 form-control invoice-item-price"
                                                    placeholder="24" min="12">

                                            </div>
                                            <div class="mb-4 col-md-2 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Qty</p>
                                                <input type="text" class="form-control invoice-item-qty" placeholder="1"
                                                    min="1" max="50">
                                            </div>
                                            <div class="mt-8 col-md-1 col-12 pe-0">
                                                <p class="h6 repeater-title">Price</p>
                                                <p class="mb-0 text-heading">$24.00</p>
                                            </div>
                                        </div>
                                        <div
                                            class="p-2 d-flex flex-column align-items-center justify-content-between border-start">
                                            <i class="cursor-pointer bx bx-x bx-lg" data-repeater-delete=""></i>

                                        </div>
                                    </div>
                                </div>
                                <div class="pt-0 repeater-wrapper pt-md-9" data-repeater-item="" style="display: none;">
                                    <div class="border rounded d-flex position-relative pe-0">
                                        <div class="p-6 row w-100 g-6">
                                            <div class="mb-4 col-md-6 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Item</p>
                                                <select class="mb-6 form-select item-details">
                                                    <option value="App Design">App Design</option>
                                                    <option value="App Customization" selected="">App Customization
                                                    </option>
                                                    <option value="ABC Template">ABC Template</option>
                                                    <option value="App Development">App Development</option>
                                                </select>
                                                <textarea class="form-control" rows="2" placeholder="Customization &amp; Bug Fixes"></textarea>
                                            </div>
                                            <div class="mb-4 col-md-3 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Cost</p>
                                                <input type="text" class="mb-5 form-control invoice-item-price"
                                                    placeholder="24" min="12">
                                                <div class="text-heading">
                                                    <div class="mb-1">Discount:</div>
                                                    <span class="discount me-2">0%</span>
                                                    <span class="tax-1 me-2" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-original-title="Tax 1">0%</span>
                                                    <span class="tax-2" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-original-title="Tax 2">0%</span>
                                                </div>
                                            </div>
                                            <div class="mb-4 col-md-2 col-12 mb-md-0">
                                                <p class="h6 repeater-title">Qty</p>
                                                <input type="text" class="form-control invoice-item-qty"
                                                    placeholder="1" min="1" max="50">
                                            </div>
                                            <div class="mt-8 col-md-1 col-12 pe-0">
                                                <p class="h6 repeater-title">Price</p>
                                                <p class="mb-0 text-heading">$24.00</p>
                                            </div>
                                        </div>
                                        <div
                                            class="p-2 d-flex flex-column align-items-center justify-content-between border-start">
                                            <i class="cursor-pointer bx bx-x bx-lg" data-repeater-delete=""></i>
                                            <div class="dropdown">
                                                <i class="cursor-pointer bx bx-cog bx-lg more-options-dropdown"
                                                    role="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    data-bs-auto-close="outside" aria-expanded="false">
                                                </i>
                                                <div class="p-4 dropdown-menu dropdown-menu-end w-px-300"
                                                    aria-labelledby="dropdownMenuButton">

                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label for="discountInput"
                                                                class="form-label">Discount(%)</label>
                                                            <input type="number" class="form-control" id="discountInput"
                                                                min="0" max="100">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput1" class="form-label">Tax 1</label>
                                                            <select name="group-a[1][tax-1-input]" id="taxInput1"
                                                                class="form-select tax-select">
                                                                <option value="0%" selected="">0%</option>
                                                                <option value="1%">1%</option>
                                                                <option value="10%">10%</option>
                                                                <option value="18%">18%</option>
                                                                <option value="40%">40%</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput2" class="form-label">Tax 2</label>
                                                            <select name="group-a[1][tax-2-input]" id="taxInput2"
                                                                class="form-select tax-select">
                                                                <option value="0%" selected="">0%</option>
                                                                <option value="1%">1%</option>
                                                                <option value="10%">10%</option>
                                                                <option value="18%">18%</option>
                                                                <option value="40%">40%</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="my-4 dropdown-divider"></div>
                                                    <button type="button"
                                                        class="btn btn-label-primary btn-apply-changes">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-primary" data-repeater-create=""><i
                                            class="bx bx-plus bx-xs me-1_5"></i>Add Item</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="my-0">
                    <div class="px-0 card-body">

                        <div class="row-gap-4 row">
                            <div class="mb-4 col-md-6 mb-md-0">
                                <div class="mb-4 d-flex align-items-center">
                                    <label for="salesperson" class="me-2 fw-medium text-heading">Salesperson:</label>
                                    <select id="ajax-select-salesperson" class="mb-4 form-select w-50"
                                        data-allow-clear="true"></select>
                                </div>

                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="invoice-calculations">
                                    <div class="mb-2 d-flex justify-content-between">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="fw-medium text-heading">$1800</span>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-between">
                                        <span class="w-px-100">Discount:</span>
                                        <span class="fw-medium text-heading">$28</span>
                                    </div>
                                    <div class="mb-2 d-flex justify-content-between">
                                        <span class="w-px-100">Tax:</span>
                                        <span class="fw-medium text-heading">21%</span>
                                    </div>
                                    <hr class="my-2">
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-100">Total:</span>
                                        <span class="fw-medium text-heading">$1690</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /First column -->

            <!-- Second column -->
            <div class="col-lg-3 col-12 invoice-actions">
                <div class="mb-6 card">
                    <div class="card-body">
                        <button class="mb-4 btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-2"></i>Send Request</span>
                        </button>
                        <a href="{{ route('pembelian.index') }}" class="btn btn-outline-secondary d-grid w-100">Batal</a>
                    </div>
                </div>

            </div>
            <!-- /Second column -->
        </div>
    </div>
@endsection
@push('scriptjs')
    <script>
        $(function() {
            $('#ajax-select-supplier').select2({
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                ajax: {
                    url: "{{ URL('get-supplier') }}",
                    type: "GET",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            searchItem: params.term,
                            page: params.page
                        }
                    },
                    processResults: function(data, params) {
                        // console.log(data.data); // Check the data format here

                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id_supplier,
                                    text: item.nama_supplier
                                };
                            }),
                            // results: data.data,
                            pagination: {
                                more: data.last_page != params.page
                            }
                        };


                    },
                    cache: true
                },
                placeholder: "Pilih Supplier", //use this for data-allow-clear="true"
                templateResult: templateResult,
                templateSelection: templateSelection

            })
        })

        function templateResult(data) {
            // console.log('templateResult',data);
            if (data.loading) {
                return data.text;
            }
            return data.text;
        }

        function templateSelection(data) {
            // console.log('templateSelection',data);
            return data.text || "Select an option";
        }
    </script>
    <script>
        $(function() {
            $('#ajax-select-material').select2({
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                ajax: {
                    url: "{{ URL('get-material') }}",
                    type: "GET",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            searchItem: params.term,
                            page: params.page
                        }
                    },
                    processResults: function(data, params) {
                        // console.log(data.data); // Check the data format here

                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id_material,
                                    text: item.material
                                };
                            }),
                            // results: data.data,
                            pagination: {
                                more: data.last_page != params.page
                            }
                        };


                    },
                    cache: true
                },
                placeholder: "Pilih Material", //use this for data-allow-clear="true"
                templateResult: templateResult,
                templateSelection: templateSelection

            })
        })

        function templateResult(data) {
            // console.log('templateResult',data);
            if (data.loading) {
                return data.text;
            }
            return data.text;
        }

        function templateSelection(data) {
            // console.log('templateSelection',data);
            return data.text || "Select an option";
        }
    </script>
    <script>
        $(function() {
            $('#ajax-select-salesperson').select2({
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                ajax: {
                    url: "{{ URL('get-salesperson') }}",
                    type: "GET",
                    dataType: "json",
                    delay: 250,
                    data: function(params) {
                        return {
                            searchItem: params.term,
                            page: params.page
                        }
                    },
                    processResults: function(data, params) {

                        params.page = params.page || 1;
                        return {
                            results: data.data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            }),
                            // results: data.data,
                            pagination: {
                                more: data.last_page != params.page
                            }
                        };


                    },
                    cache: true
                },
                placeholder: "Pilih", //use this for data-allow-clear="true"
                templateResult: templateResult,
                templateSelection: templateSelection

            })
        })

        function templateResult(data) {
            // console.log('templateResult',data);
            if (data.loading) {
                return data.text;
            }
            return data.text;
        }

        function templateSelection(data) {
            // console.log('templateSelection',data);
            return data.text || "Select an option";
        }
    </script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/app-invoice-add.js') }}"></script>
@endpush
