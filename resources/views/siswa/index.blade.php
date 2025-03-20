@extends('layouts.app')
@section('content')

<div id="app">
    <div id="main">
        <!-- side bar -->
        @include('siswa.sidebar')
        <!-- end side bar -->

        @yield('contentSiswa')

        @include('footer')
    </div>
</div>

@endsection