<html>
<head>

</head>
<body>
    <h1>{{ $title }}</h1>

    <ul>
        @foreach($fungi as $fungus)
            <li>
                <h3>{{$fungus->species}}</h3>
                <p>Average Height: {{$fungus->averageHeight}} cm</p>
                <p>Colour: {{$fungus->colour}}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>

 --'
