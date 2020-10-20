@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- /.content-header -->
        <div>
            <br>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <!--<h3>150</h3>-->
                                <br>
                                <p style="color: white;font-size: 18px;font-weight: bold"> رصيد الشركه</p>
                                <br>
                                <h1>{{$company_balances}}</h1>
                            </div>
                            <div class="icon">
                                <i class="ion ion-calculator"></i>
                            </div>
                            <a href="{{ route('company-balances-report') }}" class="small-box-footer">التفاصيل  <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <!--<h3>150</h3>-->
                                <br>
                                <p style="color: white;font-size: 18px;font-weight: bold">الرصيد المحول للمندوبين</p>
                                <br>
                                <h1>{{$agent_balances}}</h1>
                            </div>
                            <div class="icon">
                                <i class="ion ion-refresh"></i>
                            </div>
                            <a  href="{{ route('agent-balances-report') }}" class="small-box-footer"> التفاصيل <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <!--<h3>150</h3>-->
                                <br>
                                <p style="color: white;font-size: 18px;font-weight: bold">الرصيد المتاح تحويله للمندوبين</p>
                                <br>
                                <h1>{{$available_agent_balances}}</h1>
                            </div>
                            <div class="icon">
                                <i class="ion ion-checkmark"></i>
                            </div>
                            <a href="#" class="small-box-footer"> <i class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.row (main row) -->
        </section>
        <!-- /.content -->
@stop
