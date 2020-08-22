@extends('layout')
@section('content')
<form method="post" action="{{route('course_management.course_insert_process')}}">
<table>
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<tr>
		<td>Class id</td>
		<td><input type="text" name="class_id"></td>
	</tr>
	<tr>
		<td>Student name</td>
		<td><input type="text" name="course_name"></td>
	</tr>
	<tr>
		<td>Address</td>
		<td><input type="text" name="course_name"></td>
	</tr>
	<tr>
		<td>Student phone number</td>
		<td><input type="text" name="course_name"></td>
	</tr>
	<tr>
		<td>
			<button>Insert</button>
		</td>
	</tr>
</table>
</form>
@endsection