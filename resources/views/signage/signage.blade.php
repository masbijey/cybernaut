<html>
<head>    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="30" >
    <title>Yello Signage</title>
    <style>
        body, html {
            height: 100%;
            background-image: url("{{ url('image.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            }
        .wording {
            padding-top: 500px;
            padding-left: 100px;
        }
        h1{
            font-size: 72px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: yellow;
            text-transform: uppercase
        }
    </style>
</head>
</head>
<body>
    <div class="wording">
        <h1>{{ $meeting_room }}<br>     
        {{ $event_name->event_name }}
        </h1>
    </div>
</body>
</html>