@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Reports</div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-responsive table-bordered table-hover mb-0"
                            style="overflow-x: auto;">
                            <thead>
                                <th>Exception</th>
                                <th>Application</th>
                                <th>Device</th>
                                <th>Crash Count</th>
                                <th>Reported On</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @if ($data->count() == 0)
                                    <tr>
                                        <td colspan="5">No products to display.</td>
                                    </tr>
                                @endif

                                @foreach ($data as $report)
                                    <tr>
                                        <td>
                                            <a class="text-danger"
                                                href="{{ url('/report?package_name=' .$report->package_name .'&app_version_code=' .$report->app_version_code .'&brand=' .$report->brand .'&phone_model=' .$report->phone_model .'&exception=' .$report->exception) }}">{{ $report->exception }}</a>
                                        </td>
                                        <td>{{ $report->package_name }}</td>
                                        <td>{{ strtoupper($report->brand) . ' ' . $report->phone_model }}</td>
                                        <td>{{ $report->count }}</td>
                                        <td>{{ $report->reported_at }}</td>
                                        <td>
                                            <a href="#" data-id={{ $report->id }}
                                                data-package={{ $report->package_name }}
                                                data-version={{ $report->app_version_code }}
                                                data-exception={{ $report->exception }}
                                                class="btn btn-sm btn-danger delete" data-toggle="modal"
                                                data-target="#deleteReportsModal">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- {{ $data->links() }} --}}
                </div>
            </div>
        </div>
        <!-- Delete Warning Modal -->
        <div class="modal modal-danger fade" id="deleteReportsModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('/reports') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Reports</h5>
                        </div>
                        <input type=hidden id="id" name="id">
                        <div class="modal-body">
                            <p>Are you sure want to delete it all ?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Delete Modal -->
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function() {
                let id = $(this).attr('data-id')
                console.log(id)
                $('#id').val(id)
            })

            $('#dataTable').DataTable({});
        })
    </script>
@endsection
