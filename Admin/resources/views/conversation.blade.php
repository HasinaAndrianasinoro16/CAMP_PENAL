@extends('Dashboard')
@section('content')
    <div class="row">
{{--        <div class="col-lg-12">--}}
{{--            <div class="overview-wrap">--}}
{{--                <h2 class="title-1">Conversation:</h2>--}}
{{--            </div>--}}
{{--            <div class="py-3"></div>--}}
{{--        </div>--}}
{{--        <div class="col-lg-4">--}}
{{--        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">--}}
{{--            <div class="au-card-title" >--}}
{{--                <div class="bg-overlay bg-success"></div>--}}
{{--                <h3>--}}
{{--                    <h3><i class="zmdi zmdi-account-calendar"></i>Contact</h3>--}}
{{--            </div>--}}
{{--            <div class="au-task js-list-load au-task--border">--}}
{{--                <div class="au-task__title">--}}
{{--                    <p>Message de {{ Auth::user()->name }}</p>--}}
{{--                </div>--}}
{{--                <div class="au-task-list js-scrollbar3">--}}
{{--                    @foreach( $users as $user )--}}
{{--                        <div class="au-task__item au-task__item--success">--}}
{{--                            <div class="au-task__item-inner">--}}
{{--                                <h5 class="task">--}}
{{--                                    <a href="{{ route('Conversation', ['user' => $user->id]) }}">{{ $user->name }}</a>--}}
{{--                                </h5>--}}
{{--                                <span class="time">{{ $user->position }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--                <div class="au-task__footer">--}}
{{--                    <button class="au-btn au-btn-load js-load-btn">Afficher plus de contact</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
        <div class="col-lg-12">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">
                <div class="au-card-title">
                    <div class="bg-overlay bg-success"></div>
                    <h3>
                        <i class="zmdi zmdi-comment-text"></i>Conversation</h3>
                </div>
                <div class="au-inbox-wrap">
                    <div class="au-chat au-chat--border">
                        <div class="au-chat__title">
                            <div class="au-chat-info">
                                <div class="avatar-wrap ">
                                    <div class="avatar avatar--small">
                                        <img src="https://www.stage.itu-labs.com/Assets/img/user2-160x160.jpg" alt="John Smith">
                                    </div>
                                </div>
                                <span class="nick"><a href="#">{{ $user->name }}</a></span>
                            </div>
                        <div class="au-chat__content au-chat__content2 js-scrollbar5">
                            @foreach( $messages as $message )
                                @if($message->from->id == $user->id)
                                    <!-- Message reçu -->
                                    <div class="recei-mess-wrap">
                                        <span class="mess-time">{{ $message->created_at }}</span>
                                        <div class="recei-mess__inner">
                                            <div class="recei-mess-list">
                                                <div class="recei-mess">
                                                    {!! nl2br(e( $message->content )) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Message envoyé -->
                                    <div class="send-mess-wrap">
                                        <span class="mess-time">{{ $message->created_at }}</span>
                                        <div class="send-mess__inner">
                                            <div class="send-mess-list">
                                                <div class="send-mess bg-dark">
                                                    {!! nl2br(e( $message->content )) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <div class="au-chat-textfield">
                            <form action="{{ route('send') }}" method="post" class="au-form-icon">
                                @csrf
                                <textarea  name="contents" placeholder="Ecriver votre message..." class="au-input au-input--full form-control" rows="2"></textarea>
                                <input type="hidden" value="{{ $user->id }}" name="user">
                                <button class="au-input-icon" type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
