<div style="background: #FFFFFF; border-radius: 3px;">
    <p style="color: #000000;">
        A new comment on the post "{{ $params['post_title'] }}" is waiting for your approval
    </p>

    <p style="color: #000000;">
        <a href="{{ $params['post_link'] }}" target="_blank">{{ $params['post_link'] }}</a>
    </p>

    <p style="color: #000000;">
        <strong>Author</strong>: {{ $params['author'] }} (IP address: {{ $params['author_ip'] }})
    </p>

    <p style="color: #000000;">
        <strong>Email</strong>: {{ $params['author_email'] }}
    </p>

    <p style="color: #000000;">
        <strong>Comment</strong>: {!!  $params['content']  !!}
    </p>

    <hr/>

    <p style="color: #000000;">
        Approve it:
        <a href="{{ admin_url('comments?status=1&page=0&time='.md5(time())) }}" target="_blank">
            {{ admin_url('comments?status=1&page=0&time='.md5(time())) }}
        </a>
    </p>
    <p>
        <strong>Best regards,</strong><br/>
        {{ $params['company_name'] }} Team
    </p>
</div>