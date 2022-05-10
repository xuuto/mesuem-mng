@extends('admin.app')

@section('title') List all Events @endsection
@push('styles')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> show all Events</h1>
            <p>List Events</p>
        </div>
        <a href="{{ route('events.create') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>
            new Event</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover datatable" id="sampleTable">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Gallery</th>
                                <th>Created_date</th>
                                <th style="width:100px; min-width:100px;" class="text-center text-danger">
                                    <i class="fa fa-bolt"> </i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events  as $event)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->gallery->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->created_at)->format('d-m-Y') }} </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <a href="{{ route('events.edit', $event->id) }}"
                                               class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('events.destroy', $event) }}"
                                               class="btn btn-sm btn-danger btn-delete" data-id="{{ $event->id }}"><i
                                                    class="fa fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
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

    <script>
        var table = $('#sampleTable').DataTable({
            dom: 'lBfrtip',
            columnDefs: [
                {
                    targets: 1,
                    className: 'noVis'
                }
            ],
            buttons: [
                'excel',
                'csv',
                'pdf',
                'print'
            ],
            "order": [[0, 'asc']],
        });
        table.buttons().container()
            .appendTo($('.dataTables_wrapper .dt-buttons', table.table().container()));
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("body").on("click", ".btn-delete", function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                // let id = e.target.getAttribute('data-id');
                console.log(id)

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
                                url: "/events" + '/' + id,
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    id: id,
                                },
                                success: function (data) {
                                    console.log(data);
                                    if (data.success) {
                                        swalWithButtons.fire(
                                            'Deleted!',
                                            'Event has been deleted',
                                            "success"
                                        );

                                    }
                                    setInterval(function () {
                                        location.reload();
                                    }, 2000);
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
        })

    </script>
@endpush

