@extends('layout')
@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div style="margin-left:200px">
<b>Choose Major</b>
    <Select id="choose_pathway" class="form-control" style="width:600px">
        <option value="0">----- Choose Major -----</option>
        @foreach($arr_pathway as $each)
            <option value="{{$each->pathway_id}}">
                {{$each->pathway_name}}
            </option>
        @endforeach
    </Select>
</div>
<br /><br />
<a href="{{route('pathway_subject_management.insert')}}"><i class="fas fa-plus-circle"> </i>Adding new Subjects to the Major</a> 
<br /><br />
    <table class="table table-">
        <thead>
            <tr style="background :#0099FF; color:white;">
                <th>Subject Id</th>
                <th>Subject Name</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arr_subject as $each)
            <tr>
                <td>{{ $each->subject_id }}</td>
                <td>{{ $each->subject_name }}</td>
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
            $('#pathway_subject_management').addClass('active');
            $("#choose_pathway,#choose_academic_year").change(function(){
                // alert($("#choose_pathway").val());
                $.ajax({
                    url:'{{route('ajax.get_subjectps')}}',
                    type:'GET',
                    data:{
                        pathway_id : $("#choose_pathway").val(),
                    },
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            });
        });
    </script>
@endpush
