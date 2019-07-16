@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
      
        <record-profile-component :records="{{ json_encode($records) }}" :special-offerings="{{json_encode($specialOfferings)}}" update-record-route="{{ route('record.update', $records->id )}}" ></record-profile-component>

    </div>
</div>
@endsection