<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">
    <title>Index</title>
</head>
<body>

<form action="{{ route('pdf.view') }}" method="get" target="_blank">
    @csrf
    
    
    <style>

            table: {

                width: 95%;
                border-collapse: collapse;
                margin: 50px auto;

            }            
        </style>
    
    <h1 class="text-center mt-5">PDF(Admin)</h1>
    <hr>  
<table>       
    
        <thead>
          <tr>        

            <th scope="col-md-1">ID</th>
            <th scope="col-md-2">Thumbnail</th>
            <th scope="col-md-2">Title</th>            
            <th scope="col-md-2">Category</th>

          </tr>
        </thead>

        <tbody>

            @foreach ($projects as $project)

                <tr>

                    <th scope="row">{{$project->id}}</th>
                    <td><img style="height: 150px; width: 200px;" src="/images/{{$project->thumbnail}}" /></td>
                    <td>{{$project->title}}</td>
                    <td>{{$project->category->name}}</td>      
                    
                </tr>                   
                    

            @endforeach

        </tbody>
    </div>

</table>     


    <a href="{{ route('pdf.view') }}" class="btn btn-success">view PDF </a>
    <a href="{{ route('pdf.convert') }}" class="btn btn-success">Download PDF </a>
</form>
        



</div>
        </div>
    </body>
</html>
