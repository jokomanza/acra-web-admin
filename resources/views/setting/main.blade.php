@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">General</div>

                <div class="panel-body">
                    
                    <p class="title bold">Logs</p>
                    <a href="{{ route('setting.log') }}">See application logs</a>
                    
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Email Report Recipients</div>

                <div class="panel-body">
                    <p>Set who will receive notification emails when an app has a problem.</p>

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

                    <div class="col-md-4">
                        <form action="{{ route('setting.email.store') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="text" class="form-control" id="email" placeholder="mail@quick.com" name="email"
                                    value="{{ Input::old('email') }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="name"
                                    name="name" value="{{ Input::old('name') }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>

                    <div class="col-md-8">
                        
                        <div class="table-responsive" style="margin-top: 11px">
                            <table id="dataTable" class=" table table-responsive table-bordered table-hover mb-0"
                                style="overflow-x: auto;">
                                <thead>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @if ($emails->count() == 0)
                                        <tr>
                                            <td colspan="5">No Emails to display.</td>
                                        </tr>
                                    @endif

                                    @foreach ($emails as $email)
                                        <tr>
                                            <td>{{ $email->email }}</td>
                                            <td>{{ $email->name }}</td>
                                            <td>

                                                <a href="#" data-email={{ $email->email }} class="btn btn-sm btn-danger delete {{ $email->email == 'joko_supriyanto@quick.com' ? 'hide' : '' }}"
                                                data-toggle="modal" data-target="#deleteModal">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        {{ $emails->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Delete Warning Modal -->
    <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('/recipients/email') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Email</h5>
                    </div>
                    <input type=hidden id="delete-email" name="email">
                    <div class="modal-body">
                        <p>Are you sure want to remove this email ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Email</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->

    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete', function() {
                let email = $(this).attr('data-email')
                console.log(email)
                $('#delete-email').val(email)
            })

            $('#dataTable').DataTable({});
        })
    </script>
@endsection
