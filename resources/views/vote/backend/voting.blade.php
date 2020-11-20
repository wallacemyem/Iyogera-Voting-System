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

@php
    if(isset($department_id) && $department_id > 0){
        $teachers = \App\Nominee::get();
    }else {
        $teachers = \App\Nominee::get();
    }
@endphp
@if (count($teachers) > 0)

<ul class="card-list">
<div><h2> Click on your candidate to vote</h2></div>
	<br>
	<br>
	@foreach ( $teachers as $teacher)
	<li class="card">
	
		@if (file_exists('images/nominee/'.$teacher->student_id.'.jpg'))
		<a class="card-image" href="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}" style="background-image: url({{asset('images/nominee/'.$teacher->student_id.'.jpg')}});" data-image-full="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}">
			<img src="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}" alt="Nominee" />
		</a>
		@else
		<a class="card-image" href="{{ asset('images/nominee/default.jpg') }}" style="background-image: url({{ asset('images/nominee/default.jpg') }});" data-image-full="{{ asset('images/nominee/default.jpg') }}">
			<img src="{{ asset('images/nominee/default.jpg') }}" alt="Default" />
		</a>
		@endif
		<a class="card-description" href="https://convergecult.bandcamp.com/album/jane-doe" target="_blank">
			<h2>{{ $teacher->name }}</h2>
			<p>{{ $teacher->motto }}</p>
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
