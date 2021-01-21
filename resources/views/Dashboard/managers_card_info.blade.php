@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify content center mt-5">
    @if($managersBelongToDep->count() ==0)
        <div class="row justify-content-center mt-5" style="color:coral">
            <h1 >NO Managers Belong To This Department</h1>
        </div>
    @else
    @foreach($managersBelongToDep as $managerBelongToDep)
        <div class="col-xl-3 col-md-6 col-sm-12 d-flex pb-3">
        @include('_shared._sharedInfoCard',[
                'model'=> $managerBelongToDep,
                'totalTitle'=>'Total Projects',
                'modelTotal'=> $managerBelongToDep->projects,
                'completed'=>'Completed Projects',
                'modelCompleted'=> $managerBelongToDep->projects->where('status_id',1),
                ])
        </div>
    @endforeach 
    @endif 
    </div>
</div>

@endsection
