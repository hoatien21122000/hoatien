@extends('layout')
@section('content')
<div class="form-control" style="background-color: #3399FF; text-align: center; color: white"><h4>Insert Student</h4></div><br />
    Choose Pathway
    <Select id="choose_pathway" class="form-control">
        <option value="0">----- Choose Pathway -----</option>
        @foreach($arr_pathway as $each)
            <option value="{{$each->pathway_id}}">
                {{$each->pathway_name}}
            </option>
        @endforeach
    </Select>
    <br/>
    Choose Academic Year
    <Select id="choose_academic_year" class="form-control">
        <option value="0">----- Choose Academic Year -----</option>
        @foreach($arr_academic_year as $each)
            <option value="{{$each->academic_year_id}}">
                {{$each->academic_year_name}}
            </option>
        @endforeach
    </Select>
    <br/>
    <!-- <br/> -->
    
    @if(count($errors) > 0)
		<div class="alert alert-danger">
			@foreach($errors->all() as $err)
				{{$err}}<br>
			@endforeach
		</div>
@endif
<form method="post" action="">
<!-- <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>INSERT STUDENT</h4></div> -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <table class="table">
        <tr>
            <th style="padding-left:50px">Class Name</th>
            <td>
                <Select id="choose_class" class="form-control" name="class_id">
                <option value="">----- Choose Class -----</option>
                </Select>
            </td>
        </tr>
        <tr>
            <th style="padding-left:50px">Student Name</th>
            <td><input type="text" name="student_name" class="form-control" placeholder="Enter Student Name"></td>
        </tr>
        <tr>
            <th style="padding-left:50px">Address</th>
            <td><input type="text" name="address" class="form-control" placeholder="Enter Address"></td>
        </tr>
        <tr>
            <th style="padding-left:50px">Phone Number</th>
            <td><input type="text" name="student_phone_number" class="form-control" placeholder="Enter Phone Number"></td>
        </tr>
        <tr>
            <th style="padding-left:50px">Email</th>
            <td><input type="text" name="email" class="form-control" placeholder="Enter Email"></td>
        </tr>
        <tr>
            <th style="padding-left:50px;">Password</th>
            <td><input type="text" name="password" class="form-control" placeholder="Enter Password"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center"><button class="btn btn-primary" >Add New Student</button></td>
        </tr>
    </table>
</form>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#li_manage_list').addClass('menu-open');
            $('#manage_list').addClass('active');
            $('#student_management').addClass('active');
            $("#choose_pathway,#choose_academic_year").change(function(){
                $.ajax({
                    url: "{{ route('ajax.get_class_by_pathway_academic_year_insert')}}",
                    type: 'GET',
                    data: {
                        id_pathway : $("#choose_pathway").val(),
                        id_academic_year : $("#choose_academic_year").val(),
                    },
                    success:function(data){
                        $('#choose_class').html(data);
                    }
                });
            });
        });
    </script>
@endpush