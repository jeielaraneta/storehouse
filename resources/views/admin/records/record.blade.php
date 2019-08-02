@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="row mb-2 text-left">
        <div class="col-md-12 ">
            <create-button route="{{ route('record.create') }}" btn-text="Add New Record" btn-icon="plus"></create-button>
        </div>        
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header bg-transparent border-primary"><h5>List of Records</h5></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="recordsTable" class="table table-bordered table-striped display cell-border" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Giver's Identicifation</th>
                                    <th>Giver Type</th>
                                    <th>Total Amount</th>
                                    <th>Date Offered</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ( count($records) > 0 )
                                    @foreach ($records as $record)
                                        <tr>
                                            <td>{{$record->agc}}</td>
                                            <td>{{$record->giver_type}}</td>
                                            <td>&#8369;{{$record->total_amount}}</td>
                                            <td>{{$record->given_at}}</td>
                                            <td>{{$record->created_at}}</td>
                                            <td>{{$record->status}}</td>
                                            <td><show-button route="{{ route('record.show', $record->id)}}" btn-text="View"></show-button></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Giver's Identicifation</th>
                                    <th>Giver Type</th>
                                    <th>Total Amount</th>
                                    <th>Date Offered</th>
                                    <th>Date Created</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>

            <record-index-component></record-index-component>

        </div>
    </div>
</div>
@endsection