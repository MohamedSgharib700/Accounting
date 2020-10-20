@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      اضافة رصيد للمندوب 
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            @if ($errors->any())
              <div class="alert alert-danger">
                 <ul>
                   @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                   @endforeach
                 </ul>
              </div>
            @endif

            <div>
            @if(Session::has('message'))
                 <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                 @endif
                 </div>
            <!-- form start -->
            <form role="form" action="{{route('amwalBalances.store')}}" method="post">
               @csrf


                                                                                                                                                                                                                                
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">القيمة المضافة لشركة اموال</label>
                  <input type="text" class="form-control" name="Balance" placeholder=" ادخل القيمة"> 

                </div>

                <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">التعليق</label>
                  <input type="text" class="form-control" name="Notes" placeholder=" ادخل التعليق"> 

                </div>

 
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">اضافة الرصيد</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>    
@stop

@section('script')