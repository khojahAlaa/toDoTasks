@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <h1 style="color: coral;"> &nbsp&nbsp Dashboard</h1>
        <div class="ml-auto"><a href="" > SEE Chart </a>  </div>
    </div>
    <div class="row justify-content-center mt-5"> 
        @include('_shared._sharedStaticCard',[
            'lable' => 'Total NO. of projects ',
            'model' => $totalProjects,
            'icon' => "fas fa-folder-open fa-3x",
            'url' => "AllProjects",
        
        ]) 
        @include('_shared._sharedStaticCard',[
            'lable' => 'Total NO. of projects you create',
            'model' => $projectsCreatedByMe,
            'icon' => "fas fa-marker fa-3x",
            'url' => "projectsRelatedToManager/projectsCreatedByMe",
        ]) 
    </div>
    <div class="row justify-content-center mt-5">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h3 style="color: coral;">Projects Departments</h3>
                </div> 
            </div>
            <div class="card-body"> 
                <div class="row mb-3">
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'E-health Dep',
                        'modelprojects' => $EhealthProject,
                        'urlproj' => "belongToDep/projects/1",
                        'modelManagers' => $EhealthManagers,
                        'urlmanager' => "belongToDep/managers/1",
                        'modelUsers' => $EhealthUsers,
                        'urluser' => "belongToDep/users/1",
                        'icon' => "far fa-building fa-3x",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'Biomedical Dep',
                        'modelprojects' => $BiomedicalProject,
                        'modelManagers' => $BiomedicalProjectManagers,
                        'modelUsers' => $BiomedicalProjectUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/2",
                        'urlmanager' => "belongToDep/managers/2",
                        'urluser' => "belongToDep/users/2",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'Medical Supply Dep',
                        'modelprojects' => $medicalSupplyProject,
                        'modelManagers' => $medicalSupplyManagers,
                        'modelUsers' => $medicalSupplyUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/3",
                        'urlmanager' => "belongToDep/managers/3",
                        'urluser' => "belongToDep/users/3",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'follow-UP Dep',
                        'modelprojects' => $followUPProject,
                        'modelManagers' => $followUPManagers,
                        'modelUsers' => $followUPUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/4",
                        'urlmanager' => "belongToDep/managers/4",
                        'urluser' => "belongToDep/users/4",
                    ])  
                </div>
                <div class="row mb-3">
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'P.t Relation Dep',
                        'modelprojects' => $PtRelationProject,
                        'modelManagers' => $PtRelationManagers,
                        'modelUsers' => $PtRelationUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/5",
                        'urlmanager' => "belongToDep/managers/5",
                        'urluser' => "belongToDep/users/5",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'Inventory Ctrl Dep',
                        'modelprojects' => $InventoryCtrlProject,
                        'modelManagers' => $InventoryCtrlManagers,
                        'modelUsers' => $InventoryCtrlUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/6",
                        'urlmanager' => "belongToDep/managers/6",
                        'urluser' => "belongToDep/users/6",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'Physiotherapy Dep',
                        'modelprojects' => $PhysiotherapyProject,
                        'modelManagers' => $PhysiotherapyManagers,
                        'modelUsers' => $PhysiotherapyUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/7",
                        'urlmanager' => "belongToDep/managers/7",
                        'urluser' => "belongToDep/users/7",
                    ])
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'IPCD',
                        'modelprojects' => $IPCDProject,
                        'modelManagers' => $IPCDManagers,
                        'modelUsers' => $IPCDUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/8",
                        'urlmanager' => "belongToDep/managers/8",
                        'urluser' => "belongToDep/users/8",
                    ])  
                </div>
                <div class="row mb-3">
                    @include('_shared._sharedStaticDepCard',[
                        'lableprojects' => 'Nursing Dep',
                        'modelprojects' => $NursingProject,
                        'modelManagers' => $NursingManagers,
                        'modelUsers' => $NursingUsers,
                        'icon' => "far fa-building fa-3x",
                        'urlproj' => "belongToDep/projects/12",
                        'urlmanager' => "belongToDep/managers/12",
                        'urluser' => "belongToDep/users/12",
                    ])
                    <div class="col"></div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 style="color: coral;">Projects Status</h3>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. of Completed Project',
                            'model' => $numOfCompletedProject,
                            'icon' => "fas fa-check-circle fa-3x",
                            'url' => "projectsRelatedToManager/Completed"
                        
                        ])
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. of Project in Implementing',
                            'model' => $numOfImplementProject,
                            'icon' => "fas fa-spinner fa-3x",
                            'url' => "projectsRelatedToManager/ImplementingS"
                        
                        ])
                    </div> 
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. of Holded Project',
                            'model' => $numOfHoldProject,
                            'icon' => "far fa-pause-circle fa-3x",
                            'url' => "projectsRelatedToManager/Holded"
                        ])  
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. of Project in Planning',
                            'model' => $numOfPlanningProject,
                            'icon' => "fas fa-chart-line fa-3x",
                            'url' => "projectsRelatedToManager/Planning"
                        ])
                    </div> 
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. Project in Tasting',
                            'model' => $numOfTestingProject,
                            'icon' => "fas fa-vials fa-3x",
                            'url' => "projectsRelatedToManager/Tasting"
                        ])
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. ofProject in Delayed phase',
                            'model' => $numOfDelayedProject,
                            'icon' => "far fa-eye fa-3x",
                            'url' => "projectsRelatedToManager/Delayed",
                            
                        ]) 
                    </div> 
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'NO. of Project Cancelled',
                            'model' => $numOfCancelledProject,
                            'icon' => "fas fa-window-close fa-3x",
                            'url' => "projectsRelatedToManager/Cancelled"
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
                        <h3 style="color: coral;">Projects Type </h3>
                    </div> 
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Technical projects',
                            'model' => $Technical,
                            'icon' => "fas fa-laptop-code fa-3x",
                            'url' => "projectsRelatedToManager/Technical",
                        ]) 
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Social project',
                            'model' => $Social,
                            'icon' => "fas fa-share-alt fa-3x",
                            'url' => "projectsRelatedToManager/Social",
                        ]) 
                    </div> 
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Medical Project',
                            'model' => $Medical,
                            'icon' => "fas fa-notes-medical fa-3x",
                            'url' => "projectsRelatedToManager/Medical"
                        
                        ]) 
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Research Project',
                            'model' => $Research,
                            'icon' => "fas fa-search fa-3x",
                            'url' => "projectsRelatedToManager/Research"
                        
                        ])
                    </div> 
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Administrative Project',
                            'model' => $Administrative,
                            'icon' => "fas fa-folder-open fa-3x",
                            'url' => "projectsRelatedToManager/Administrative"
                        
                        ])
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Maintenance Project',
                            'model' => $Maintenance,
                            'icon' => "fas fa-folder-open fa-3x",
                            'url' => "projectsRelatedToManager/Maintenance"
                        
                        ])
                    </div>
                    <div class="row mb-3">
                        @include('_shared._sharedStaticCard',[
                            'lable' => 'Mixed Project',
                            'model' => $Mixed,
                            'icon' => "fas fa-folder-open fa-3x",
                            'url' => "projectsRelatedToManager/Mixed"
                        
                        ])
                        <div class="col"></div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div> 


@endsection
