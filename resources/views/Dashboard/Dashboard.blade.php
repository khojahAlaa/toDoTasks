@extends('layouts.app1')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
       <div class="row"><h1 style="color: coral;"> &nbsp&nbsp Dashboard</h1></div>
       <div class="ml-auto"><a href="" > SEE Chart </a>  </div>
        <div class="row">
            @include('_shared._sharedStaticCard',[
                'lable' => 'Total NO. of project related to your Dep',
                'model' => $numOfDepProject,
                'icon' => "fas fa-folder-open fa-3x",
                'url' => "departmentProjects",
            
            ]) 
            @include('_shared._sharedStaticCard',[
                'lable' => 'Total NO. of user related to your Dep',
                'model' => $numOfUserBelongToDep,
                'icon' => "fas fa-users fa-3x",
                'url' => "usersRelatedToDep",
            ]) 
            @include('_shared._sharedStaticCard',[
                'lable' => 'Total NO. of manager related to your Dep',
                'model' => $numOfManagerBelongToDep,
                'icon' => "fas fa-user-tie fa-3x",
                'url' => "managersRelatedToDep",
            
            ])
        </div>
       
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3 style="color: coral;">Your Projects Status</h3>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. of Completed Project',
                                'model' => $numOfCompletedProject,
                                'icon' => "fas fa-check-circle fa-3x",
                                'url' => "projectsRelatedToManager/CompletedProject"
                            
                            ])
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. of Project in Implementing',
                                'model' => $numOfImplementProject,
                                'icon' => "fas fa-spinner fa-3x",
                                'url' => "projectsRelatedToManager/Implementing"
                            
                            ])
                        </div> 
                        <div class="row mb-3">
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. of Holded Project',
                                'model' => $numOfHoldProject,
                                'icon' => "far fa-pause-circle fa-3x",
                                'url' => "projectsRelatedToManager/HoldProject"
                            ])  
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. of Project in Planning',
                                'model' => $numOfPlanningProject,
                                'icon' => "fas fa-chart-line fa-3x",
                                'url' => "projectsRelatedToManager/PlanningProject"
                            ])
                        </div> 
                        <div class="row mb-3">
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. Project in Tasting',
                                'model' => $numOfTestingProject,
                                'icon' => "fas fa-vials fa-3x",
                                'url' => "projectsRelatedToManager/TestingProject"
                            ])
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. ofProject in Delayed phase',
                                'model' => $numOfDelayedProject,
                                'icon' => "far fa-eye fa-3x",
                                'url' => "projectsRelatedToManager/ReviewProject",
                                
                            ]) 
                        </div> 
                        <div class="row mb-3">
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'NO. of Project Cancelled',
                                'model' => $numOfCancelledProject,
                                'icon' => "fas fa-window-close fa-3x",
                                'url' => "projectsRelatedToManager/CancelledProject"
                            ])
                        <div class="col"></div>
                        </div> 
                    </div> 
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3 style="color: coral;">Projects relate to You </h3>
                        </div> 
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'Total NO. of project you managed',
                                'model' => $numOfManagedProject,
                                'icon' => "fas fa-cogs fa-3x",
                                'url' => "MyProjects",
                            ]) 
                        
                            @include('_shared._sharedStaticCard',[
                                'lable' => 'Total NO. of project you created',
                                'model' => $numOfCreatedProject,
                                'icon' => "fas fa-marker fa-3x",
                                'url' => "projectsRelatedToManager/createdByMe",
                            ]) 
                        </div> 
                    </div> 
                </div>
            </div>
        </div>
    </div>

</div> 


@endsection

