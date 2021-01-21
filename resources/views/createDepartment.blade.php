@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                create new department
                </div>
                <div class="card-body">
                <form action="{{route('save-dep')}}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="department_name">department name</label>
                        <input type="text" class="form-control" id="department_name" name="dep_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
