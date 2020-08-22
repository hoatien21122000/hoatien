@extends('layout')
@section('content')
<div class="main-content">
<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="btn btn-fill" style="background-color: #3399FF; text-align: center; color: white"><h4>MARK</h4></div>
                    <div class="content">
                    <form action="{{ route('mark_management.list_mark') }}" method="get">
                    {{ csrf_field() }}

                        <div class="form-group">
                                <label class="col-md-4 control-label">Choose Class</label>
                                <div class="col-md-10">
                                <Select id="choose_class" class="form-control" name="class_id">
                                    <option value="0">----- Choose Class -----</option>
                                    @foreach($arr_class as $each)
                                        <option value="{{$each->class_id}}"
                                            @if($class_id==$each->class_id)
                                            selected
                                            @endif
                                        >
                                            {{$each->class_name}}
                                        </option>
                                    @endforeach
                                </Select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Choose Subject</label>
                                <div class="col-md-10">
                                <Select id="choose_subject" class="form-control" name="subject_id">
                                    <option value="0">----- Choose Subject -----</option>
                                    @foreach($arr_subject as $each)
                                        <option value="{{$each->subject_id}}"
                                            @if($subject_id==$each->subject_id)
                                            selected
                                            @endif
                                        >
                                            {{$each->subject_name}}
                                        </option>
                                    @endforeach
                                </Select>
                                </div>
                            </div>

                            <button class="btn btn-primary" style="margin-left:250px">---Choose---</button>
                        </form>

                        </div>
                        {{csrf_field()}}
                            <input type="hidden" name="subject_id" value="{{$subject_id}}">
                            <br />
                            <table class="table">
                                <tr>
                                    <th rowspan="2">Student ID</th>
                                    <th rowspan="2">Student Name</th>
                                    <th colspan="{{$max_time}}" style="text-align:center">Mark</th>
                                </tr>
                                <tr>
                                    @for($i=1;$i<=$max_time;$i++)
                                        <th>
                                        Times {{$i}}
                                        </th>
                                    @endfor
                                </tr>
                                @foreach($arr_student as $each)
                                @php
                                    $student_id = $each->student_id
                                @endphp
                                <tr>
                                    <td>
                                        {{$student_id}}
                                    </td>
                                    <td>
                                        {{$each->student_name}}
                                    </td>
                                    @for($i=1;$i<=$max_time;$i++)
                                        <td>
                                            <!-- <input class="input_mark" type="number" value="{{$array[$student_id][$i] ?? ''}}" name="array_mark[{{$student_id}}][{{$i}}]"> -->
                                            <input data-student_id="{{$student_id}}" data-subject_id="{{$subject_id}}" data-exam_times="{{$i}}" class="input_mark" type="number" value="{{$array[$student_id][$i] ?? ''}}" name="array_mark[{{$student_id}}][{{$i}}]">
                                        
                                        </td>
                                    @endfor
                                </tr>
                                @endforeach
                            </table>
                </div> <!-- end card -->
    
            </div> <!--  end col-md-6  -->
        </div> 
    </div> 
</div>


<!-- <form action="{{route('mark_management.process_mark')}}" method="post"> -->

<!-- <button>Input Mark</button> -->
<!-- </form> -->
@endsection
@push('js')
<script>
$(document).ready(function(){
    $('#li_manage_list').addClass('menu-open');
    $('#manage_list').addClass('active');
    $('#mark_management').addClass('active');
    $('#choose_class').select2();
    $('#choose_subject').select2();
    $("#choose_class").change(function(){
        getSubject();
    });
    $(".input_mark").change(function(){
        // alert("aaa");
        let student_mark = $(this).val();
        if(student_mark >= 0 && student_mark <= 10) {
            $.ajax({
                url:'{{route('ajax.submit_mark')}}',
                type:'GET',
                dataType: 'json',
                data:{
                    student_id : $(this).data('student_id'),
                    subject_id : $(this).data('subject_id'),
                    exam_times : $(this).data('exam_times'),
                    mark : $(this).val(),
                },
                success:function(){
                    swal("Success!", "You have changed mark!", "success");
                },
                error:function(){
                    swal("Error!", "You haven't changed mark!", "error");
                }
            });
        }
        else {
            swal("Error!", "You haven't changed mark!", "error");
        }
    });
});
function getSubject(){
    $.ajax({
        url:'{{route('ajax.get_subject')}}',
        type:'GET',
        dataType: 'json',
        data:{
            class_id : $("#choose_class").val(),
        },
        success:function(data){
            $("#choose_subject").empty();
            $("#choose_subject").append(`<option value="0">----- Choose Subject -----</option>`);
            $(data).each(function(){
                $("#choose_subject").append(`
                    <option value="${this.subject_id}">
                        ${this.subject_name}
                    </option>
                `);
            });
        }
    });
}
</script>
@endpush