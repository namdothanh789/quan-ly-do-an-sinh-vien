<div style="width: 100%;max-width: 900px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        <h2 style="margin:10px 0;border-bottom: 1px solid #dedede;padding-bottom: 10px;">{{ $data['subject'] }}</h2>
        <div>
            <h3>Xin chào : {{ $data['name'] }}<b></b></h3>
        </div>
        <div>
            @if (isset($data['date_book']))
                @if (!empty($data['user']))
                    <p>{{ $data['user']['type'] == 1 ? 'Giáo viên : ' : 'Sinh viên :' }} {{ $data['user']['name'] }}</p>

                @endif
                <p>Bắt đầu : {{ date('Y-m-d', strtotime($data['date_book'])) }} giờ : {{ date('H:i', strtotime($data['date_book'])) }} phút</p>
                <p>Kết thúc : {{ date('Y-m-d', strtotime($data['end_date_book'])) }} giờ : {{ date('H:i', strtotime($data['end_date_book'])) }} phút</p>
                <p>Xác nhận tham gia :
                    <a href="{{ route('schedule.student.confirm', ['noti_id' => $data['nu_notification_id'], 'user_id' => $data['nu_user_id'], 'type' => 2]) }}">Không tham gia</a>
                    |
                    <a href="{{ route('schedule.student.confirm', ['noti_id' => $data['nu_notification_id'], 'user_id' => $data['nu_user_id'], 'type' => 1]) }}">Có tham gia</a></p>
            @endif

            <p>Nội dung : </p>
            {!! $data['content'] !!}
        </div>
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <h4>Thông tin liên hệ hỗ trợ</h4>
        <p style="margin:2px 0;color: #333">Email hỗ trợ : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
    </div>
</div>