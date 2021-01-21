@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>All Departments</h1>
                        <div class="ml-auto">
                            <a href="{{ url('newDepartment') }}" class="btn btn-outline-secondary">
                                Create new Department
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action= "{{route('filterBased-department')}}" method="GET">
                        <!-- @csrf -->
                        <select name="Departments" class="form-control form-control-lg">
                            <option> -select a department-</option>
                            @foreach($departments as $department)
                                <option  value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach  
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-12 ">
            <div class="card">
                <div class="card-header">filtered Projects based on department</div>
                <div class="card-body d-flex justify-items-center">
                    <div class="row justify-content-center">
                        @foreach($projects as $project)
                            <div class="col-xl-4 col-md-6 col-sm-12 d-flex pb-3">
                                @include('_shared._sharedProjectCard',[
                                'model'=> $project,
                                ])
                            
                            </div>
                        @endforeach 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">{{$projects->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}</div>
</div>

@endsection
