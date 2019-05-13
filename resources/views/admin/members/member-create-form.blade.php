@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <member-create-form submit-member-route="{{ route('member-store') }}"></member-create-form>

        </div>
    </div>
</div>
@endsection
