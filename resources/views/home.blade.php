@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @component('components.card')
                @slot('title')
                    {{ __('Dashboard') }}
                @endslot

                <p>
                    Welcome back {{ auth()->user()->name }}
                </p>
            @endcomponent
        </div>
    </div>
</div>
@endsection
