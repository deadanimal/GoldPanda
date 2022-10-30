@extends('layouts.app')

@section('title', 'Profile')

@section('content')

    <main class="content">

        <div class="container-fluid">

            <div class="header">
                <h1 class="header-title">
                    Profile
                </h1>
                {{-- <p class="header-subtitle">---</p> --}}
            </div>

            <div class="row">

                <div class="row">

                    <div class="col-xl-4">


                        <div class="card">

                            <div class="card-body">
                                <h5 class="card-title">Name</h5>
                                <p class="card-text">{{ $user->name }}</p>

                                <h5 class="card-title">
                                    Identity Number
                                </h5>
                                <p class="card-text">
                                    {{ $user->ic }}
                                    @if ($user->ic_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>

                                <h5 class="card-title">Nationality</h5>
                                <p class="card-text">{{ $user->nationality }}</p>

                                <h5 class="card-title">Mobile Number</h5>
                                <p class="card-text">
                                    {{ $user->mobile }}
                                    @if ($user->mobile_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>

                                <h5 class="card-title">Bank</h5>
                                <p class="card-text">{{ $user->bank_account_name }}</p>

                                <h5 class="card-title">Bank Account Number</h5>
                                <p class="card-text">
                                    {{ $user->bank_account_number }}
                                    @if ($user->bank_account_verified)
                                        <span class="badge rounded-pill bg-success">Verified</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">Unverified</span>
                                    @endif
                                </p>
                            </div>
                        </div>


                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Password</h5>
                                <h6 class="card-subtitle text-muted">Change your password to a new password</h6>
                            </div>
                            <div class="card-body">
                                @if ($user->hasRole('super-admin'))
                                    <form method="POST" action="/admin/user/{{$user->id}}/password">
                                        @method('PUT')
                                        @csrf
                                        {{-- <div class="mb-3">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" class="form-control" name="old_password">
                                    </div> --}}
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                @else
                                    <form method="POST" action="/profile/password">
                                        @method('PUT')
                                        @csrf
                                        {{-- <div class="mb-3">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" class="form-control" name="old_password">
                                    </div> --}}
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="new_password">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </form>
                                @endif
                            </div>
                        </div>


                    </div>


                    @role('super-admin')
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Password</h5>
                                    <h6 class="card-subtitle text-muted">Change your password to a new password</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="/admin/user/{{ $user->id }}/kemaskini">
                                        @method('PUT')
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Identity Number</label>
                                                <input type="text" class="form-control" name="ic"
                                                    value="{{ $user->ic }}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Mobile Number</label>
                                                <input type="text" class="form-control" name="mobile"
                                                    value="{{ $user->mobile }}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Bank</label>
                                                <input type="text" class="form-control" name="bank_account_name"
                                                    value="{{ $user->bank_account_name }}">
                                            </div>
                                            <div class="mb-3 col-6">
                                                <label class="form-label">Bank Account Number</label>
                                                <input type="number" class="form-control" name="bank_account_number"
                                                    value="{{ $user->bank_account_number }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endrole


                </div>

            </div>




    </main>

@endsection

@section('script')

@endsection
