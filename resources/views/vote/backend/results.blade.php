<!doctype html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <title>Voting</title>

    <meta name="description" content="The HTML5 Herald">

    <meta name="author" content="Votingt">

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

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

<body>

@if (count($nom) > 0)

<div style="text-align:center;"><h2> Results</h2></div>

	<ul class="card-list">

	@foreach ( $nom as $teacher)

	<li class="card">

	

		@if (file_exists('images/nominee/'.$teacher->student_id.'.jpg'))

		<a class="card-image" href="#" style="background-image: url({{asset('images/nominee/'.$teacher->student_id.'.jpg')}});" data-image-full="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}">

			<img src="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}" alt="Nominee" />

		</a>

		@else

		<a class="card-image" href="#" style="background-image: url({{ asset('images/nominee/default.jpg') }});" data-image-full="{{ asset('images/nominee/default.jpg') }}">

			<img src="{{ asset('images/nominee/default.jpg') }}" alt="Default" />

		</a>

		@endif

		<a class="card-description" href="#">

			<h2>{{ $teacher->name }}</h2>

			<p>{{ $teacher->motto }}</p>
            <p>number of vote(s)</p>

            <h1>
                <p>
                @php
                 $nomi = \App\Result::where('nominee_id', $teacher->id)->where('position_id', $teacher->position->id)->count();
                @endphp
                {{ $nomi }}
                </p>
            </h1>

		</a>

	</li>

	@endforeach

</ul>

@else

        <div style="text-align: center;">

            <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">

            <p>{{ translate('no_positions_found') }}</p>

        </div>

@endif

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
