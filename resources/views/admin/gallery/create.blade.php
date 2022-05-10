@extends('admin.app')

@section('title') Create Gallery @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i>{{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    <a href="{{ route('galleries.index') }}" class="btn btn-primary pull-right">
        <i class="fa fa-list"></i> All Galleries </a>
</div>
{{-- @include('admin.partials.flash')--}}
{{-- @if(Session::has('success'))--}}
{{-- <script>
    --}}
{{--            $(function () {--}}
{{--                    swal.fire({--}}
{{--                    icon: "success",--}}
{{--                    title: 'Great',--}}
{{--                    text: '{{ Session::get("success")}}'--}}
{{--                })--}}
{{--            })--}}
{{--
</script>--}}
{{-- @endif--}}
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">{{ $subTitle }}</h3>
            <form action="{{ route('galleries.store') }}" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile-body">
                    <div class="form-group">
                        <label class="control-label" for="name">Name <spanclass="m-l-5 text-danger"> *</spanclass=>
                        </label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                            id="name" placeholder="Gallery name" value="{{ old('name') }}" />
                        @error('name') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="address">Address <span class="m-l-5 text-danger">*</span>
                        </label>

                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="address"
                            id="address" placeholder=" address of the gallery " value="{{ old('address') }}" />
                        @error('address') {{ $message }} @enderror
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="city">Select a city <span class="m-l-5 text-danger">
                                *</span></label>
                        <select class="form-control @error('city_id') is-invalid @enderror" id="city" name="city_id">
                            <option value=""></option>
                            @foreach($cities as $city)
                            <option value="{{$city->id }}">
                                {{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') {{ $message }} @enderror
                    </div>
                </div>
                <div class="tile-footer">
                    <a class="btn btn-secondary" href="{{ route('galleries.index') }}">
                        <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle">
                        </i>Save
                        Gallery
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

        })
</script>
@endpush
