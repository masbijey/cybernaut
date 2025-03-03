<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yello Signage</title>
    <style>
        body,
        html {
            
            background-image: url("{{ url('http://172.18.123.45:8080/yjmb_app/public/image.jpg') }}");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .wording {
            padding-top: 500px;
            padding-left: 100px;
        }

        table {
            font-size: 40px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: yellow;
            text-align: center;
        }

       
    </style>
</head>

<body>
    <div class="wording">
        <table class="table text-center" style="width:100%;">
            <thead class="thead-center" style="font-size:65px; text-transform: uppercase; ">
                <th>Floor</th>
                <th>Venue</th>
                <th>Event Name</th>
            </thead>
            <tbody>
			@if (date('Y-m-d', strtotime($wokntok->created_at)) != date('Y-m-d'))
			@else
                <tr>
                    <td>Lobby</td>
                    <td>WOK N TOK</td>
                    <td>{{ $wokntok->event_name }}</td>
                </tr>
			@endif
			
			@if (date('Y-m-d', strtotime($power_up->created_at)) != date('Y-m-d'))
			@else
                <tr>
                    <td>2nd</td>
                    <td>POWER UP</td>
                    <td>{{ $power_up->event_name }}</td>
                </tr>
			@endif
			
			@if (date('Y-m-d', strtotime($gear_up->created_at)) != date('Y-m-d'))
			@else
                <tr>
                    <td>2nd</td>
                    <td>GEAR UP</td>
                    <td>{{ $gear_up->event_name }}</td>
                </tr>
			@endif
			
			@if (date('Y-m-d', strtotime($light_up->created_at)) != date('Y-m-d'))
			@else
                <tr>
                    <td>2nd</td>
                    <td>LIGHT UP</td>
                    <td>{{ $light_up->event_name }}</td>
                </tr>
			@endif
            </tbody>
        </table>
    </div>
</body>

</html>