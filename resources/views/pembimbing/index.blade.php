@extends('layouts.app')
@section('content')

<div id="app">
    <div id="main">
        <!-- side bar -->
        @include('pembimbing.sidebar')
        <!-- end side bar -->

        @yield('contentPembimbing')

        @include('footer')
    </div>
</div>

@endsection