@extends('Dashboard')
@section('content')
    <div class="row">
{{--        <div class="col-lg-12">--}}
{{--            <div class="overview-wrap">--}}
{{--                <h2 class="title-1">Conversation:</h2>--}}
{{--            </div>--}}
{{--            <div class="py-3"></div>--}}
{{--        </div>--}}
        <div class="col-lg-12">
            <div class="au-card au-card--no-shadow au-card--no-pad m-b-40 au-card--border">
                <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
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
                                <span class="nick"><a href="#">John Smith</a></span>
                            </div>
                        </div>
                        <div class="au-chat__content au-chat__content2 js-scrollbar5">
                            <div class="recei-mess-wrap">
                                <span class="mess-time">12 Min ago</span>
                                <div class="recei-mess__inner">
                                    <div class="avatar avatar--tiny">
                                        <img src="https://www.stage.itu-labs.com/Assets/img/user2-160x160.jpg" alt="John Smith">
                                    </div>
                                    <div class="recei-mess-list">
                                        <div class="recei-mess">Lorem ipsum dolor sit amet elit</div>
                                        <div class="recei-mess">Donec tempor viverra</div>
                                    </div>
                                </div>
                            </div>
                            <div class="send-mess-wrap">
                                <span class="mess-time">30 Sec ago</span>
                                <div class="send-mess__inner">
                                    <div class="send-mess-list">
                                        <div class="send-mess">Lorem ipsum dolor sit amet elit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="au-chat-textfield">
                            <form class="au-form-icon">
                                <textarea class="au-input au-input--full form-control" rows="2"></textarea>
                                <button class="au-input-icon">
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
