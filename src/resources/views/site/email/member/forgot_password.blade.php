<div style="background: #FFFFFF; border-radius: 3px;">
    <p style="color: #000000;">
        Hi, {{ $params['name'] }}
    </p>

    <p style="color: #000000;">
        Mật khẩu mới của bạn là: {{ $params['password'] }}
    </p>

    <p style="border-bottom: 1px dashed #ccc; padding-bottom: 15px">Thank you for submitting! </p>
    <strong>Best regards,</strong><br/>
    {{ $params['company_name'] }} Team
    </p>
</div>