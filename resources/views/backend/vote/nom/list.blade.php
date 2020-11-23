@php
        $teachers = \App\Nominee::where('school_id', school_id())->get();
@endphp
@if (count($teachers) > 0)
    <body class="bg-light">
    <main>
        <!-- Ui cards -->
        <section id="cards">
            <div class="container py-2">
                <!-- cards -->
                <div class="row">
                    @foreach ( $teachers as $teacher)
                    <div class="col-lg-4 col-md-6 mb-4 pt-5">
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <div class="user-picture">
                                    @if (file_exists('images/nominee/'.$teacher->student_id.'.jpg'))
                                        <img src="{{asset('images/nominee/'.$teacher->student_id.'.jpg')}}" class="shadow-sm rounded-circle" alt="{{$teacher->name}}" height="130" width="130">
                                    @else
                                        <img src="{{ asset('images/nominee/default.jpg') }}" class="shadow-lg rounded-circle" alt="" height="130" width="130">
                                    @endif
                                </div>
                                <div class="user-content">
                                    <h5 class="text-capitalize user-name">{{ $teacher->name }}</h5>
                                    <p class=" text-capitalize text-muted small blockquote-footer">{{ $teacher->position->name }}</p>
                                    <div class="small">
                                        <i class="fas fa-star text-warning"></i>
                                        <p> {{ $teacher->motto }}</p>
                                    </div>
                                    <p class="small text-muted mb-0">{{ $teacher->description }}</p>
                                </div>
                                 @php
                                 $nomi = \App\Result::where('nominee_id', $teacher->id)->where('position_id', $teacher->position->id)->count();
                                 @endphp
                                 <h2>{{ $nomi }}</h2>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /cards -->
        </section>
        <!-- /Ui cards -->
    </main>

    </body>
@else
    <div style="text-align: center;">
            <img src="{{ asset('backend/images/no-data.png') }}" alt="" class="empty-box">
            <p>{{ translate('no_data_found') }}</p>
    </div>
@endif
