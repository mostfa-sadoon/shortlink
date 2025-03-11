<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
        <h2 class="mb-4">Analytics for Short URL</h2>
        
        <table class="table table-bordered">
            <tr>
                <th>Short URL</th>
                <td><a href="{{ url($shortenedUrl->short_code) }}" target="_blank">
                    {{ url($shortenedUrl->short_code) }}
                </a></td>
            </tr>
            <tr>
                <th>Original URL</th>
                <td><a href="{{ $shortenedUrl->original_url }}" target="_blank">
                    {{ $shortenedUrl->original_url }}
                </a></td>
            </tr>
            <tr>
                <th>Total Clicks</th>
                <td>{{ $shortenedUrl->clicks }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $shortenedUrl->created_at->format('d M Y H:i:s') }}</td>
            </tr>
        </table>

        <a href="{{route('index')}}" class="btn btn-primary">Back to Home</a>


        <h2 class="mb-4 mt-3">Analytics for users </h2>
        
        <table class="table table-bordered">
            @foreach ($Analytics as $Analytic)
                <tr>
                    <th>user Agent</th>
                    <td>
                        {{ url($Analytic->user_agent) }}
                    </td>
                </tr>
            @endforeach
         
    
        </table>
    </div>  

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>