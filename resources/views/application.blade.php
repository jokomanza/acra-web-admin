@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Application #{{ $data->id }}</div>

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


                    <p>Name : {{ $data->name }}</p>
                    <p>Package Name : {{ $data->package_name }}</p>
                    <p>Token : {{ $data->token }}</p>

                    <a class="btn btn-sm btn-success"
                        href="{{ url('/application', ['id' => $data->id]) }}">Edit</a>

                    <a href="#" data-id={{ $data->id }} class="btn btn-sm btn-danger" data-toggle="modal"
                        data-target="#deleteModal">Delete</a>

                    <a href="{{ url('/application/' . $data->id . '/reports') }}" class="btn btn-sm btn-primary" >See Reports</a>

                </div>
            </div>
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
