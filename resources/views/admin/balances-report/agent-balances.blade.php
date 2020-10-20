@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div>
            <section class="content-header text-center">
                <h1  class="p-3 text-center">
                    الارصده المحوله للمندوبين
                </h1>
                <button class="p-3 text-center btn btn-success">
                    اجمالي الرصيد
                    <br>
                    {{ $sum }}</button>
            </section>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="container text-left">
                    <div class="row">
                        <div class="box box-btn ">
                            <div class="box-header with-border">
                                <!-- <h3 class="box-title">Search Fields</h3> -->
                            </div>
                            <form class="form-horizontal" >
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <input type="text" name="name" class="form-control" placeholder="بحث باسم المندوب.">
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="col-xs-2">
                                            <input type="text" name="balance" class="form-control" placeholder="بحث بالرصيد .">
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="col-xs-2">
                                            <input type="date" name="created_at" class="form-control" placeholder="بحث بالتاريخ .">
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="col-xs-2">
                                            <button type="submit" class="btn btn-primary btn-amwal">بحث</button>
                                        </div>
                                        &nbsp;&nbsp;&nbsp;
                                        <div class="box-footer">
                                            <a class="btn btn-primary btn-amwal-2" href="{{route('balances-report')}}">رجوع</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <section class="row">
                <div class="table-holder table-responsive">
                    <table class="table text-center pos-table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">اسم المندوب</th>
                            <th scope="col">رقم الهاتف</th>
                            <th scope="col">البريد الالكتروني</th>
                            <th scope="col">الرصيد</th>
                            <th scope="col">التاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($balances as $row)
                            <tr class="pos-{{$row->id}}">
                                <td>{{$row->user->name}}</td>
                                <td>{{$row->user->phone}}</td>
                                <td>{{$row->user->email}}</td>
                                <td>{{$row->balance}}</td>
                                <td>{{$row->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $balances->links() }}
                </div>
            </section>
        </div>
    </div>
@stop