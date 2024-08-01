@extends('layouts.main')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Users</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('create.user') }}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i>
                    Add User</a>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        <div class="row doctor-grid">
            @foreach ($users as $user)
                <div class="col-md-4 col-sm-4 col-lg-3">
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="{{ url('profile', $user->id) }}">
                                <img alt="{{ $user->name }}"
                                    src="{{ $user->image ? asset('users/' . $user->image) : 'assets/img/default-avatar.png' }}">
                            </a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('edit.user', $user->id) }}">
                                    <i class="fa fa-pencil m-r-5"></i> Edit
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#delete_user_{{ $user->id }}">
                                    <i class="fa fa-trash-o m-r-5"></i> Delete
                                </a>
                            </div>
                        </div>
                        <h4 class="doctor-name text-ellipsis">
                            <a href="{{ url('profile', $user->id) }}">{{ $user->name }}</a>
                        </h4>
                        <div class="doc-prof">{{ $user->role->name }}</div>
                        <div class="user-country">
                            <i class="fa fa-envelope"></i> {{ $user->email ?? 'Unknown Email' }}
                        </div>
                    </div>
                </div>
                <div id="delete_user_{{ $user->id }}" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('assets/img/sent.png') }}" alt="" width="50" height="46">
                                <h3>Are you sure you want to delete this User?</h3>
                                <div class="m-t-20">
                                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                                    <form action="{{ route('destroy.user', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="see-all">
                    <a class="see-all-btn" href="javascript:void(0);" id="load-more-btn">Load More</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert-success").fadeOut(1000);
            }, 1000);
            setTimeout(function() {
                $(".alert-danger").fadeOut(1000);
            }, 1000);

        });
    </script>
@endpush
