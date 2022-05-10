@extends('admin.app')

@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    <a href="{{ route('staffs.index') }}" class="btn btn-primary pull-right"><i class="fa fa-2x fa-tags"></i>
        Show All staffs</a>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            {{-- <h3 class="tile-title">{{ $subTitle }}</h3>--}}
            <form action="{{ route('staffs.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="first_name">Name <span class="m-l-5 text-danger">
                                *</span></label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="first_name" id="first_name" placeholder="Staff Name" value="{{ old('name', $staff->first_name)
                                   }}" />
                        @error('first_name') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="last_name">last name <span table.buttons( 0, null ).container().prependTo( table.table().container() class="m-l-5 text-danger">
                                *</span></label>
                        <input class="form-control @error('last_name') is-invalid @enderror" type="text" name="last_name" id="last_name" placeholder="last name" value="{{ old('last_name', $staff->last_name)
                                   }}" />
                        @error('last_name') {{ $message }} @enderror
                    </div>

                    <!-- role selection section -->

                    <div class="form-group">
                        <select class="form-control @error('role_name') is invalid @enderror" name="role_name" id="roles" multiple>
                            <option value=""></option>
                            @foreach ( $roles as $role )
                            @if(in_array($role->id, $currentRoles))
                            <option value="{{ $role->id }}" selected="true">{{ $role->role_name}}</option>
                            @else
                            <option value=" {{ $role->id }}">{{ $role->role_name }}></option>
                            @endif

                            @endforeach
                        </select>
                        @error('role_name') {{ $message }} @enderror
                    </div>

                    {{-- galleries select --}}
                    <div class="form-group">
                        <label class="control-label" for="gallery">Select a gallery</label>
                        <select class="form-control" name="gallery_id" id="gallery">
                            <option value=""></option>
                            @foreach ( $galleries as $gallery )
                            @if(in_array($gallery->id, $currentGallery))
                            <option value="{{$gallery->id}}" selected="true">{{$gallery->name}}</option>
                            @else
                            <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="tile-footer">
                    <a class="btn btn-secondary" href="{{ route('staffs.index') }}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Staff
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
    $('document').ready(function() {
        $('#roles').select2({
            placeholder: 'Select a specific Roles'
        })

        $('#gallery').select2({
            placeholder: 'Select a specific Gallery'
        })

    })

</script>
@endpush
