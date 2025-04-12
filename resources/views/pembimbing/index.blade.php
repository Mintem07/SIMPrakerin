@extends('layouts.app')
@section('content')

<div id="app">
    @include('pembimbing.sidebar')
    <div id="main">
        @yield('contentPembimbing')
        @include('footer')
    </div>
</div>

<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>

@yield('scripts')

@endsection