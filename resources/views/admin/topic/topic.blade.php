<option value="">Chọn đề tài</option>
@foreach($topics as $topic)
    <option value="{{$topic->id}}">
        {{$topic->t_title}}
    </option>
@endforeach