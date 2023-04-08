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
<div class="container-fluid m-3 p-2 row ">
<div class="col">
    <h1 class="text-center mt-5">Index PDF(Admin)</h1>
    <hr>  

    
    <table class="table container">
        
    <div class="table-responsive-sm"> 
        <thead>
          <tr>        

            <th scope="col-md-1">ID</th>           
            
            <th scope="col-md-2">Title</th>            
            <th scope="col-md-2">Category</th>

          </tr>
        </thead>

        <tbody class= "table-group-divider">

            @foreach ($projects as $project)

                <tr>

                    <th scope="row">{{$project->id}}</th>                    
                  <!--  <td><img src = "{{ public_path('/images'.$project->thumbnail) }}" alt= ""></th> -->
                    <td>{{$project->title}}</td>
                    <td>{{$project->category->name}}</td>      
                    
                </tr>                   
                    

            @endforeach

        </tbody>
    </div>

</table>
        


</div>
        </div>
    </body>
</html>
