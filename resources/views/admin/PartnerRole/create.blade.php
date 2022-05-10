@extends('admin.app')
@push('styles')

@endpush


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
                @include('admin.includes.errors')
                <form action="{{ route('partner-roles.store') }}" method="post" role="form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="gallery">Select gallery <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('gallery_id') is-invalid @enderror"
                                    id="gallery"
                                    name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                    @if(old('gallery_id') == $gallery->id)
                                        <option value="{{ $gallery->id }}" selected>{{ $gallery->name }}</option>
                                    @else
                                        <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('gallery_id')
                            <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="partner">Select Partner<span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control  @error('partner_id') is-invalid @enderror"
                                    id="partner"
                                    name="partner_id">
                                <option value=""></option>
                                @foreach($partners as $partner)
                                    @if(old('partner_id') == $partner->id)
                                        <option value="{{ $partner->id }}" selected>{{ $partner->name
                                    }}</option>
                                    @else
                                        <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('partner_id')
                            <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="role">Select Role<span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('role_id') is-invalid @enderror"
                                    id="role"
                                    name="role_id">
                                <option value=""></option>
                                @foreach($roles as $role)
                                    @if(old('role_id') == $role->id)
                                        <option value="{{ $role->id  }}" selected>{{ $role->role_name }}</option>
                                    @else
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('role_id')
                            <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-inline">
                            <label class="control-label mr-2" for="datepicker">Partner Role Start Date</label>
                            <div class="input-group date ">
                                <input type="text" class="form-control @error('role_start') is-invalid @enderror"
                                       id="datepicker"
                                       placeholder="DD/MM/YYYY"
                                       name="role_start" autocomplete="off"
                                       value="{{ old('role_start') }}">
                                <div class="input-group-addon" id="btn-date">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fa fa-clock-o"></i>
                                    </button>
                                </div>
                            </div>
                            @error('role_start')
                            <div class="alert alert-danger"> {{ $message }}</div>
                            @enderror

                            <div class="input-group date d-inline-flex ml-auto">
                                <label class="control-label mr-2" for="datepicker2">Role end Date</label>
                                <input type="text" class="form-control @error('role_end') is-invalid @enderror endDate"
                                       placeholder="DD/MM/YYYY" id="datepicker2"
                                       aria-describedby="btn-date" name="role_end" autocomplete="off"
                                       value="{{ old('role_end') }}">
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
                        <a class="btn btn-secondary" href="{{ route('partner-roles.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
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

            // $('#partner').select2({
            //     placeholder: 'Select a specific Partner',
            //     allowClear: true,
            // })

            $(function () {
                var placeholder = "<i class='fa fa-search'></i>  " + "Select a Partner";
                var roleplaceholder = "<i class='fa fa-search'></i>  " + "Select a Role";
                var galleryPlaceholder = "<i class='fa fa-search'></i>  " + "Select a Gallery";

                $("#partner").select2({
                    placeholder: placeholder,
                    width: '100%',
                    allowClear: true,
                    escapeMarkup: function(m) {
                        return m;
                    }
                });

                $("#role").select2({
                    placeholder: roleplaceholder,
                    width: '100%',
                    allowClear: true,
                    escapeMarkup: function(m) {
                        return m;
                    }
                });

                //gallery
                $("#gallery").select2({
                    placeholder: galleryPlaceholder,
                    width: '100%',
                    allowClear: true,
                    escapeMarkup: function(m) {
                        return m;
                    }
                });
            });


            // $('#role').select2({
            //     placeholder: 'Select a specific role',
            //     allowClear: true,
            // })

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

