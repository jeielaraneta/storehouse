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

            <div class="card">
                <div class="card-header">Members</div>
                <div class="card-body">
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
                                        <td><member-show-button show-member-route=""></member-show-button></td>
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

            <member-index-component></member-index-component>

        </div>
    </div>
</div>
@endsection