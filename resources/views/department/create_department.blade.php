@extends('layouts.main')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h4 class="page-title">{{ isset($departments) ? 'Edit Department' : 'Add Department' }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form id="departmentForm"
                    action="{{ isset($departments) ? url('/department/update/' . $departments->id) : url('/department/insert') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Department Name</label>
                        <input class="form-control" type="text" name="name"
                            value="{{ old('name', isset($departments) ? $departments->name : '') }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea cols="30" rows="4" class="form-control" name="description">{{ old('description', isset($departments) ? $departments->description : '') }}</textarea>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="display-block">Status <span class="text-danger">*</span></label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="user_active"
                                    value="active"
                                    {{ old('status', isset($departments) ? $departments->status : '') == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="user_inactive"
                                    value="inactive"
                                    {{ old('status', isset($departments) ? $departments->status : '') == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="user_inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button
                            class="btn btn-primary submit-btn">{{ isset($departments) ? 'Update Department' : 'Create Department' }}</button>
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
            $('#departmentForm').validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    status: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a department name",
                        minlength: "Department name must be at least 2 characters long"
                    },
                    status: {
                        required: "Please select a status"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    if (element.attr('type') === 'radio') {
                        error.insertAfter(element.closest('.form-group'));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    if ($(element).attr('type') === 'radio') {
                        $(element).closest('.form-group').addClass('has-error');
                    } else {
                        $(element).addClass('is-invalid');
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    if ($(element).attr('type') === 'radio') {
                        $(element).closest('.form-group').removeClass('has-error');
                    } else {
                        $(element).removeClass('is-invalid');
                    }
                }
            });
        });
    </script>
@endpush
