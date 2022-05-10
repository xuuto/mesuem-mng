@extends('admin.app')

{{--@section('title') {{ $pageTitle }} @endsection--}}
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Create Hall</h1>
            {{--            <p>{{ $subTitle }}</p>--}}
        </div>
        <a href="{{ route('halls.index') }}" class="btn btn-primary pull-right">Show All Halls</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                {{--                <h3 class="tile-title">{{ $subTitle }}</h3>--}}
                <form action="{{ route('halls.store') }}" method="POST" role="form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span
                                        class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                   id="name" placeholder="Hall Name" value="{{ old('name', $hall->name) }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label for="gallery" class="control-label">Hall Gallery <span class="m-l-5
                            text-danger">*</span></label>
                            <select class="form-control @error('gallery_id') is-invalid @enderror"
                                    id="gallery_id" name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                    @if($hall->gallery_id == $gallery->id)
                                    <option value="{{ old('gallery_id', $gallery->id) }}"
                                    selected>{{ $gallery->name }}</option>
                                        @else
                                        <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                    @endif
                                @endforeach
                                @error('gallery_id') {{ $message }} @enderror
                            </select>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save
                            City
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="{{ route('cities.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
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
            $('#gallery_id').select2({
                placeholder: 'Select a specific gallery',
                allowClear: true,
            })

        })
@endpush

