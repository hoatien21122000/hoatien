@extends('layout')
@section('content')
<form action="{{ route('mark.list_mark') }}" method="get">
{{ csrf_field() }}

    Choose Class
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
    <br/>
    Choose Subject
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
    <br/><br/>
    <button class="btn btn-primary" style="margin-left:250px">---Choose---</button>
</form>
<!-- <form action="{{route('mark_management.process_mark')}}" method="post"> -->
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
                {{$array[$student_id][$i] ?? ''}}
            </td>
        @endfor
    </tr>
    @endforeach
</table>
<!-- <button>Input Mark</button> -->
<!-- </form> -->
@endsection
@push('js')
<script>
$(document).ready(function(){
    $('#li_manage_list').addClass('menu-open');
    $('#manage_list').addClass('active');
    $('#mark').addClass('active');
    $('#choose_class').select2();
    $('#choose_subject').select2();
    $("#choose_class").change(function(){
        getSubject1();
    });
});
function getSubject1(){
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