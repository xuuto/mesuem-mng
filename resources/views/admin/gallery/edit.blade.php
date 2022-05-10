@extends('admin.app')
@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.css') }}" />
@endpush
@section('title') {{ $pageTitle }} @endsection
@section('content')
<div class="app-title">
    <div>
        <h1><i class="fa fa-tags"></i>{{ $pageTitle }}</h1>
        <p>{{ $subTitle }}</p>
    </div>
    <a href="{{ route('galleries.index') }}" class="btn btn-primary pull-right">List of Galleries</a>
</div>
@include('admin.partials.flash')
<div class="row user">
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                <li class="nav-item"><a class="nav-link" href="#images" data-toggle="tab">Images</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="general">
                <div class="tile">
                    <h3 class="tile-title">{{ $subTitle }}</h3>
                    <form action="{{ route('galleries.update', $gallery) }}" method="POST" role="form">
                        @csrf
                        @method('PUT')
                        <div class="tile-body">
                            <div class="form-group">
                                <label class="control-label" for="name">Name <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                                    id="name" value="{{ old('name', $gallery->name) }}" />
                                @error('name') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="address">Address <span class="m-l-5 text-danger">
                                        *</span></label>
                                <input class="form-control @error('address') is-invalid @enderror" type="text"
                                    name="address" id="address" value="{{ old('address', $gallery->address) }}" />
                                @error('address') {{ $message }} @enderror
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="CITY">Select a city <span class="m-l-5 text-danger">
                                        *</span></label>
                                <select class="form-control  @error('city_id') is-invalid @enderror" name="city_id"
                                    id="city_id">
                                    @foreach($cities as $city)
                                    <option></option>
                                    <option value="{{$city->id}}" {{ $city_id===$city->id ? 'selected' : ''}}>{{
                                        $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="tile-footer">
                            <a class="btn btn-secondary" href="{{ route('galleries.index') }}">
                                <i class="fa fa-fw fa-lg fa-times-circle">
                                </i>
                                Cancel
                            </a>

                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                        fa-check-circle"></i>update gallery
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="tab-pane" id="images">
                <div class="tile">
                    <h3 class="tile-title">Upload Image</h3>
                    <hr>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="" class="dropzone" id="dropzone"
                                    style="border: 2px dashed rgba(0,0,0,0.3)">
                                    <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <button class="btn btn-success" type="button" id="uploadButton">
                                    <i class="fa fa-fw fa-lg fa-upload"></i>Upload Images
                                </button>
                            </div>
                        </div>
                        @if ($gallery->images)
                        <hr>
                        <div class="row">
                            @foreach($gallery->images as $image)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('storage/'.$image->url) }}" id="imageurl" class="img-fluid"
                                            alt="img">
                                        <a class="card-link float-right text-danger"
                                            href="{{ route('gallery.images.delete', $image->id) }}">
                                            <i class="fa fa-fw fa-lg fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/dropzone/dist/min/dropzone.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript">
    $('#sampleTable').DataTable()
</script>
<script>
    Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('#city_id').select2({
                placeholder: 'Select a specific city',
                allowClear: true,
            });

            let myDropzone = new Dropzone("#dropzone", {
                paramName: "image"
                , addRemoveLinks: true
                , maxFilesize: 4
                , parallelUploads: 2
                , uploadMultiple: false
                , url: "{{ route('gallery.images.upload') }}"
                , autoProcessQueue: false
                ,
            });
            myDropzone.on("queuecomplete", function (file) {
                window.location.reload();
                showNotification('Completed', 'All product images uploaded', 'success', 'fa-check');
            });
            $('#uploadButton').click(function () {
                if (myDropzone.files.length === 0) {
                    showNotification('Error', 'Please select files to upload.', 'danger', 'fa-close');
                } else {
                    myDropzone.processQueue();
                }
            });

            function showNotification(title, message, type, icon) {
                $.notify({
                    title: title + ' : ',
                    message: message,
                    icon: 'fa ' + icon
                }, {
                    type: type,
                    allow_dismiss: true,
                    placement: {
                        from: "top",
                        align: "right"
                    },
                });
            }
        });
</script>
@endpush
