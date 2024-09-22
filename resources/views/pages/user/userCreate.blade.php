@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                @include('alert')
                <div class="mb-6 card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Tambah User</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-fullname">Nama</label>
                                <input type="text" class="form-control" id="basic-default-fullname" name="name"
                                    placeholder="John Doe">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-username">Username</label>
                                <input type="text" class="form-control" id="basic-default-username" name="username"
                                    placeholder="johndoe">
                                @error('username')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="basic-default-email" class="form-control" name="email"
                                        placeholder="john.doe@example.com" aria-label="john.doe@example.com"
                                        aria-describedby="basic-default-email2">


                                </div>
                                <div class="form-text"> You can use letters, numbers &amp; periods </div>
                                @error('email')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="············" aria-describedby="password">
                                    <span class="cursor-pointer input-group-text"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control"
                                        name="password_confirmation" placeholder="············" aria-describedby="password">
                                    <span class="cursor-pointer input-group-text"><i class="bx bx-hide"></i></span>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="ajax-select-role" class="mb-4 form-select w-50" name="roles"
                                    data-allow-clear="true"></select>
                                @error('username')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>


                            <button type="submit" class="btn btn-primary me-3" id="send">Simpan</button>

                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">Batal</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scriptjs')
    <script>
        $(function() {
            $('#ajax-select-role').select2({
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                ajax: {
                    url: "{{ route('pengaturan.get-roles') }}",
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
                        // console.log(data); // Check the data format here

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
                placeholder: "Pilih Role", //use this for data-allow-clear="true"
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
@endpush
