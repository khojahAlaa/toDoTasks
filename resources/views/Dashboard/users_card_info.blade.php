@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify content center mt-5">
    @if($UsersBelongToDep->count() ==0)
        <div class="row justify-content-center mt-5" style="color:coral">
            <h1 >NO Users Belong To This Department</h1>
        </div>
    @else
    @foreach($UsersBelongToDep as $UserBelongToDep)
        <div class="col-xl-3 col-md-6 col-sm-12 d-flex pb-3">
        @include('_shared._sharedInfoCard',[
                'model'=> $UserBelongToDep,
                'totalTitle'=>'Total Tasks',
                'modelTotal'=> $UserBelongToDep->tasks,
                'completed'=>'Completed Tasks',
                'modelCompleted'=> $UserBelongToDep->tasks->where('is_done',1),
                ])
        </div>
    @endforeach 
    @endif 
    </div>
</div>

@endsection
