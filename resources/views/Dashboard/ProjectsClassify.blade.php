
@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="row"> <h4 style="color:coral">Your Managed Projects</h4></div>
            @if($projects->count() == 0)
            <div class="row justify-content-center mt-5">
                <h1 >0 project</h1>
            </div>
            @else
            <div class="row">
                @foreach($projects as $project)
                    <div class="col-xl-3 col-md-6 col-sm-12 d-flex pb-3">
                            @include('_shared._sharedProjectCard',[
                            'model'=> $project,
                            ])
                    </div>
                @endforeach 
            </div> 
            @endif
        </div>    
    </div>
    <div class="row justify-content-center mt-3">{{$projects->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</div>
</div>

@endsection
