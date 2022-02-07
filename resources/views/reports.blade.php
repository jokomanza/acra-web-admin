@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <a href="{{ url()->previous() }}" class="btn btn-default hide">Back</a>
                <div class="panel-heading">Reports for {{ $app->name }} ({{ $app->package_name }})</div>

                <div class="panel-body">

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-responsive table-bordered table-hover mb-0"
                            style="overflow-x: auto;">
                            <thead>
                                <th>Date</th>
                                <th>App Version</th>
                                <th>Android Version</th>
                                <th>Device</th>
                                <th>Exception</th>
                                <th>Delete</th>
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
                                            {{ $report->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            {{ $report->app_version_name }}
                                        </td>
                                        <td>
                                            {{ $report->android_version }}
                                        </td>
                                        <td>
                                            {{ $report->brand . ' ' . $report->phone_model }}
                                        </td>
                                        <td>
                                            <a class="text-danger"
                                                href="{{ url('/report/' .$report->report_id) }}">{{ $report->exception }}</a>
                                        </td>
                                        <td>
                                            <i class="fa fa-trash"></i>
                                            {{-- <i href="#" data-id={{ $report->id }}
                                                class="fas trash-alt" data-toggle="modal"
                                                data-target="#deleteReportsModal">Delete</i> --}}
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
                let id = $(this).attr('data-package')
                let id = $(this).attr('data-version')
                let id = $(this).attr('data-exception')
                console.log(id)
                $('#id').val(id)
            })

            $('#dataTable').DataTable({});
        })
    </script>
@endsection
