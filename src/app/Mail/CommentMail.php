<?php

namespace App\Mail;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $comment = Comment::query()->find($this->data['comment_id']);

        if (empty($comment->id)) {
            return false;
        }

        $params = [
            'post_title' => $comment->post->title,
            'post_link' => $comment->post->link,
            'author' => $comment->author,
            'author_ip' => $comment->author_ip,
            'author_email' => $comment->author_email,
            'content' => $comment->content,
            'company_name' => $this->data['company_name'],
        ];

        return $this->to($this->data['email'])
            ->cc($comment->author_email)
            ->subject('[' . $this->data['company_name'] . '] Please moderate: "' . $params['post_title'])
            ->view('site.email.comment.member_create', ['params' => $params]);
    }
}
