@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Add Application</div>

                <div class="panel-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if ($errors->has('*'))
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{ url('application') }}" method="POST">
                        <div class="form-group">
                            <label for="name">Application Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Application name"
                                name="name" value="{{ Input::old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="package_name">Package Name</label>
                            <input type="text" class="form-control" id="package_name" placeholder="com.example"
                                name="package_name" value="{{ Input::old('package_name') }}">
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Applications</div>

                <div class="panel-body">
                    @if (session()->has('table-message'))
                        <div class="alert alert-success">
                            {{ session()->get('table-message') }}
                        </div>
                    @endif
                    @if (session()->has('table-error'))
                        <div class="alert alert-danger">
                            {{ session()->get('table-error') }}
                        </div>
                    @endif
                    <div class="" style="margin-bottom: 1.5rem">
                        <form action="{{ route('application.index') }}" class="mb-1" method="GET" role="search">

                            <input type="text" class="form-control" name="search" placeholder="Search Application"
                                id="search">

                        </form>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTable" class=" table table-responsive table-bordered table-hover mb-0"
                            style="overflow-x: auto;">
                            <thead>
                                <th>Name</th>
                                <th>Package Name</th>
                                <th>Token</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @if ($applications->count() == 0)
                                    <tr>
                                        <td colspan="5">No Application to display.</td>
                                    </tr>
                                @endif

                                @foreach ($applications as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->package_name }}</td>
                                        <td>{{ $product->token }}</td>
                                        <td>
                                            {{-- <a class="btn btn-sm btn-success"
                                            href="{{ action('ApplicationController@edit', ['id' => $product->id]) }}">Edit</a> --}}

                                            {{-- <a href="#" data-id={{ $product->id }} class="btn btn-sm btn-primary"
                                                data-toggle="modal" data-target="#deleteModal">View</a> --}}

                                            <a href="{{ url('/application/' . $product->id) }}"
                                                data-id={{ $product->id }} class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Warning Modal -->
    <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/application') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Contact</h5>
                    </div>
                    <input type=hidden id="id" name="id">
                    <div class="modal-body">
                        <p>Are you sure want to delete this Application ?</p>
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
