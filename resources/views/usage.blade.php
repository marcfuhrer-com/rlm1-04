@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Usage') }}</div>

                    <div class="card-body">

                        Hello {{ $name }} </br></br>

                        @if ($pubDataName == "")
                            You are no publisher.
                        @elseif ($pubDataName == "admin")
                            @foreach ($data as $entry)
                                Stats for entry {{ $entry['name'] }}:</br>
                                Last entry created at {{ $entry['createdAt'] }}</br>
                                Last entry updated at {{ $entry['updatedAt'] }}</br>
                                Subscribed {{ $entry['subscribed'] }} times</br></br>
                            @endforeach
                        @else
                            Your data "{{ $pubDataName }}" is currently subscribed {{ $data }} times.

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
