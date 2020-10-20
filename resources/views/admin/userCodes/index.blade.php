@extends('admin.layouts.app')
@section('content')

<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10" style="text-align:center">

    <h1 class="p-3 "> تكويد المناديب</h1>
</div>




<div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y my-10">
    <form class="" style="display:flex" method="get" action="{{route('userCodes')}}">
        <div class="col-span-12">
            <input type="text" class="input w-full border mt-2 " name="name" placeholder="البحث بالاسم">

        </div>
        <div class="col-span-6">
            <button class="button inline-block bg-theme-1 text-white m-2">بحث</button>
        </div>
    </form>
</div>

<div>
    @if(Session::has('message'))
    <br>
    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message') }}
    </p>
    @endif
</div>





<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report text-center -mt-2">
        <thead>
     
            <tr>
                <th class="whitespace-no-wrap">اسم المندوب</th>
                <th class="whitespace-no-wrap">الايميل</th>
                <th class="text-center whitespace-no-wrap"> رقم الهاتف</th>
                <th class="text-center whitespace-no-wrap"> كود المندوب</th>
                <th class="text-center whitespace-no-wrap">العمليات</th>

            </tr>
        </thead>
        <tbody>
            @foreach( $users as $user )
            <tr class="intro-x">
                <td class="">
                    <div class="flex items-center justify-center">
                        <div class=" h-10 ">{{$user->name}}</div>
                    </div>
                </td>
                <td>
                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{$user->email}}
                    </div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$user->phone}}</div>
                </td>
                <td class="text-center">
                    <div class="flex items-center justify-center ">{{$user->user_code ? $user->user_code : '' }}</div>
                </td>
               
                @if($user->user_code)
                <td class="w-40">
                    <div class="flex items-center justify-center text-theme-9">
                    المندوب مكود بالفعل </div>
                </td>
                @else
              
                <td class="w-40">
                    <div class="">
                    <a class="flex items-center justify-center text-theme-6"
                                        href="{{route('userCodes.edit' , $user->id)}}">
                        المندوب غير مكود
</a>
</div>
                </td>
                @endif

            
            </tr>
            @endforeach

        </tbody>

    </table>
    {{ $users->links() }}
</div>










<!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@stop