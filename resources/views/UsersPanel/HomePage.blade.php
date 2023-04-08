<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <title>Home Page</title>
</head>
    <body>

    @include('UsersPanel.Nav.navBar')


        <h1 class="text-center mt-5">Users Panel of Project</h1>
    <hr>
    <div class="container-fluid">
        <div class="row justify-content-center">
        <div class="card-group">
            
@if ($projects)            
    @foreach ($projects as $project)

    <div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">

  <div class="card m-2" class="ml- 5 mt-5 mb-5 p-2" style="width: 20rem;">
  <img src="/images/{{$project->thumbnail}}" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title">{{$project->title}}</h5>
      <p class="card-text"><b>Category: {{$project->category->name}}</b></p>
      <a href="{{$project->github_link}}" target="_blank" class="btn btn-primary">Git</a>
      <a href="{{$project->youtube_link}}" target="_blank" class="btn btn-danger">Youtube</a>
      <a href="{{route('projects.detail', $project->id)}}" class="btn btn-success">Details</a>
    </div>
  </div>
  </div>
  </div>
  @endforeach
@endif
</div>

<div class="container">
@include('UsersPanel.skill.show_skill_chart')

</div>

    </div>
    <span>{{ $projects->links() }} </span>
</div>

    </body>
</html>










