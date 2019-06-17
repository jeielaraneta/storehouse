@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-2 text-left">
        <div class="col-md-12 ">
            <create-button route="{{ route('member.create') }}" btn-text="Add New Member" btn-icon="user-plus"></create-button>
        </div>        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><br />
            @endif

            <div class="card">
                <div class="card-header bg-transparent border-primary"><h5>Members</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="membersTable" class="table table-bordered table-striped display cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Membership Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( count($members) > 0 )
                                     @foreach ($members as $member)
                                        <tr>
                                            <td>{{$member->code}}</td>
                                            <td>{{$member->first_name . ' ' . $member->last_name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>{{$member->membership_status}}</td>
                                            <td>{{$member->created_at}}</td>
                                            <td><show-button route="{{ route('member.show', $member->id) }}" btn-text="View"></show-button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Membership Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <member-index-component></member-index-component>

        </div>
    </div>
</div>
@endsection