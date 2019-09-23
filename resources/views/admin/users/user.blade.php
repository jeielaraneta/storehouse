@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-2 text-left">
        <div class="col-md-12 ">
            <create-button route="{{ route('user.create') }}" btn-icon="fas fa-user-plus" btn-text="Add New User"></create-button>
        </div>        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header bg-transparent border-primary"><h5>List of Users</h5></div>
                <div class="card-body">
                    Coming soon!

                    {{ $users }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection