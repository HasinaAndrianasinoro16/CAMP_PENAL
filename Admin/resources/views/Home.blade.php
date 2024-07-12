@extends('Dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="overview-wrap">
                <h2 class="title-1">Tableau de bord</h2>
            </div>
            <div class="py-3"></div>
        </div>
        <div class="overview-chart" style="display: none"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
            <canvas id="widgetChart2" height="345" style="display: block; width: 340px; height: 115px;" width="1020" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="row m-t-25">
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c1">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>10368</h2>
                                <span>Utilisateur D.I.R.A.P</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart2" height="345" style="display: block; width: 340px; height: 115px;" width="1020" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c2">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                            <div class="text">
                                <h2>388,688</h2>
                                <span>Agent du ministere</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart2" height="345" style="display: block; width: 340px; height: 115px;" width="1020" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="overview-item overview-item--c3">
                    <div class="overview__inner">
                        <div class="overview-box clearfix">
                            <div class="icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="text">
                                <h2>1,086</h2>
                                <span>Camp penal</span>
                            </div>
                        </div>
                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                            <canvas id="widgetChart2" height="345" style="display: block; width: 340px; height: 115px;" width="1020" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-sm-6 col-lg-3">--}}
{{--                <div class="overview-item overview-item--c4">--}}
{{--                    <div class="overview__inner">--}}
{{--                        <div class="overview-box clearfix">--}}
{{--                            <div class="icon">--}}
{{--                                <i class="zmdi zmdi-money"></i>--}}
{{--                            </div>--}}
{{--                            <div class="text">--}}
{{--                                <h2>$1,060,386</h2>--}}
{{--                                <span>total earnings</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="overview-chart"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>--}}
{{--                            <canvas id="widgetChart4" height="396" style="display: block; width: 340px; height: 132px;" width="1020" class="chartjs-render-monitor"></canvas>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <strong class="h3">Details</strong>
                    </div>
                    <p class="text-muted m-b-15">
                        Dans cette page vous pouvez voir
                        <code>Utilisateurs D.I.R.A.P</code>
                        qui sont les responsables de chaque camp penal et
                        <code>Agent Ministere</code>
                        qui sont les responsable de chaque action
                        <code>Camp penal</code>
                        le nombre de camp penal enregistre.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
