
@if($model instanceof App\Project && $model == $project->startDate) 
    @php
        $model =\Carbon\Carbon::parse($project->startDate)->format("d/m/Y")
    @endphp
@elseif ($model instanceof App\Project && $model == $project->dueDate)
    @php
        $model =\Carbon\Carbon::parse($project->dueDate)->format("d/m/Y")
    @endphp
@endif


<div class="col">
    <div class="card bg-light ">
        <div class="card-body text-center">
        <div class="row ">
            <div class="col-md-3">
                <i class="{{$icon}}" style="color: cornflowerblue;"></i>
            </div>
            <div class="col-md-9">
                <h5 class="card-title">{{$lable}}</h5>
                <p class="card-text"><h6  class="text-muted">
                    {{$model}}
                </h6></p>
                @if($url ?? '' != '')
                <p class="card-text"><a href="{{$url}}" class="text-muted">
                    More Info &nbsp <i class="fas fa-long-arrow-alt-right"></i>
                </a></p>
                @endif
            </div>
        </div>
        </div>
    </div>
</div>
