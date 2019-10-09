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
                        <table id="recordsTable" class="table table-bordered table-striped display cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Date Verified</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( count($users) > 0 )
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->first_name}} {{$user->last_name}}</td>
                                            <td>{{$user->username}}</td> <!-- &#8369; -->
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->created_at}}</td>
                                            <td>{{$user->email_verified_at}}</td>
                                            <td>{{$user->status}}</td>
                                            <td><show-button route="{{ route('user.show', $user->id)}}" btn-text="View"></show-button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>Date Created</th>
                                    <th>Date Verified</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection