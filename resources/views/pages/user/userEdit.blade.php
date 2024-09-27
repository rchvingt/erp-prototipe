@extends('layouts.home')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                {{-- Dismissible Alerts --}}
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                @if ($message = Session::get('failed'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                @endif
                <div class="mb-6 card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Form Edit User</h5>
                    </div>
                    <div class="card-body">

                        <form action="{{ route('user.update', $edit->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-fullname">Nama</label>
                                <input type="text" class="form-control" id="basic-default-fullname" name="name"
                                    placeholder="John Doe" value="{{ $edit->name }}">
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-username">Username</label>
                                <input type="text" class="form-control" id="basic-default-username" name="username"
                                    placeholder="johndoe" value="{{ $edit->username }}">
                                @error('username')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="basic-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="basic-default-email" class="form-control" name="email"
                                        placeholder="john.doe@example.com" aria-label="john.doe@example.com"
                                        aria-describedby="basic-default-email2" value="{{ $edit->email }}">


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
                                <div class="form-text">Jika tidak ingin mengubah password, kosongkan saja</div>
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-6">
                                <label class="form-label" for="user-role">User Role</label>
                                <select id="ajax-select-role" class="mb-4 form-select w-50" name="roles"
                                    data-allow-clear="true"></select>
                                @error('roles')
                                    <div class="error">{{ $message }}</div>
                                @enderror

                            </div>


                            <button type="submit" class="btn btn-primary me-3" id="send">Ubah</button>
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
                        // console.log(params);
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
                                    id: item.id, // Kirimkan "id" sebagai id
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

            // Menambahkan role yang sudah terpilih ke Select2 saat edit
            var selectedRoles = @json($userRoles); // Ambil role yang dimiliki user
            // console.log(selectedRoles);
            $.each(selectedRoles, function(key, value) {
                // console.log(key, value);
                var option = new Option(key, value, true, true); // Buat option dengan role terpilih
                $('#ajax-select-role').append(option).trigger(
                    'change'); // Tambahkan ke Select2 dan trigger perubahan
            });

        })

        function templateResult(data) {
            // console.log('templateResult',data);
            return data.loading ? data.text : data.text;
        }

        function templateSelection(data) {
            // console.log('templateSelection', data);
            return data.text || "Select an option";
        }
    </script>
@endpush
