
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
        @if(empty($model->photo))
            <img class="rounded-circle img-fluid mb-3"  style="vertical-align: middle;width: 200px; height: 200px; border-radius: 200%;"
            src="{{asset('img/man.png')}}" >
        @else
            <img class="rounded-circle img-fluid mb-3"  style="vertical-align: middle;width: 200px; height: 200px; border-radius: 200%;"
            src="{{asset('uploads/avatar')}}/{{$model->photo}}">
        @endif
        </div>

        <h3 class="profile-username text-center">{{$model->name}}</h3>

        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
            <b>{{$totalTitle}}</b> <a class="float-right">{{$modelTotal->count()}}</a>
            </li>
            <li class="list-group-item">
            <b>{{$completed}}</b> <a class="float-right">{{$modelCompleted->count()}}</a>
            </li>
        </ul>

        <a href="{{ route('show-user-profile', ['id' =>$model->id]) }}" class="btn btn-primary btn-block"><b>Profile</b></a>
    </div>
    <!-- /.card-body -->
</div>