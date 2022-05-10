@extends('admin.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush
@section('title') {{ $pageTitle }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>{{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('staff-roles.index') }}" class="btn btn-primary pull-right">
            <i class="fa fa-list"></i> All Staff-Roles</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">{{ $subTitle }}</h3>
                @include('admin.includes.errors')
                <form action="{{ route('staff-roles.store') }}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="city">Select gallery <span class="m-l-5 text-danger">
                                *</span></label>
                            <select class="form-control @error('gallery_id') is-invalid @enderror" id="gallery"
                                    name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                    {{-- <option value="{{ old('gallery_id', $gallery->id) }}">{{ $gallery->name--}}
                                    {{-- }}</option>--}}
                                    @if(old('gallery_id') == $gallery->id)
                                        <option value="{{ $gallery->id }}" selected>{{ $gallery->name }}</option>
                                    @else
                                        <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('gallery_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="city">Select staff<span class="m-l-5 text-danger">
                                *</span></label>
                            <select class="form-control @error('staff_id') is-invalid @enderror" id="staff"
                                    name="staff_id">
                                <option value=""></option>
                                @foreach($staffs as $staff)
                                    {{-- <option value="{{ old('staff_id', $staff->id)  }}">{{ $staff->first_name }}</option>
                                    --}}
                                    @if(old('staff_id') == $staff->id)
                                        <option value="{{ $staff->id }}" selected>{{ $staff->first_name }}</option>
                                    @else
                                        <option value="{{ $staff->id }}">{{ $staff->first_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('staff_id')
                            <div class="alert alert-danger">{{ $message }} </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="city">Select Role<span class="m-l-5 text-danger">
                                *</span></label>
                            <select class="form-control @error('role_id') is-invalid @enderror" id="role"
                                    name="role_id">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    {{-- <option value="{{ old('role_id', $role->id) }}">{{ $role->role_name }}</option>--}}
                                    @if(old('role_id') == $role->id)
                                        <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="alert alert-danger">{{ $message }} </div>
                            @enderror
                        </div>

                        <div class="form-inline">
                            <label class="control-label mr-2" for="datepicker">Role Start Date</label>
                            <div class="input-group date">
                                <input type="text" class="form-control @error('role_start') is-invalid @enderror"
                                       id="datepicker" placeholder="DD/MM/YYYY" value="{{ old('role_start') }}"
                                       autocomplete="off" aria-describedby="btn-date" name="role_start">
                                <div class="input-group-addon" id="btn-date">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </div>
                            </div>
                            @error('role_start')
                            <div class="alert alert-danger">{{ $message }} </div>
                            @enderror

                            <div class="input-group date d-inline-flex ml-auto">
                                <label class="control-label mr-2" for="datepicker2">Role end Date</label>
                                <input type="text" class="form-control @error('role_end') is_invalid @enderror"
                                       id="date2" value="{{ old('role_end') }}" placeholder="DD/MM/YYYY"
                                       autocomplete="off" aria-describedby="btn-date" name="role_end">
                                <div class="input-group-append" id="btn-date">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-calendar"></i>
                                    </button>
                                </div>
                            </div>
                            @error('role_end')
                            <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror
                        </div>


                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('staff-roles.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            Staff-role
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
                placeholder: 'Select a specific gallery'
                , allowClear: true
                ,
            })

            $('#staff').select2({
                placeholder: 'Select a specific staff'
                , allowClear: true
                ,
            })

            $('#role').select2({
                placeholder: 'Select a specific role'
                , allowClear: true
                ,
            })

            $(function () {
                $('#datepicker').datepicker({
                    format: 'dd-mm-yyyy',
                    title: 'staff-role start-date',
                    autoclose: true,
                    todayHighlight: true,
                    orientation: "auto",
                    locale: 'en',
                    clearBtn: true,
                });
            });

            $(function () {
                $('#date2').datepicker({
                    // format: "d/m/yyyy",
                    // format: 'mm/dd/yyyy',
                    format: 'dd-mm-yyyy',
                    title: 'staff-role end-date',
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
