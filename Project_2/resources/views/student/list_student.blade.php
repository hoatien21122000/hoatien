@extends('layout')
@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
    <h3>
    <a href="{{ route('student_management.student_insert_excel') }}">Add by Excel file <i class="fas fa-folder-plus"></i></a>
    </h3>
    <a href="{{ route('student_management.student_insert') }}"><i class="fas fa-plus-circle"></i>Add New </a>
    <br/><br/>
    <input type="hidden" id="check_form" value="1">
    
    <b>Choose Class</b><br/>
    <Select id="choose_class" class="form-control" style="width:60%;">
            <option value="0" style="height: 30px !important">----- Choose Class -----</option>
            @foreach($arr_class as $each)
            <option value="{{$each->class_id}}">
                {{$each->class_name}}
            </option>
            @endforeach
    </Select>
    <br/><br/>
    <table class="table table-">
        <thead>
            <tr style="background :#0099FF; color:white;">
                <td>Student Id</td>
                <td>Class Name</td>
                <td>Student Name</td>
                <td>Address</td>
                <td>Phone Number</td>
                <td>Email</td>
                <td>Password</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody>
        @foreach($arr_student as $each)
            <tr>
                <td> {{$each->student_id}}</td>
                <td> {{$each->class_name}}</td>
                <td> {{$each->student_name}}</td>
                <td> {{$each->address}}</td>
                <td> {{$each->student_phone_number}}</td>
                <td> {{$each->email}}</td>
                <td> {{$each->password}}</td>
                <td> <a href="{{ route('student_management.student_update',['student_id' =>$each->student_id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            $('#li_manage_list').addClass('menu-open');
            $('#manage_list').addClass('active');
            $('#student_management').addClass('active');
            $('#choose_class').select2();
            $("#choose_class").change(function(){
                $.ajax({
                    url:'{{route('ajax.get_student_by_class')}}',
                    type:'GET',
                    data:{
                        id_class : $("#choose_class").val()
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>
@endpush