@extends('student_layout')
@section('student_content')
 <h1 class="m-0 text-dark">Hello, <b style="color: rgb(254, 0, 0)">@if (Session::has('student_name'))
                       {{Session::get('student_name')}}
                   @endif </b>to the academy!</h1>
<div style="background-color:rgb(255, 255, 255); width: 100%; height: 600px ">
<div class="banner" style="text-align: center;">
				<div class="wsite-section-elements">
					<div><div class="wsite-image wsite-image-border-none " style="padding-top:10px;padding-bottom:10px;margin-left:0;margin-right:0;text-align:inherit">
						<a>
						<img src="{{asset('dist/img/04a3bd72-5d41-11e7-a238-56c566ee3692.png')}}" alt="Picture" style="">
						</a>
<div style="display:block;font-size:90%"></div>
</div></div>
@endsection