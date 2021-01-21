@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">FILTER</div>

                <div class="card-body">
                    <form class="form-inline justify-content-center" action= "{{route('filter-users')}}" method="GET">
                        <!-- @csrf -->
                        <select name="role" class="form-control form-control-lg">
                            <option> -select a Role-</option>
                            @foreach($roles as $role)
                                <option  value="{{$role->id}}">{{$role->title}}</option>
                            @endforeach  
                        </select>
                        <select name="Departments"  class="form-control form-control-lg">
                            <option  > -select a department-</option>
                            @foreach($departments as $department)
                                <option  value="{{$department->id}}" >{{$department->name}}</option>
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

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Users
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">add new user </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('save-user') }}" method="POST">
                         @csrf
                         <!-- name -->
                        <div class="form-group">
                            <div class="input-group-prepend ">
                                <span class="input-group-text">
                                    <i aria-hidden="true" class="fa fa-user"></i>
                                </span>
                                <input type="text" name="name" placeholder="User name" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}">
                                
                            </div>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </div>
                            @endif
                        </div>
                        <!-- email -->
                        <div class="form-group">
                            <div class="input-group-prepend " >
                                <span class="input-group-text">
                                    <i class="fas fa-at"></i> 
                                </span>
                                <input  type="text" name="email" placeholder="email@example.com"  class="form-control {{$errors->has('email') ? 'is-invalid' : '' }}">
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </div>
                                @endif
                            </div> 
                            
                        
                        </div>
                        <!-- password -->
                        <div class="form-group">
                            <div class="input-group-prepend " >
                            <span class="input-group-text" >
                            
                                <i class="fas fa-lock"></i> 
                            </span>
                            <input  type="password" name="password" placeholder="password"  class="form-control {{$errors->has('password') ? 'is-invalid' : '' }}">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('password')}}</strong>
                                    </div>
                                @endif
                            </div> 
                                
                        </div>
                        <!-- User Type -->
                        <div class="form-group">
                            <div class="input-group-prepend " >
                                <span class="input-group-text" >
                                
                                    <i class="fas fa-user-tag"></i> 
                                </span>
                                <select name="role" class="form-control {{$errors->has('role') ? 'is-invalid' : '' }}" >
                                    <option value=""> -select a Role-</option>
                                    @foreach($roles as $role)
                                        <option  value="{{$role->id}}">{{$role->title}}</option>
                                    @endforeach  
                                   
                                </select>
                                @if ($errors->has('role'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('role')}}</strong>
                                    </div>
                                @endif
                            </div>         
                        </div>
                    <!-- User dep -->
                        <div class="form-group">
                            <div class="input-group-prepend " >
                                <span class="input-group-text" >
                                
                                    <i class="fas fa-building"></i> 
                                </span>
                                <select name="Departments"  class="form-control {{$errors->has('Departments') ? 'is-invalid' : '' }}"  >
                                    <option  value=""> -select a department-</option>
                                    @foreach($departments as $department)
                                        <option  value="{{$department->id}}" >{{$department->name}}</option>
                                    @endforeach 
                                   
                                 </select>
                                @if ($errors->has('Departments'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('Departments')}}</strong>
                                    </div>
                                @endif 
                            </div>         
                        </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-success" >Create</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
                
                </div>

                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">photo</th>
                            <th scope="col">User name</th>
                            <th scope="col">frist name</th>
                            <th scope="col">last name</th>
                            <th scope="col">email</th>
                            <th scope="col">role</th>
                            <th scope="col">department</th>
                            <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>
                                    
                                    @if(empty($user->photo))
                                    <img src="{{asset('img/man.png')}}" style="vertical-align: middle;width: 50px; height: 50px; border-radius: 50%;"
                                    class="avatar avatar-16 img-circle" title="" alt="">
                                    @else
                                    <img src="{{asset('uploads/avatar')}}/{{$user->photo}}" style="vertical-align: middle;width: 50px; height: 50px; border-radius: 50%;"
                                    class="avatar avatar-16 img-circle" title="" alt="">
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->first_name}}</td>
                                <td>{{$user->last_name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role->title}}</td>
                                <td>{{$user->department->name}}</td> 
                                <td>  
                                    <!-- <a href="#" class="" style="color: red;">
                                    <i class="fas fa-trash"></i>            
                                    </a> -->

                                   
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$user->id}}">
                                         <i class="far fa-edit"></i>  
                                    </button>
