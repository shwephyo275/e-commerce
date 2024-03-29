@extends('layout.master')

@section('content')
<div id="root"></div>
@endsection

@section('js')
<script>
    const blade_auth_user = @json(auth()->user());
</script>
@vite(['resources/js/Profile.jsx'])
@endsection