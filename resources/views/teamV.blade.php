@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All team</div>

                <div class="card-body">
                    
                       
                       
                        <select name="teams" class="form-control form-control-lg">
                            <option> -select a pearsons-</option>
                            @foreach($teams as $team)
                                <option  value="{{$team->id}}">{{$team->name}}</option>
                            @endforeach  
                        </select>

                    <br><br>
                </div>
            </div>
        </div>
    </div>

   

    
</div>

@endsection