<!-- model -->
                                    <div class="modal fade" id="Modal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">add user</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form action="{{ route('update-user', ['id' => $user->id]) }}" method="POST">
                                        @csrf 
                                       
                                            
                                            <!-- name -->
                                            
                                            <div class="form-group">
                                                <div class="input-group-prepend ">
                                                    <span class="input-group-text">
                                                        <i aria-hidden="true" class="fa fa-user"></i>
                                                    </span>
                                                    <input type="text" value="{{ $user->name }}" name="name" placeholder="User name" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}">
                                                    @if ($errors->has('name'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{$errors->first('name')}}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- email -->
                                            <div class="form-group">
                                                <div class="input-group-prepend " >
                                                    <span class="input-group-text">
                                                        <i class="fas fa-at"></i> 
                                                    </span>
                                                    <input  type="text"  value="{{$user->email}}" name="email" placeholder="email@example.com"  class="form-control {{$errors->has('email') ? 'is-invalid' : '' }}"
                                                    >
                                                    @if ($errors->has('email'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{$errors->first('email')}}</strong>
                                                        </div>
                                                    @endif
                                                </div> 
                                                
                                            
                                            </div>
                                            <!-- password -->
                                            <div class="form-group">
                                                <div class="input-group-prepend " >
                                                    <span class="input-group-text" >
                                                        <i class="fas fa-lock"></i> 
                                                    </span>
                                                    <input  type="password"  value="{{$user->password}}" name="password" placeholder="password"  class="form-control {{$errors->has('password') ? 'is-invalid' : '' }}">
                                                    @if ($errors->has('password'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{$errors->first('password')}}</strong>
                                                        </div>
                                                    @endif
                                                </div>    
                                            </div>
                                            <!-- User Type -->
                                            <div class="form-group">
                                                <div class="input-group-prepend " >
                                                    <span class="input-group-text" >
                                                    
                                                        <i class="fas fa-user-tag"></i> 
                                                    </span>
                                                    <select name="role"   class="form-control {{$errors->has('role') ? 'is-invalid' : '' }}">
                                                        <option  value=""> -select a Role-</option>
                                                        
                                                        @foreach($roles as $role)
                                                            <option  value="{{$role->id}}" {{$user->role_id == $role->id  ? 'selected' : ''}} >
                                                                {{$role->title}}
                                                            </option>
                                                        @endforeach 
                                                        
                                                    </select>
                                                    @if ($errors->has('role'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{$errors->first('role')}}</strong>
                                                        </div>
                                                    @endif 
                                                </div>         
                                            </div>
                                        <!-- User dep -->
                                            <div class="form-group">
                                                <div class="input-group-prepend " >
                                                    <span class="input-group-text" >
                                                    
                                                        <i class="fas fa-building"></i> 
                                                    </span>
                                                    <select name="Departments" value="{{$user->department->name}}"  class="form-control {{$errors->has('Departments') ? 'is-invalid' : '' }}">
                                                        <option  value="" > -select a department-</option>
                                                        @foreach($departments as $department)
                                                            <option  value="{{$department->id}}" {{$user->dep_id == $department->id  ? 'selected' : ''}} >
                                                                {{$department->name}}
                                                            </option>
                                                        @endforeach  
                                                    </select>
                                                    @if ($errors->has('Departments'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{$errors->first('Departments')}}</strong>
                                                        </div>
                                                    @endif 
                                                </div>         
                                            </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit"  class="btn btn-success" >update</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                    
                                    </div>
                                                    

                                    <form action="{{ route('del-user', ['id' => $user->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash" style="color: white;"></i>
                                        </button>
                                    </form> 
                                    <a class="btn btn-success" href="{{ route('show-user-profile', ['id' => $user->id]) }}" >
                                        <i class="fas fa-eye" style="color: white;"></i>
                                    </a>

                               </td> 
                            </tr>
                        @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-3">
        {{$users->appends(Illuminate\Support\Facades\Request::except('page'))->links()}}
    </div>

</div>


@endsection
