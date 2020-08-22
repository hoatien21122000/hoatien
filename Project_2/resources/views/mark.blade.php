@extends('layout')
@section('content')

<form action="{{ route('mark.list_mark') }}" method="get">
{{ csrf_field() }}
    Choose Class
    <Select id="choose_class" class="form-control" name="class_id">
        <option value="0">----- Choose Class -----</option>
        @foreach($arr_class as $each)
            <option value="{{$each->class_id}}">
                {{$each->class_name}}
            </option>
        @endforeach
    </Select>
    <br/><br/>
    Choose Subject
    <Select id="choose_subject" class="form-control" name="subject_id">
    <option value="0">----- Choose Class -----</option>
    </Select>
    <br/><br/>
    <button class="btn btn-primary" style="margin-left:250px">---Choose---</button>
</form>
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