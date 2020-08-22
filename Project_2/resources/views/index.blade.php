@extends('layout')
@section('content')
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              @foreach($subject as $each)
                <h3>{{ $each->tong_subject}}</h3>
              @endforeach
                <p>Subjects</p>
              </div>
              <div class="icon">
              <i class="fas fa-book"></i>
              </div>
              <a href="{{ route('subject_management.subject_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              @foreach($pathway as $each)
                <h3>{{ $each->tong_pathway }}</h3>
              @endforeach
                <p>Majors</p>
              </div>
              <div class="icon">
              <i class="fas fa-list-ol"></i>
              </div>
              <a href="{{ route('pathway_management.pathway_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              @foreach($academic_year as $each)
                <h3>{{ $each->tong_academic_year }}</h3>
              @endforeach
                <p>Academic Years</p>
              </div>
              <div class="icon">
              <i class="fas fa-clock"></i>
              </div>
              <a href="{{ route('academic_year_management.academic_year_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                @foreach($teacher as $each)
                <h3>{{ $each->tong_teacher }}</h3>
                @endforeach
                <p>Teachers</p>
              </div>
              <div class="icon">
              <i class="fas fa-chalkboard-teacher"></i>
              </div>
              <a href="{{ route('teacher_management.teacher_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>  
</div>
    <!--Load the AJAX API-->
  <table class="table table-">
      <tr style="text-align:center; background :#3399FF; color:white;">
        <th colspan="3">Statistics of students with above average scores between classes</th>
      </tr>
      <tr>
        <td>
            <b>Choose Academic Year</b>
            <Select id="choose_academic_year" class="form-control">
                <option value="0">----- Choose Academic Year -----</option>
                @foreach($arr_academic_year as $each)
                    <option value="{{$each->academic_year_id}}">
                        
                        {{$each->academic_year_name}}
                    </option>
                @endforeach
            </Select>
        </td>
        <td>
            <b>Choose Major</b>
            <input type="hidden" id="check_form" value="2">
            <Select id="choose_pathway" class="form-control">
                <option value="0">----- Choose Major -----</option>
                @foreach($arr_pathway as $each)
                    <option value="{{$each->pathway_id}}">
                        {{$each->pathway_name}}
                    </option>
                @endforeach
            </Select>
        </td>
        <td style="display: none" id="subject">
            <b>Choose Subject</b>
            <Select id="choose_subject" class="form-control">
                <option value="0">----- Choose Subject -----</option>
            </Select>
        </td>
      </tr>
    </table>  
    
    <div class="panel-body">
    <div id="container" style="width:100%; height:400px;"></div>
    </div>
    <!--Div that will hold the pie chart-->
    <!-- <div id="chart_div"></div> -->
  </body>
</html>
@endsection
@push('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    $(document).ready(function(){
      
        $("#choose_pathway").change(function(){
          $('#subject').show();
            $.ajax({
                url:'{{route('ajax.get_subject_by_pathway')}}',
                type:'GET',
                data:{
                    pathway_id : $("#choose_pathway").val(),
                },
                success:function(data){
                  $('#choose_subject').html(data);
                }
            });
        });
        $("#choose_subject").change(function(){
            $.ajax({
                url:'{{route('ajax.get_number_student')}}',
                type:'GET',
                data:{
                    pathway_id : $("#choose_pathway").val(),
                    academic_year_id : $("#choose_academic_year").val(),
                    subject_id : $("#choose_subject").val()
                },
                success:function(data){
                  getChart(data);
                }
            });
        });
    });
    function getChart(data){
      console.log(data);
      Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Stacked column chart'
    },
    xAxis: {
      categories: data.array_class
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total Student'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: [{
              name: 'Student pass',
              data: data.array_number_of_students_passing_subject
          }, {
              name:'Student do not pass',
              data: data.array_number_of_students_dont_pass_subject
          }]
});
    }
</script>
@endpush