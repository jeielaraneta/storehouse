@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-12">
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </div>

        <user-password-form submit-user-password-route="{{ route('update.password') }}"></user-password-form>

    </div>
</div>
@endsection
