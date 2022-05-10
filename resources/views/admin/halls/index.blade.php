@extends('admin.app')

@section('title') show Halls @endsection
@push('styles')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    {{--    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> Halls</h1>
            {{--            <p>{{ $subTitle }}</p>--}}
        </div>
        <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#ajaxModal"
           id="newHall"><i class="fa fa-plus"></i> Create new
            Hall</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-bordered table-striped table-hover datatable" id="sampleTable">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Name</th>
                            <th>Gallery</th>
                            <th>created</th>
                            {{--                            <th style="width:50px; min-width:50px;" class="text-center text-danger"><i--}}
                            {{--                                        class="fa fa-bolt"> </i></th>--}}
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajaxModal" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-heading">edit Hall</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="hall-form" class="form-horizontal">
                        <input type="hidden" name="hall_id" id="hall_id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="Enter Hall Name">
                            <span id="name_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="gallery" class="control-label">Hall Gallery <span class="m-l-5
                                text-danger">*</span></label>
                            <select class="form-control required"
                                    id="gallery_id" name="gallery_id">
                                <option value=""></option>
                                @foreach($galleries as $gallery)
                                    <option></option>
                                    @if(old('gallery_id') == $gallery->id)
                                        <option value="{{ $gallery->id }}" {{ old('gallery_id') == $gallery->id ?
                                    'selected' : "" }}>{{$gallery->name}}</option>
                                    @else
                                        <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span id="gallery_id_error"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btn-save">Save</button>
                </div>
            </div>
        </div>
    </div>




    <!-- end of modal -->

    {{--        <!-- edit modal -->--}}
    {{--        <div class="modal fade" id="editHallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"--}}
    {{--             aria-hidden="true">--}}
    {{--            <div class="modal-dialog" role="document">--}}
    {{--                <div class="modal-content">--}}
    {{--                    <!-- modal Header -->--}}
    {{--                    <div class="modal-header">--}}
    {{--                        <h5 class="modal-title" id="modal-heading">edit Hall</h5>--}}
    {{--                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
    {{--                            <span aria-hidden="true">&times;</span>--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-body">--}}
    {{--                        <form id="edit-hall-form" class="form-horizontal">--}}
    {{--                            <input type="hidden" name="hall_id" id="edit_hall_id">--}}
    {{--                            <div class="form-group">--}}
    {{--                                <label for="name">Name</label>--}}
    {{--                                <input type="text" name="name" class="form-control" id="hall-name"--}}
    {{--                                       placeholder="Enter Hall Name">--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group">--}}
    {{--                                <label for="gallery" class="control-label">Hall Gallery <span class="m-l-5--}}
    {{--                                text-danger">*</span></label>--}}
    {{--                                <select class="form-control required"--}}
    {{--                                        id="hall-gallery_id" name="gallery_id">--}}
    {{--                                    <option value=""></option>--}}
    {{--                                    @foreach($galleries as $gallery)--}}
    {{--                                        <option></option>--}}
    {{--                                        @if(old('gallery_id') == $gallery->id)--}}
    {{--                                            <option value="{{ $gallery->id }}" {{ old('gallery_id') == $gallery->id ?--}}
    {{--                                    'selected' : "" }}>{{$gallery->name}}</option>--}}
    {{--                                        @else--}}
    {{--                                            <option value="{{ $gallery->id }}">{{ $gallery->name }}</option>--}}
    {{--                                        @endif--}}
    {{--                                    @endforeach--}}
    {{--                                </select>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                    <div class="modal-footer">--}}
    {{--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
    {{--                        <button type="button" class="btn btn-primary" id="btn-save">Save changes</button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <!-- end of modal -->--}}

@endsection
@push('scripts')
    {{--    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>--}}
    {{--        <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    {{--    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>--}}
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#sampleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('halls.index') }}',
                columns: [
                    {
                        data: 'id', name: 'id'
                    },
                    {
                        data: 'name', name: 'name'
                    },
                    {
                        data: 'gallery', name: 'gallery.name', orderable: true, searchable: true
                    },
                    {
                        data: 'created_at', name: 'created_at'
                    },
                    {
                        data: 'action', name: 'Actions', orderable: false, searchable: false
                    },
                ],
                dom: 'lBfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                order: [[0, 'desc']],
            })
        });
        //
        $('#newHall').click(function (e) {
            e.preventDefault();
            $('#btn-save').html('create new Hall');
            $('#hall_id').val('');
            $('#gallery_id').val('').trigger('change'); // clear and show default placeholder
            $('#hall-form').trigger('reset');
            $('#modal-heading').html("Add new Hall");
            $('#ajaxModal').modal('show');

        });

        // $('#btn-save').click(function (e) {
        //     e.preventDefault();
        //     let id = $('#hall_id').val();
        //     let name = $('#name').val();
        //     let gallery_id = $('#gallery_id').val();
        // var data = $('#hall-form').serializeArray();
        $('body').on('click', '#editHall', function () {

            var hall_id = $(this).data('id');
            console.log(hall_id)
            $.get("{{ route('halls.index') }}" + "/" + hall_id + "/edit", function (data) {
                // $('#modal-heading').html('Edit Hall');
                console.log(data);
                $('#btn-save').html('Update hall');
                // $('#ajaxModal').modal('show');
                $('#hall_id').val(data.id);
                $('#name').val(data.name);
                $('#gallery_id').val(data.gallery_id).trigger('change');
                $('#ajaxModal').modal('show')

                // $('#hall-form').trigger('reset')
                // var = "<option value='"+data.gallery_id+"'>


            })
        });

        $('#btn-save').click(function (e) {
            e.preventDefault();
            // $(this).html('Save');

            $.ajax({
                data: $('#hall-form').serialize(),
                url: "{{ route('halls.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#hall-form').trigger('reset');
                    $('#ajaxModal').modal('hide');
                    location.reload();

                },


                error: function (errors) {
                    let error = JSON.parse(errors.responseText).errors;
                    $.each(error, function (i, message) {
                        $("#" + i + "_error").html('<span class="help-block" style="color:red;">' + message + '</span>');
                    });
                    //  console.log(data);
                    // $('#name_error').html('<p>' + data.responseJSON.errors.name[0] + '</p>')
                    // $('#gallery_id_error').html('<p>' + data.responseJSON.errors.gallery_id[0] + '</p>');
                    // console.log('Error:', data);
                    // $('#btn-save').html('save Changes');
                    // $('#hall-form').trigger('reset');
                }
            });
        });

        //delete hall
        $('body').on('click', '#getDeleteId', function (e) {
            var dataTable = $('#sampleTable').DataTable();
            e.preventDefault()
            var hall_id = $(this).data('id');
            console.log(hall_id);

            const swalWithButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true,
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed) {
                        {{--var path = "{{ route('halls.destroy'), $hall->id}}";--}}
                        $.ajax({
                            type: 'DELETE',
                            dataType: 'json',
                            url: "/halls" + '/' + hall_id,
                            data: {
                                "_token": "{{csrf_token()}}",
                                id: hall_id,
                            },
                            success: function (data) {
                                console.log(data);
                                if (data.success) {
                                    swalWithButtons.fire(
                                        'Deleted!',
                                        'your file has been deleted',
                                        "success"
                                    );

                                }
                                // setInterval(function () {
                                //     location.reload();
                                // }, 2000);
                                dataTable.ajax.reload();
                            }
                        });
                    } // end of if
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithButtons.fire(
                        'Cancelled',
                        'you cancelled to delete :)',
                        'error'
                    )
                }
            }) //end of block

        });

    </script>
    <script>
        $('document').ready(function () {
            $('#gallery_id').select2({
                $dropdownParent: '#ajaxModal',
                placeholder: 'Select a specific Gallery',
                width: '100%',
                padding: '0',
                allowClear: true,
            });

        });
    </script>

@endpush

