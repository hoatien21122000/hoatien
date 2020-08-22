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
                                <Select id="choose_class" class="form-control" name="class_id" >
                                    <option value="0">----- Choose Class -----</option>
                                    @foreach($arr_class as $each)
                                        <option value="{{$each->class_id}}">
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
                                    
                                </Select>
                                </div>
                            </div>

                            <button class="btn btn-primary" style="margin-left:250px">---Choose---</button>
                        </form>

                        </div>
                </div> <!-- end card -->

            </div> <!--  end col-md-6  -->
        </div> 
    </div> 
</div>
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
            });
        });
    </script>
@endpush