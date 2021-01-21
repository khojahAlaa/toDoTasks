@extends('layouts.app1')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
       <pm-user-dashboard 
       :assignedtasks="{{  json_encode($assignedTasks) }}" 
       :nprojects="{{  json_encode($countprojects) }}" 
       :mytasks= "{{  json_encode($myTasks) }} "
       :tracker="{{ json_encode($tasksTracker) }}"
       ></pm-user-dashboard>
      
    </div>
</div>

@endsection



