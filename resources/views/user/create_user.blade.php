@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h4 class="page-title">{{ isset($users) ? 'Edit User' : 'Add User' }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <form id="userForm" action="{{ isset($users) ? url('/user/update/' . $users->id) : url('/user/insert') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($users))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name" value="{{ old('name', $users->name ?? '') }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email', $users->email ?? '') }}">
                        </div>
                    </div>
                    @if(!isset($users))
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Role <span class="text-danger">*</span></label>
                            <select class="form-control" name="role_id">
                                <option value="">Select Role</option>
                                @foreach($roles as $id => $name)
                                    <option value="{{ $id }}" {{ (old('role_id') ?? $users->role_id ?? '') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Image</label>
                            <div class="profile-upload">
                                <div class="upload-img">
                                    <img alt="" id="previewImage" src="{{ isset($users->image) ? asset('users/' . $users->image) : 'assets/img/user.jpg' }}">
                                </div>
                                <div class="upload-input">
                                    <input type="file" class="form-control" name="image" accept="image/*" onchange="previewFile()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="display-block">Status <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="user_active" value="active" {{ (old('status', $users->status) == 'active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="user_inactive" value="inactive" {{ (old('status', $users->status) == 'inactive') ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_inactive">Inactive</label>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-12 text-center m-t-20">
                        <button class="btn btn-primary submit-btn">{{ isset($users) ? 'Update User' : 'Create User' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $.validator.addMethod("requireStatus", function(value, element) {
        return $("input[name='status']:checked").length > 0;
    }, "Please select a status");

    $("#userForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            role_id: {
                required: true
            },
            status: {
                requireStatus: true
            }
        },
        messages: {
            name: {
                required: "Please enter a name",
                minlength: "Name must be at least 3 characters long"
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            role_id: {
                required: "Please select a role"
            },
            status: {
                requireStatus: "Please select a status"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            if (element.attr('type') === 'radio') {
                error.insertAfter(element.closest('.form-group'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            if ($(element).attr('type') === 'radio') {
                $(element).closest('.form-group').addClass('has-error');
            } else {
                $(element).addClass('is-invalid');
            }
        },
        unhighlight: function (element, errorClass, validClass) {
            if ($(element).attr('type') === 'radio') {
                $(element).closest('.form-group').removeClass('has-error');
            } else {
                $(element).removeClass('is-invalid');
            }
        }
    });

    // Add password validation only if the password field exists
    if ($("input[name='password']").length > 0) {
        $("#userForm").validate().settings.rules.password = {
            required: true,
            minlength: 6
        };
        $("#userForm").validate().settings.messages.password = {
            required: "Please provide a password",
            minlength: "Password must be at least 6 characters long"
        };
    }
});

// Preview uploaded image
function previewFile() {
    const preview = document.getElementById('previewImage');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file); // Convert the file to a data URL.
    } else {
        preview.src = 'assets/img/user.jpg'; // Default image if no file is selected.
    }
}
</script>
@endpush
