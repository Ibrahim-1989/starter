<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <title>View Video</title>
</head>
<body>
    <div class="flex-center position-ref full-height" style="center">
        <div class="content">
            <div class="title m-b-md">
                Video Viewer ({{$video -> Viewer}})
            </div>
            <iframe width="560" height="315" 
            src="https://www.youtube.com/embed/e6o7FTT2aUE?si=ip7lyU0ECYobYfa0" 
            title="YouTube video player" frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
            </iframe>
            <h4>
                {{$video -> name}}
            </h4>
        </div>
    </div>
</body>
</html>