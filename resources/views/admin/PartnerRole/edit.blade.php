@extends('admin.app')

@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>{{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('partner-roles.index') }}" class="btn btn-primary pull-right">
            <i class="fa fa-list"></i> All Partner-Roles</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('partner-roles.update', $partner_role) }}" method="post" role="form"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT'   )
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="city">Select gallery <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('gallery_id') is-invalid @enderror"
                                    id="gallery"
                                    name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                    <option value="{{ $gallery->id }}" {{ $gallery_id ==
                                    $gallery->id ? 'selected' : "" }}>{{
                                    $gallery->name
                                    }}</option>
                                @endforeach
                            </select>
                            @error('gallery_id') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="partner">Select Partner<span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('partner_id') is-invalid @enderror"
                                    id="partner"
                                    name="partner_id">
                                <option value=""></option>
                                @foreach($partners as $partner)
                                    <option
                                        value="{{ $partner->id }}" {{ $partner_id == $partner->id ? 'selected' : "" }}>
                                        {{ $partner->name  }}
                                    </option>
                                @endforeach
                            </select>
                            @error('partner_id') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="role">Select Role<span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('role_id') is-invalid @enderror"
                                    id="role"
                                    name="role_id">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $role_id == $role->id ? 'selected' : "" }}>{{
                                    $role->role_name
                                    }}</option>
                                @endforeach
                            </select>
                            @error('role_id') {{ $message }} @enderror
                        </div>

                        <div class="form-inline">
                            <label class="control-label mr-2" for="datepicker">Role Start Date</label>
                            <div class="input-group date">
                                <input type="text" class="form-control date" id="datepicker" placeholder="DD/MM/YYYY"
                                       aria-describedby="btn-date" name="role_start"
                                       value="{{ \Carbon\Carbon::parse($partner_role->role_start)->format('d-m-Y') }}">
                                <div class="input-group-addon" id="btn-date">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="input-group date d-inline-flex ml-auto">
                                <label class="control-label mr-2" for="datepicker2">Role end Date</label>
                                <input type="text" class="form-control date" id="datepicker2" placeholder="DD/MM/YYYY"
                                       aria-describedby="btn-date" name="role_end"
                                       value="{{ $partner_role->role_end_date == true ?  \Carbon\Carbon::parse($partner_role->role_end)->format('d-m-Y') : null }}" readonly>
                                <div class="input-group-append" id="btn-date">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('partner-roles.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>update
                            Partner-role
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
    <script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $('document').ready(function () {
            $('#gallery').select2({
                placeholder: 'Select a specific gallery',
                allowClear: true,
            })

            $('#partner').select2({
                placeholder: 'Select a specific Partner',
                allowClear: true,
            })

            $('#role').select2({
                placeholder: 'Select a specific role',
                allowClear: true,
            })

            $(function () {
                $('#datepicker').datepicker({
                    // format: "mm/dd/yy",
                    format: 'dd-mm-yyyy',
                    title: 'Partner-role start-date',
                    autoclose: true,
                    todayHighlight: true,
                    orientation: "auto",
                    locale: 'en',
                    clearBtn: true,
                });
            });

            $(function () {
                $('#datepicker2').datepicker({
                    format: 'dd-mm-yyyy',
                    title: 'Partner-role end-date',
                    autoclose: true,
                    todayHighlight: true,
                    orientation: "auto",
                    locale: 'en',
                    clearBtn: true,
                });
            });
        })
    </script>
@endpush

