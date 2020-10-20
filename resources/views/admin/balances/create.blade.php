@extends('admin.layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> اضافة رصيد للمندوب
    </h1>
</div>

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

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="margin: auto;background: #fff;width: 51%;padding: 15px;">

    <form role="form" action="{{route('balances.store')}}" method="post">
        @csrf

        <div class="my-10"> 
          <label>اضافة المندوب</label>
            <div class="mt-2">
                <select class="select2 w-full" name="agent_id">
                <option selected="selected">المندوبين</option>
                    @foreach($agents as $agent)
                    <option value='{{$agent->id}}'>{{$agent->name}}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div  class="my-10">
            <label>القيمة المضافة للمندوب </label>
            <input type="text" class="input w-full border mt-2" name="balance"
                placeholder=" ادخل القيمة">
            <input type="hidden" class="form-control" value="1" name="type">
            <input type="hidden" class="form-control" value="{{auth()->user()->id}}" name="supervisor">
        </div>
        <button type="submit" class="button w-24 h-10 mr-1 mb-2 bg-theme-9 text-white">اضافة الرصيد</button>


    </form>
</div>


@stop

@section('script')