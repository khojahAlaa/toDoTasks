
@extends('layouts.app1')

@section('content')
<div class="container-fluid" v-cloak>
    @if( Auth::user()->id ==  $user->id)
        <pm-profile :model="{{$user}}"></pm-profile>
    @endif
        <pm-other-profile :model="{{$user}}" :managedprojects="{{$managedProjects}}" :createdprojects="{{$createdProjects}}"></pm-other-profile>  

</div>


@endsection
