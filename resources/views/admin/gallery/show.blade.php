@extends('admin.app')

{{--@section('title') {{ $pageTitle }} @endsection--}}
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i> Create Hall</h1>
        {{-- <p>{{ $subTitle }}</p>--}}
    </div>
    <a href="{{ route('galleries.index') }}" class="btn btn-primary pull-right">Show All Galleries</a>
</div>
@include('admin.partials.flash')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="tile">
            <div class="card">
                <div class="card-header">
                    gallery images
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('galleries.index') }}">
                                back to list
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        id
                                    </th>
                                    <td>
                                        {{ $gallery->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        name
                                    </th>
                                    <td>
                                        {{ $gallery->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        address
                                    </th>
                                    <td>
                                        {{ $gallery->address }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        city
                                    </th>
                                    <td>
                                        {{ $gallery->city->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        image
                                    </th>
                                    <td>
                                        @if($gallery->images)
                                        @foreach($gallery->images as $image)
                                        <a href="{{ asset('storage/'.$image->url) }}" target="_blank">
                                            <img src={{ asset('storage/'.$image->url) }} width="50px" height="50px">
                                        </a>
                                        @endforeach
                                        @else
                                        no images uploaded
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('galleries.index') }}">
                                back to list
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
