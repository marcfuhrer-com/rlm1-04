@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usage') }}</div>

                <div class="card-body">

                    Hello {{ $name }}</br>

                    @if ($pubDataName == "")
                        You are no publisher.
                    @else
                        Your data "{{ $pubDataName }}" is currently subscribed {{ $data }} times.

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
