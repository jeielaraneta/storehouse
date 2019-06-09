@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-2 text-left">
        <div class="col-md-12 ">
            <record-create-button create-record-route="{{ route('record.create') }}"></record-create-button>
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
                <div class="card-header">Records</div>
                <div class="card-body">
                   
                </div>
            </div>

            

        </div>
    </div>
</div>
@endsection