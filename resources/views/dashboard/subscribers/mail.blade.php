
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
@php
    $blog_id = App\Models\Blog::find($id);
@endphp

<body>
    <p>Katen posted a new blog.</p>
    <p>Check this right now!</p><h4>http://127.0.0.1:8000/single/blog/{{$blog_id->slug}}</h4>
</body>
</html>