@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Message:</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="col-lg-12">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">
                <div class="au-card-title" >
                    <div class="bg-overlay bg-success"></div>
                    <h3>
                        <h3><i class="zmdi zmdi-account-calendar"></i>{{ \Carbon\Carbon::now()->format('d M, Y') }}</h3>
                </div>
                <div class="au-task js-list-load au-task--border">
                    <div class="au-task__title">
                        <p>Tasks for John Doe</p>
                    </div>
                    <div class="au-task-list js-scrollbar3">
                       @for($i = 0; $i < 12; $i++)
                            <div class="au-task__item au-task__item--success">
                                <div class="au-task__item-inner">
                                    <h5 class="task">
                                        <a href="{{ route('Conversation', ['id' => $i]) }}">Meeting about plan for Admin Template 2018</a>
                                    </h5>
                                    <span class="time">10:00 AM</span>
                                </div>
                            </div>
                       @endfor
                    </div>
                    <div class="au-task__footer">
                        <button class="au-btn au-btn-load js-load-btn">Afficher plus de message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
