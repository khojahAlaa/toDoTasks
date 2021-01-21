@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
    <!-- /pages/task/MyTasks.vue' -->
    <!-- pass data from mytask controller via blade to mytask component prop -->
        <my-created-tasks 
            :todaydone="{{$todayMyDoneTasks}}"
            :todaytodo="{{  json_encode($todayMyToDoTasks) }}"
            :tomorrowdone="{{$tomorrowMyDoneTasks}}"
            :tomorrowtodo="{{ json_encode($tomorrowMyToDoTasks) }}"
            :somedaytodo="{{$myToDoTasks}}"
            :somedaydone="{{$myDoneTasks}}"
            :overdue="{{json_encode($overdueTasks)}}"
            :countall="{{$countAllMyTasks}}"
        ></my-created-tasks>
    </div>
</div>

<!-- :todaytodo="{{$todayMyToDoTasks}}" -->
@endsection

