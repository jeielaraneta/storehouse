@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
      
            
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

            {{$memberData}}

            <member-profile-component :member-data="{{ json_encode($memberData) }}" update-member-route="{{ route('member.update', $memberData->id) }}"></member-profile-component>

     
    </div>
</div>
@endsection