@extends('layout')
@section('content')
<form method="post" action="{{route('academic_year_management.academic_year_insert_process')}}">
<table border="1" cellspacing="0px">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div>
		Choose Pathway
			<select id="choose_pathway">
					<option value="0">--Choose--</option>
				@foreach($arr_pathway as $each)
					<option value="{{$each->pathway_id}}">{{$each->pathway_name}}</option>
				@endforeach
			</select>
	</div>
	<br>
	<div>
		Choose Academic Year
			<select id="choose_academic_year">
					<option value="0">--Choose--</option>
				@foreach($arr_academic_year as $each)
					<option value="{{$each->academic_year_id}}">{{$each->academic_year_name}}</option>
				@endforeach
			</select>
	</div>
	<div>
		<tr>
			<td>Classes name</td>
			<td><input type="text" name="classes_name"></td>
		</tr>
	</div>
	<tr>
		<td>
			<button>Insert</button>
		</td>
	</tr>
</table>
</form>
@endsection