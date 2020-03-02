<div style="background: #FFFFFF; border-radius: 3px;">
    <p style="color: #000000;">
        Hi, {{ $params['name'] }}
    </p>

    <p style="color: #000000;">
        Chào mừng đến với {{ $params['company_name'] }}
    </p>

    <p style="margin: 20px 0">
        <a style="width: 140px; text-decoration: none; height: 40px; color: #fff; padding: 10px 15px; background: #2962FF; border-radius: 4px;"
           href="{{ $params['link_active'] }}">
            {{ trans('user.create.button_active_mail') }}
        </a>
    </p>

    <p>
        Hoặc copy link <a href="{{ $params['link_active'] }}">{{ $params['link_active'] }}</a>
    </p>

    <p style="border-bottom: 1px dashed #ccc; padding-bottom: 15px">Thank you for submitting! </p>

    <p style="text-align: left;color: #000000;">
        Chúc mừng bạn đã là thành viên của {{ $params['company_name'] }}
    </p>

    <p>
        <strong>Best regards,</strong><br/>
        {{ $params['company_name'] }} Team
    </p>
</div>