@extends('student_layout')
@section('student_content')
<section class="content">
      <div class="card">
        <div class="card-body">
          <div id="jsGrid1">
            <table class="table">
                   <tr>
                      <th rowspan="2" style="width: 400px;">Subject Name</th>
                      <th colspan="{{$max_time}}">Mark</th>
                   </tr>
                    <tr>
                          @for($i=1;$i<=$max_time;$i++)
                              <th>
                                  Times {{$i}}
                              </th>
                          @endfor
                      </tr>
                      @foreach($arr_mark as $each)
                      @php
                          $subject_id = $each->subject_id
                      @endphp
                      <tr>
                          <td>
                            {{$each->subject_name}}
                          </td>
                          @for($i=1;$i<=$max_time;$i++)
                          <td>
                            <input data-student_id="{{$student_id}}" data-subject_id="{{$subject_id}}" data-exam_times="{{$i}}" class="input_mark" type="number" value="{{$array[$student_id][$subject_id][$i] ?? ''}}" name="array_mark[{{$student_id}}][{{$subject_id}}][{{$i}}]" readonly="readonly" style=" border: none;">
                          </td>
                          @endfor
                      </tr>
                  @endforeach
                </table>
          </div>
        </div>
      </div>
  </section>
@endsection