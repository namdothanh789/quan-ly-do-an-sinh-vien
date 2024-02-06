<div style="width: 100%;max-width: 900px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        <p><b>Dear : {{ $data['name_teacher'] }}</b></p>

        <p>Sinh viên : {{ $data['name_student'] }}</p>
        <p>Đã đăng ký đề tài : {{ $data['topic'] }}</p>
        <p>Hội đồng : {{ $data['council'] }}</p>
        <p>Thời gian nộp đề cương : {{ $data['start_outline'] }} - {{ $data['end_outline'] }}</p>
        <p>Thời gian nộp báo cáo : {{ $data['start_thesis_book'] }} - {{ $data['end_thesis_book'] }}</p>

    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <h4>Thông tin liên hệ hỗ trợ</h4>
        <p style="margin:2px 0;color: #333">Email hỗ trợ : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
    </div>
</div>