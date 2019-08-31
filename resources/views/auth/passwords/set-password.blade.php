@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            @if (session('fail'))
                <div class="alert alert-danger" role="alert">
                    {{ session('fail') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <user-password-form submit-user-password-route="{{ route('update.password', $user_id) }}" user-id="{{$user_id}}"></user-password-form>
        </div>

    </div>
</div>
@endsection
