<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Elections</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('backend/css/elections.css') }}">

</head>

<body>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<body>

@php
    if(isset($department_id) && $department_id > 0){
        $teachers = \App\Position::get();
    }else {
        $teachers = \App\Position::get();
    }
@endphp
@if (count($teachers) > 0)
<div class="main-content">
    <div class="container mt-7">
        <!-- Table -->
        <h2 class="mb-5">Elections</h2><div class="row">

            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Elections Positions </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                        <th scope="row">
                                            <div class="media align-items-center">
                                                <a href="#" class="avatar rounded-circle mr-3">
                                                    <img alt="Image placeholder" src="https://raw.githack.com/creativetimofficial/argon-dashboard/master/assets/img/theme/bootstrap.jpg">
                                                </a>
                                                <div class="media-body">
                                                    <span class="mb-0 text-sm">Argon Design System</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td>
                                          <span class="badge badge-dot mr-4">
                                            <i class="bg-warning"></i> pending
                                          </span>
                                        </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <!-- Dark table -->
</div>
    @else
        <div style="text-align: center;">
            <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">
            <p>{{ translate('no_positions_found') }}</p>
        </div>
@endif
</body>

</body>
</html>