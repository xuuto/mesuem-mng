@extends('admin.app')

@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>{{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-primary pull-right">
            <i class="fa fa-list"></i> All Roles </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                <form action="{{ route('roles.update', $role) }}" method="post" role="form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span
                                        class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="role_name"
                                   id="role_name" placeholder="role name" value="{{ old('role_name', $role->role_name)
                                   }}"/>
                            @error('role_name') {{ $message }} @enderror
                        </div>

                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="staff-role" name="staff-role" class="custom-control-input"
                                   value="1" @if($role->is_staff_role) checked @endif >
                            <label class="custom-control-label" for="staff-role">Staff Role</label>
                        </div>
                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="partner-role" name="partner-role"
                                   class="custom-control-input" value="0" @if($role->is_partner_role) checked @endif >
                            <label class="custom-control-label" for="partner-role"> Partner Role</label>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                        fa-check-circle"></i>Update Role
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/sweetalert.min.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('#city').select2({
                placeholder: 'Select a specific city',
                allowClear: true,
            })
        });

        $('document').ready(function () {
            $('#staff-role').click(function () {
                var checked1 = $(this).attr("checked");
                console.log(checked1)
                if (checked1 === true) {
                    $('#partner-role').attr('checked', false);
                } else {
                    $('#partner-role').removeAttr('checked')
                }
            });
        });

        $('document').ready(function () {
            $('#partner-role').click(function () {
                var checked2 = $(this).attr("checked");
                if (checked2 === true) {
                    $('#staff-role').attr('checked', false)
                } else {
                    $('#staff-role').removeAttr('checked');
                }
            });
        })
    </script>
@endpush

