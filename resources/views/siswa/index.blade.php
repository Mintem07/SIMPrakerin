@extends('layouts.app')
@section('content')

<div id="app">
    @include('siswa.sidebar')
    <div id="main">
        @yield('contentSiswa')
        @include('footer')
    </div>
</div>

@yield('scripts')

@endsection