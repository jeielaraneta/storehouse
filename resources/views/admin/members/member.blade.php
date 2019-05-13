@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-2 text-left">
        <div class="col-md-12 ">
            <member-create-button create-member-route="{{ route('member-create') }}"></member-create-button>
        </div>        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <member-index-component></member-index-component>

        </div>
    </div>
</div>
@endsection
