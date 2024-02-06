<div style="width: 100%;max-width: 900px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        @if ($data['teacher_status'] == 1)
        <p><b>Dear : {{ $data['name_student'] }}</b></p>
        @else
        <p><b>Dear : {{ $data['name_teacher'] }}</b></p>
        @endif
        @if (!isset($data['topic']))
            @if ($data['teacher_status'] == 1)
            <p>Giáo viên : {{ $data['name_teacher'] }} đã @if(!empty($data['status'])) <b>{{ $data['status'] }}</b> @else nhận sét @endif @if ($data['outline_status'] == 1) đề cương @else khóa luận @endif : {{ $data['title'] }}.</p>
            @else
            <p>Sinh viên : {{ $data['name_student'] }} đã nộp @if ($data['outline_status'] == 1) đề cương @else khóa luận @endif : {{ $data['title'] }}.</p>
            @endif
        @else
            Kết quả đánh giá đề tài khóa luận : {{ $data['title'] }}
            <p><b>Trạng thái</b> : {{ $data['status'] }}</p>
        @endif
        @if ($data['teacher_status'] == 1)
            @if ($data['point'])
                <p><b>Điểm : </b> {{ $data['point'] }}</p>
            @endif
        @endif
        @if ($data['teacher_status'] == 1)
        <div>
            <p><b>Nhận sét</b></p>
            <p>
                {!! $data['comments'] !!}
            </p>
        </div>
        @endif

        @if (!empty($data['link_download']))
        <p>File đính kèm <a href="{!! asset('uploads/documents/' . $data['link_download']) !!}" target="_blank" download>Link download</a></p>
        @endif
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <h4>Thông tin liên hệ hỗ trợ</h4>
        <p style="margin:2px 0;color: #333">Email hỗ trợ : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
    </div>
</div>