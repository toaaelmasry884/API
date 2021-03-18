<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <div class="container">
      <div class="blog-header">
            <h3>Likes & Dislikes </h3>
            hhjddhsj
            @foreach($posts as $post)
            <div class="post" data-postid="{{$post ->id}}"></div>
            <a href="#"> <h3>{{$post -> title}}</h3> </a>
            <h6>Posted on {{$post -> user_id}} by {{$post->user->name}}</h6>
            <p>{{$post ->content}}</p>
            <div class="interaction">
                <a href="#">Like</a>
                <a href="#">DisLike</a>
            </div>
            @foreach
      </div>
    </div>
</body>
</html>