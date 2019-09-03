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

                    <div class="table-responsive">
                        <table id="usersTable" class="table table-bordered table-striped display cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Date Verified</th>
                                    <th>Password Reset</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( count($users) > 0 )
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td></td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td></td>
                                            <td></td>
                                            <td><show-button route="{{ route('user.show', $user->id)}}" btn-text="View"></show-button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Date Verified</th>
                                    <th>Password Reset</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection