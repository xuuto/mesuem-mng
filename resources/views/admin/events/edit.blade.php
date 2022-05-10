@extends('admin.app')

@section('title') Edit Events @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i>Edit Event</h1>
            {{--            <p>{{ $subTitle }}</p>--}}
        </div>
        <a href="{{ route('events.index') }}" class="btn btn-primary pull-right">
            <i class="fa fa-list"></i> All Events</a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Event</h3>
                @include('admin.includes.errors')
                <form action="{{ route('events.update', $event) }}" method="post" role="form" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="name">Name <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                   id="name" placeholder="Event name" value="{{ old('name', $event->name) }}"/>
                            @error('name') {{ $message }} @enderror
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="description">description <span
                                    class="m-l-5 text-danger">*</span></label>

                            <textarea class="form-control @error('description') is-invalid @enderror" type="text"
                                      rows="4" id="description" name="description"
                                      placeholder="Event description">{{ old('description', $event->description) }}</textarea>
                            @error('description') {{ $message }} @enderror
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="gallery">Select a Gallery <span
                                    class="m-l-5 text-danger"> *</span></label>
                            <select class="form-control @error('gallery_id') is-invalid @enderror"
                                    id="gallery"
                                    name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                        <option value="{{$gallery->id }}" {{ $gallery_id == $gallery->id ? 'selected' : '' }} >{{ $gallery->name }}</option>
                                @endforeach
                            </select>
                            @error('gallery_id') {{ $message }} @enderror
                        </div>
                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('events.index') }}"><i
                                class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>update
                            Event
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

        $(function () {
            var galleryPlaceholder = "<i class='fa fa-search'></i>  " + "Select a Gallery";

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


        $('document').ready(function () {
            $('#city').select2({
                placeholder: 'Select a specific city',
                allowClear: true,
            })

        })
    </script>
@endpush

