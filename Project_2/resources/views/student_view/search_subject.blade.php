@extends('student_layout')
@section('student_content')
<section class="content1">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
Results found: {{count($subject)}} result</h3>
        </div>
        <!-- /.card-header -->
        <div class="table">
          <div id="jsGrid1" class="jsgrid" style="position: relative; height: 100%; width: 100%;">
            <div class="jsgrid-grid-header jsgrid-header-scrollbar">
              <table class="table">
                <tr class="jsgrid-header-row">
                  <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 300px;">Subject Name</th>
                  <th class="jsgrid-header-cell jsgrid-align-right jsgrid-header-sortable" style="width: 300px;">Mark</th>
                  <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 300px;">Exam Time</th>
                </tr>
				      @foreach($subject as $each)
             <tr class="jsgrid-alt-row">
                 <td class="jsgrid-cell" style="width: 300px;">{{$each->subject_name}}</td>
                 <td class="jsgrid-cell" style="width: 300px;">{{$each->mark}}</td>
                 <td class="jsgrid-cell" style="width: 300px;">{{$each->exam_times}}</td>
              </tr>
             	@endforeach
              </table>
            </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
@endsection