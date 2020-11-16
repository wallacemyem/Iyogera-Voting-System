<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>500 Internal Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/500.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<h5>Internal Server error !</h5>
<h1>5</h1>
<h1>00</h1>
<div class="box">
    <span></span><span></span>
    <span></span><span></span>
    <span></span>
</div>
<div class="box">
    <span></span><span></span>
    <span></span><span></span>
    <span></span>
</div>
<p> We're unable to find out what's happening! We suggest you to
    <br/>
    <a href="{{ route('dashboard') }}">Go Back</a>
    or visit here later.</p>
</body>
</html>
