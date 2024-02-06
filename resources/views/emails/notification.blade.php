<div style="width: 100%;max-width: 900px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        <h2 style="margin:10px 0;border-bottom: 1px solid #dedede;padding-bottom: 10px;">{{ $data['subject'] }}</h2>
        <div>
            <h3>Xin chào : {{ $data['name'] }}<b></b></h3>
        </div>
        <div>
            {!! $data['content'] !!}
        </div>
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <h4>Thông tin liên hệ hỗ trợ</h4>
        <p style="margin:2px 0;color: #333">Email hỗ trợ : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
    </div>
</div>