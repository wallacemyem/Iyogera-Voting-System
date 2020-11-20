<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Voting</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('backend/css/notyf.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('backend/css/voting.css') }}">
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


<figure class="snip1336">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample87.jpg" alt="sample87" />
    <figcaption>
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample4.jpg" alt="profile-sample4" class="profile" />
        <h2>Hans Down<span>Engineer</span></h2>
        <p>I'm looking for something that can deliver a 50-pound payload of snow on a small feminine target. Can you suggest something? Hello...? </p>
        <a href="#" class="follow">Follow</a>
        <a href="#" class="info">More Info</a>
    </figcaption>
</figure>
<figure class="snip1336 hover"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample74.jpg" alt="sample74" />
    <figcaption>
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample2.jpg" alt="profile-sample2" class="profile" />
        <h2>Wisteria Widget<span>Photographer</span></h2>
        <p>Calvin: I'm a genius, but I'm a misunderstood genius. Hobbes: What's misunderstood about you? Calvin: Nobody thinks I'm a genius.</p>
        <a href="#" class="follow">Follow</a>
        <a href="#" class="info">More Info</a>
    </figcaption>
</figure>
<figure class="snip1336"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample69.jpg" alt="sample69" />
    <figcaption>
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/profile-sample5.jpg" alt="profile-sample5" class="profile" />
        <h2>Desmond Eagle<span>Accountant</span></h2>
        <p>If you want to stay dad you've got to polish your image. I think the image we need to create for you is "repentant but learning".</p>
        <a href="#" class="follow">Follow</a>
        <a href="#" class="info">More Info</a>
    </figcaption>
</figure>

<script src="{{ asset('backend/js/notyf.min.js') }}"></script>
{{--<script src="{{ asset('backend/js/voting.js') }}"></script>--}}
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