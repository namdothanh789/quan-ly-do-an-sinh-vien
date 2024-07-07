<div style="width: 100%;max-width: 900px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        @if ($data['teacher_status'] == 1)
            <p><b>Dear : {{ $data['name_student'] }}</b></p>
        @else
            <p><b>Dear : {{ $data['name_teacher'] }}</b></p>
        @endif
        @if ($data['teacher_status'] == 1)
            <p>Giáo viên : {{ $data['name_teacher'] }} đã đánh giá @if ($data['type'] == 1) file đồ án @else file báo cáo @endif : <b>{{ $data['file_title'] }}</b>.</p>
        @else
            <p>Sinh viên : {{ $data['name_student'] }} đã nộp @if ($data['type'] == 1) file báo cáo @else file đồ án @endif : <b>{{ $data['file_title'] }}</b>.</p>
        @endif
        @if ($data['teacher_status'] == 1)
            Kết quả đánh giá file báo cáo: <b>{{ $data['file_title'] }}</b>
            <p>Trạng thái : {{ $data['status'] }}</p>
        @endif
        @if ($data['teacher_status'] == 1)
            @if ($data['point'])
                <p><b>Điểm : </b> {{ $data['point'] }}</p>
            @endif
        @endif
        @if ($data['teacher_status'] == 1)
            <div>
                <p><b>Nhận xét</b></p>
                <p>
                    {!! $data['comments'] !!}
                </p>
            </div>
        @endif
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <h4>Thông tin liên hệ hỗ trợ</h4>
        <p style="margin:2px 0;color: #333">Email hỗ trợ : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
    </div>
</div>