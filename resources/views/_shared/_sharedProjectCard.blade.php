<div class="card-deck " >
    <div class="card-body card border-secondary mt-5 mb-5 ">
        <h5 class="card-title">{{ str_limit($model->name, 15) }} </h5>
        <h6 class="card-subtitle mb-2 text-muted">project manager: {{$model->projectmanager['name']}} </h6>
        <h6 class="card-subtitle mb-2 text-muted">project statuse: {{$model->pstatues['name']}}</h6>
        <p class="card-text">description : {{ str_limit($model->description, 100) }} </p>
        <a href="/projectDetails/{{$project->id}}" class="card-link">show detailes</a>
    </div>
</div>