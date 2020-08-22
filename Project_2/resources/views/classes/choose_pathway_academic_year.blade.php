@extends('layout')
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div style="margin-left:200px">
    <b>Choose Major</b>
    <input type="hidden" id="check_form" value="2">
    <Select id="choose_pathway" class="form-control" style="width:600px">
        <option value="0">----- Choose Major -----</option>
        @foreach($arr_pathway as $each)
            <option value="{{$each->pathway_id}}">
                {{$each->pathway_name}}
            </option>
        @endforeach
    </Select>
    <br/>
    <b>Choose Academic Year</>
    <Select id="choose_academic_year" class="form-control" style="width:600px">
        <option value="0">----- Choose Academic Year -----</option>
        @foreach($arr_academic_year as $each)
            <option value="{{$each->academic_year_id}}">
                {{$each->academic_year_name}}
            </option>
        @endforeach
    </Select>
</div>
<br/>
<a href ="{{ route('classes_management.class_insert') }}"><i class="fas fa-plus-circle"> </i>Add a New Class</a>
<br/>
<table class="table table-">
        <thead>
            <tr style="background :#0099FF; color:white;">
                <td>Class Id</td>
                <td>Class Name</td>
                <td>Major</td>
                <td>Academic Year</td>
                <td>Edit</td>
            </tr>
        </thead>
        <tbody id="classes">
            @foreach($arr_class as $each)
            <tr>
                <td>{{$each->class_id}}</td>
                <td>{{$each->class_name}}</td>
                <td>{{$each->pathway_name}}</td>
                <td>{{$each->academic_year_name}}</td>
                <td><a href="{{ route('classes_management.class_update',['class_id' =>$each->class_id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
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
            $('#class_management').addClass('active');
            $("#choose_pathway,#choose_academic_year").change(function(){
                // alert($("#choose_pathway").val());
                $.ajax({
                    url:'{{route('ajax.get_class_by_pathway_academic_year')}}',
                    type:'GET',
                    data:{
                        id_pathway : $("#choose_pathway").val(),
                        check_form : $("#check_form").val(),
                        id_academic_year : $("#choose_academic_year").val(),
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>
@endpush