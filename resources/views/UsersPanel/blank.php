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


    <h1 class="text-center mt-5">Users Panel of Project Detail Page</h1>
    <hr>    
    <div class="container-fluid">
    <div class="row">
          <div class="col">
        <div class="card" class="m-2" style="width: 22rem;">
    <img src="/images/{{$project->thumbnail}}" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title">{{$project->title}}</h5>
        <h4 class="card-text"><b>Category: {{$project->category->name}}</b></h4>
    <hr>        
        <a href="{{$project->github_link}}" target="_blank" class="btn btn-primary">Git</a>
        <a href="{{$project->youtube_link}}" target="_blank" class="btn btn-danger">Youtube</a>
        <a href="" class="btn btn-success">Details</a>
    </div>
    </div>
</div>
    <div class="col-md-6 col-sm-12 col-lg-4">
              <h2>Skills:</h2>
              <hr>
            <p class="card-project-skills">{{$project->skills}}</p>
          </div>

    <div class="col">
            <h2>Description:</h2>
            <hr>
            <p class="card-project-description">{{$project->description}}</p>
          </div>

    
</div>
</body>
</html>