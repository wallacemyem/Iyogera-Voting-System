<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Voting</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('backend/css/notyf.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/voting.css') }}" type="text/css">
    <script>
        /* Demo purposes only */
        $(".hover").mouseleave(
            function () {
                $(this).removeClass("hover");
            }
        );
    </script>
</head>

<body>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<body>
<ul class="card-list">
	
	<li class="card">
		<a class="card-image" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank" style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/psychopomp-100.jpg);" data-image-full="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/psychopomp-500.jpg">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/psychopomp-100.jpg" alt="Psychopomp" />
		</a>
		<a class="card-description" href="https://michellezauner.bandcamp.com/album/psychopomp-2" target="_blank">
			<h2>Psychopomp</h2>
			<p>Japanese Breakfast</p>
		</a>
	</li>
	
	<li class="card">
		<a class="card-image" href="https://inlovewithaghost.bandcamp.com/album/lets-go" target="_blank" style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/lets-go-100.jpg);" data-image-full="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/lets-go-500.jpg">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/lets-go-100.jpg" alt="let's go" />
		</a>
		<a class="card-description" href="https://inlovewithaghost.bandcamp.com/album/lets-go" target="_blank">
			<h2>let's go</h2>
			<p>In Love With A Ghost</p>
		</a>
	</li>
	
	<li class="card">
		<a class="card-image" href="https://vulfpeck.bandcamp.com/album/the-beautiful-game" target="_blank" style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/beautiful-game-100.jpg);" data-image-full="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/beautiful-game-500.jpg">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/beautiful-game-100.jpg" alt="The Beautiful Game" />
		</a>
		<a class="card-description" href="https://vulfpeck.bandcamp.com/album/the-beautiful-game" target="_blank">
			<h2>The Beautiful Game</h2>
			<p>Vulfpeck</p>
		</a>
	</li>
	
	<li class="card">
		<a class="card-image" href="https://convergecult.bandcamp.com/album/jane-doe" target="_blank" style="background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/jane-doe-100.jpg);" data-image-full="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/jane-doe-500.jpg">
			<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/310408/jane-doe-100.jpg" alt="Jane Doe" />
		</a>
		<a class="card-description" href="https://convergecult.bandcamp.com/album/jane-doe" target="_blank">
			<h2>Jane Doe</h2>
			<p>Converge</p>
		</a>
	</li>
	
</ul>

<script src="{{ asset('backend/js/notyf.min.js') }}"></script>
<script src="{{ asset('backend/js/voting.js') }}"></script>
@foreach (session('flash_notification', collect())->toArray() as $message)
    @if($message['level'] == 'success')
        <script type="text/javascript">
            var notyf = new Notyf();
            notyf.success('{{ $message['message'] }}');
        </script>
    @else
        <script type="text/javascript">
            var notyf = new Notyf();
            notyf.error('{{ $message['message'] }}');
        </script>
    @endif
@endforeach
</body>

</body>
</html>
