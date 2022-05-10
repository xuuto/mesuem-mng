@extends('admin.app')

@section('title') {{ $pageTitle }} @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle ?? 'edit Partner' }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('partners.index') }}" class="btn btn-primary pull-right"><i class="fa fa-2x fa-tags"></i>
            Show All Partners</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="tile">
                {{--                <h3 class="tile-title">{{ $subTitle }}</h3>--}}
                <form action="{{ route('partners.store') }}" method="POST" role="form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="control-label" for="first_name">Name <span
                                        class="m-l-5 text-danger"> *</span></label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                   name="name"
                                   id="first_name" placeholder="partner Name" value="{{ old('name', $partner->name)
                                   }}"/>
                            @error('first_name') {{ $message }} @enderror
                        </div>


                    </div>
                    <div class="tile-footer">
                        <a class="btn btn-secondary" href="{{ route('partners.index') }}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update partner
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
            $('#gallery_id').select2({
                placeholder: 'Select a specific Gallery',
            })

        })
    </script>
@endpush

