@extends('layouts.app')

@section('content')
<div>
    <h1>menampilkan input baru untuk edit password</h1>
    <a href="{{ route('user.edit.password') }}">Change Password</a>

</div>
@endsection