@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
      
        <record-profile-component :record-data="{{ json_encode($recordData) }}" :special-offerings-data="{{json_encode($specialOfferingsData)}}" update-record-route="{{ route('record.update', $recordData->id )}}" ></record-profile-component>

    </div>
</div>
@endsection