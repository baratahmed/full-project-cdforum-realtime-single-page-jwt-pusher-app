<?php

namespace App\Notifications;

use App\Model\Reply;
use Illuminate\Bus\Queueable;
use App\Http\Resources\ReplyResource;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class NewReplyNotification extends Notification
{
    use Queueable;

    public $reply;

    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }

    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    public function toArray($notifiable)
    {
        return [
            'replyBy' => $this->reply->user->name,
            'question_title' => $this->reply->question->question_title,
            'question_path' => $this->reply->question->path,
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'replyBy' => $this->reply->user->name,
            'question_title' => $this->reply->question->question_title,
            'question_path' => $this->reply->question->path,
            'reply' => new ReplyResource($this->reply)
        ]);
    }
}
