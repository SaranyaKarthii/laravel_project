<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Convert</title>
</head>
<body>
<style>
        table, th, td{
            padding: 2px;
            margin: 2px;
            text-align: center;
            border: 1px solid green;
            border-radius: 8px;
        }
        th{
            text-align: center;
            background-color: green;
            color: white;
            font-weight: 600;
        }
        td{
            text-align: center;
            background-color: white;
            color: black;
            font-weight: 400;
        }
    </style>
    <h1 class="text-center mt-5">PDF(Admin)</h1>
    <hr>  
    <table style="box-shadow: 5px 10px black;" class="table">
    
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
                    
                    <td>
                    
                    <img height="100px" width="150px" src="{{ public_path('/images/'.$project->thumbnail) }}" alt="">
                
                </td>
                    <td>{{$project->title}}</td>
                    <td>{{$project->category->name}}</td>      
                    
                </tr>                   
                    

            @endforeach

        </tbody>
    </div>

</table>     



    </body>
</html>
