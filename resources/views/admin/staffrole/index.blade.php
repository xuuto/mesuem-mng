@extends('admin.app')

@section('title') staff-roles Management @endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/dataTables.bootstrap4.min.css') }}"/>
@endpush
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-tags"></i> {{ $pageTitle }}</h1>
            <p>{{ $subTitle }}</p>
        </div>
        <a href="{{ route('staff-roles.create') }}" class="btn btn-primary pull-right">
            <i class="fa fa-plus"></i> Create new Staff-Role</a>
    </div>
    @include('admin.partials.flash')
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered"  id="sampleTable">
                        <thead>
                        <tr>
                            <th> #</th>
                            <th> Gallery</th>
                            <th>Staff</th>
                            <th>Role</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffRoles as $staffRole)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $staffRole->gallery->name}}</td>
                                <td>{{ $staffRole->staff->first_name}}</td>
                                <td>{{ $staffRole->role->role_name }}
                                <td>{{ \Carbon\Carbon::parse( $staffRole->role_start)->format('d/m/Y')  }}</td>
                                <td>
                                    @if(empty($staffRole->role_end))
                                       none
                                    @else
                                        {{ \Carbon\Carbon::parse($staffRole->role_end)->format('d/m/Y') }}
                                        @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Second group">
                                        <a href="{{ route('staff-roles.edit', $staffRole->id) }}"
                                           class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                        <a href="{{ route('staff-roles.destroy', $staffRole->id) }}"
                                           class="btn btn-sm btn-danger btn-delete" data-id="{{ $staffRole->id }}"><i
                                                    class="fa
                                           fa-trash"></i></a>
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
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>

    <script>
        var table = $('#sampleTable').DataTable({
            dom: 'Blfrtip',
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
            .appendTo($('.dt-buttons', table.table().container()));
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
                                url: "/staff-roles" + '/' + id,
                                data: {
                                    "_token": "{{csrf_token()}}",
                                    id: id,
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

