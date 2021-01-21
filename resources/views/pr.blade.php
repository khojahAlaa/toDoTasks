
@extends('layouts.app1')

@section('content')
<div class="container-fluid">
    
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card pmd-card text-center">
              <div class="card-body">
                  @if(empty($user->photo))
                  <img src="{{asset('img/man.png')}}" class="rounded-circle img-fluid mb-3" title="" alt="">
                  @else
                  <img src="{{asset('uploads/avatar')}}/{{$user->photo}}" class="rounded-circle img-fluid mb-3" title="" alt="">
                  @endif
                  <h2 class="card-text">{{ $user->first_name }}  {{ $user->last_name }}</h2>
                  <p class="card-text">
                      <b>Role: </b>{{$user->role->title}}
                  </p>
                  <p class="card-text"> <b>Department: </b>{{$user->department->name}}</p>
                  
                @if( Auth::user()->id ==  $user->id)
                    <form action="{{ route('user-photo', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" >
                     @csrf 
                        <input type="file" class="form-control" name="photo" value="{{ $user->photo }}">
                        <br>
                        <button type="submit"  class="btn btn-success" >update avatar</button>
                    </form>
                @endif
                </div>
            </div>
            
        </div>
        @if( Auth::user()->id ==  $user->id)
        <div class="col-md-4">
          <div class="card"> 
              <div class="card-header">update your info</div>
              <div class="card-body">
              <form action="{{ route('update-user-profile', ['id' => $user->id]) }}" method="POST">
                 @csrf 
               <!-- first_name -->
                
               <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            first name
                        </span>
                        <input type="text" value="{{ $user->first_name }}" name="first_name" placeholder="User first name" class="form-control {{$errors->has('first_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('first_name')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                 <!-- last_name -->
                
                 <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            last name
                        </span>
                        <input type="text" value="{{ $user->last_name }}" name="last_name" placeholder="User last name" class="form-control {{$errors->has('last_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('last_namee'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('last_name')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                  
                <!-- name -->
                
                <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            userName
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
                              userEmail
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
                               password
                          </span>
                          <input  type="password"  value="{{$user->password}}" name="password" placeholder="password"  class="form-control {{$errors->has('password') ? 'is-invalid' : '' }}">
                          @if ($errors->has('password'))
                              <div class="invalid-feedback">
                                  <strong>{{$errors->first('password')}}</strong>
                              </div>
                          @endif
                      </div>    
                  </div>
                 
                  <button type="submit"  class="btn btn-success" >update</button>
             </form>
              </div>
          </div>
        </div>
        @else
        <div class="col-md-4">
          <div class="card"> 
              <div class="card-header">Personal Information </div>
              <div class="card-body">
               <!-- first_name -->
                
               <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            first name
                        </span>
                        <input disabled type="text" value="{{ $user->first_name }}" name="first_name" placeholder="User first name" class="form-control {{$errors->has('first_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('first_name'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('first_name')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                 <!-- last_name -->
                
                 <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text" style="color: coral;">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            last name
                        </span>
                        <input disabled type="text" value="{{ $user->last_name }}" name="last_name" placeholder="User last name" class="form-control {{$errors->has('last_name') ? 'is-invalid' : '' }}">
                        @if ($errors->has('last_namee'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('last_name')}}</strong>
                            </div>
                        @endif
                    </div>
                </div>
                  
                <!-- name -->
                
                <div class="form-group">
                    <div class="input-group-prepend ">
                        <span class="input-group-text">
                            <i aria-hidden="true" class="fa fa-user"></i>
                            userName
                        </span>
                        <input disabled type="text" value="{{ $user->name }}" name="name" placeholder="User name" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}">
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
                              userEmail
                          </span>
                          <input disabled  type="text"  value="{{$user->email}}" name="email" placeholder="email@example.com"  class="form-control {{$errors->has('email') ? 'is-invalid' : '' }}"
                          >
                          @if ($errors->has('email'))
                              <div class="invalid-feedback">
                                  <strong>{{$errors->first('email')}}</strong>
                              </div>
                          @endif
                      </div> 
                </div>
              </div>
          </div>
        </div>
        @endif
        <div class="col-md-5">
          <div class="card">
                <div class="card-header">more info</div>
                @if($user->role->id != 1)
                <div class="card-body">
                    <h6 style="color:coral">
                    related project:
                    </h6>
                    @foreach($managedProjects as $managedProject)
                    <a href="/projectDetails/{{$managedProject->id}}" class="card-link"> {{$managedProject->name}}</a>
                        <br>
                    @endforeach
               
                    @foreach($createdProjects as $createdProject)
                    <a href="/projectDetails/{{$createdProject->id}}" class="card-link"> {{$createdProject->name}}</a>
                    <br>
                    @endforeach
               </div>
               @else
               <div class="card-body">
                    <h6 style="color:coral">
                    Number Of Assigned Tasks:
                    </h6>
                    <b class="d-block"> {{$user->tasks->count()}} </b>
               </div>
               @endif

          </div>
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        
        @endif

        @if ($message = Session::get('wrong'))
        <div class="alert alert-warning">
            <p>{{ $message }}</p>
        </div>
        @endif

    </div>
        
    
</div>

@endsection
