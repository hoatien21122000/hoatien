@extends('layout')
@section('content')
<a href="{{route('course_management.course_insert')}}">Insert course</a>
<table border="1" cellspacing="0px">
	<tr>
		<td>Student id</td>
		<td>Class id</td>
		<td>Student name</td>
		<td>Address</td>
		<td>Student phone number</td>
		<td>Email</td>
		<td>Password</td>
		<td></td>
	</tr>
	@foreach ($result as $each)
	<tr>
		<td>{{$each->student_id}}</td>
		<td>{{$each->class_id}}</td>
		<td>{{$each->student_name}}</td>
		<td>{{$each->address}}</td>
		<td>{{$each->student_phone_number}}</td>
		<td>{{$each->email}}</td>
		<td>{{$each->password}}</td>
		<td><a href="{{}">Update</a></td>
	</tr>
	@endforeach
</table>
@endsection