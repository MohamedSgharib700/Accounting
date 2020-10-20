
@extends('admin.layouts.app')
@section('content')

    <div class="content-wrapper">
        <div>
            <section class="content-header text-center">
                <h1  class="p-3 text-center">
                    الماكينات
                </h1>
                <button class="p-3 text-center btn btn-success">
                    العدد
                    <br>
                    {{ $count}}</button>
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
                                            <input type="text" name="serial" class="form-control" placeholder="بحث برقم الماكينه .">
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
                                        <button type="submit" class="btn btn-info pull-right" id="excel" data-id="{{$id}}" style="margin-right: 5px;">
                                            <i class="fa fa-download"></i><a style="color:white;" > تحميل ملف اكسيل </a>
                                        </button>&nbsp;&nbsp;&nbsp;
                                        <div class="box-footer">
                                            <a class="btn btn-primary btn-amwal-2" href="{{route('agents-pos')}}">رجوع</a>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

                <!-- /.box-body -->
            </div>

            <div class="clr"></div>
            <section class="row">
                <div class="table-holder table-responsive">

                    <table class="table text-center pos-table">
                        <thead class="thead-light">

                        <tr>

                            <th scope="col">رقم الماكينه</th>
                            <th scope="col">رمز التفعيل</th>
                            <th scope="col">رقم سيريال الشريحه</th>
                            <th scope="col">رقم شريحه الماكينه</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($pos as $row)
                            <tr class="pos-{{$row->id}}">
                                <td>{{$row->serial}}</td>
                                <td>{{$row->machine_code}}</td>
                                <td>{{$row->sim_card_serial ? $row->sim_card_serial: ''}}</td>
                                <td>{{$row->sim_card ? $row->sim_card: ''}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $pos->links() }}
                </div>
            </section>
        </div>

    </div>


@stop
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <script>
        $( document ).ready(function(){
            /* ------------------- excel ----------------- */
            $(document).on("click", "#excel", function (e) {
                agentid=$(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "GET",
                    Content: "text/csv",
                    url: 'export-all-agent-pos/'+agentid,
                    success: function(data){
                        window.location.href = 'export-all-agent-pos/'+agentid;
                    }
                });
                e.preventDefault();
            });

        })
    </script>
@endsection



