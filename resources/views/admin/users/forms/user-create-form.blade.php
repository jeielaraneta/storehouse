@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif

            <user-create-form submit-user-route="{{ route('register') }}"></user-create-form>

        </div>
    </div>
</div>
@endsection
