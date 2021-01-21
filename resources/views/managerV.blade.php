@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Departments</div>

                <div class="card-body">
                    
                        <select name="manager" class="form-control form-control-lg">
                            <option> -select a manager-</option>
                            @foreach($managers as $manager)
                                <option  value="{{$manager->id}}">{{$manager->name}}</option>
                            @endforeach  
                        </select>

                        <br>

                    <br><br>
                </div>
            </div>
        </div>
    </div>

   

    
</div>

@endsection
