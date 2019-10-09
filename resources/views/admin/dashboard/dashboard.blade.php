@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent border-primary"><h5>Dashboard</h5></div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <dashboard></dashboard>
                
            </div>
        </div>
    </div>
</div>
@endsection
