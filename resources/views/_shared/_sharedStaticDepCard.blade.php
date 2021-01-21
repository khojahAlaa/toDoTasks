
<div class="col">
    <div class="card bg-light" style="height: 15rem;">
        <div class="card-body text-center">
        <div class="row ">
            <div class="col-md-3">
                <i class="{{$icon}}" style="color: cornflowerblue;"></i>
            </div>
            <div class="col-md-9">
                <h5 class="card-title">{{$lableprojects}}</h5>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <a href="{{$urlproj}}" class="text-muted">
                            Projects
                        </a>
                        <b class="float-right">{{$modelprojects}}</b>
                    </li>
                    <li class="list-group-item">
                        <a href="{{$urlmanager}}" class="text-muted">
                            Managers
                        </a>
                        <b class="float-right">{{$modelManagers}}</b>
                    </li>
                    <li class="list-group-item">
                        <a href="{{$urluser}}" class="text-muted">
                            Users
                        </a>
                        <b class="float-right">{{$modelUsers}}</b>
                    </li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>
