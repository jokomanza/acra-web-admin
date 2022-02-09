@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading">Logs in {{ $date ? $date->toFormattedDateString() : Carbon::now()->toFormattedDateString() }}
                </div>

                <div class="panel-body">
                    <form action="{{ route('setting.log') }}">
                        <input type="date" name="date"
                            value="{{ $date ? $date->format('Y-m-d') : Carbon::now()->format('Y-m-d') }}">
                        <button class="btn btn-sm button-primary" type="submit">Get</button>
                    </form>

                    @if (empty($data['file']))
                        <div>
                            <h3>No Logs Found</h3>
                        </div>
                    @else
                        <div>
                            <h5>Updated On : <b>{{ $data['lastModified']->format('Y-m-d h:i a') }}</b> </h5>
                            <h5>File Size : <b>{{ round($data['size'] / 1024) }} KB</b> </h5>
                            <pre>{{ $data['file'] }}</pre>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
