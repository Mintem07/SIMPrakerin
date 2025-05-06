@extends('layouts.app')
@section('content')

<div id="app">
    @include('siswa.sidebar')
    <div id="main">
        @yield('contentSiswa')
        @include('footer')
    </div>
</div>

<script src="{{asset('assets/vendors/simple-datatables/simple-datatables.js')}}"></script>

@yield('scripts')

@endsection