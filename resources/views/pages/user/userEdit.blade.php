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


                            <button type="submit" class="btn btn-primary" id="send">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
