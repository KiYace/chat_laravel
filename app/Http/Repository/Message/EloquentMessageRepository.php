<?php

namespace App\Http\Repository\Message;

use App\Models\Message;
use Illuminate\Support\Collection;

class EloquentMessageRepository implements MessageRepository
{
    public function get(): \Illuminate\Database\Eloquent\Collection
    {
        $messages = Message::orderBy('created_at', 'asc')->get();
        return $messages;
    }

    public function store(Collection $collection): Message
    {
        $message = new Message();
        $message->nickname = $collection->get('nickname');
        $message->message = $collection->get('message');
        $message->save();

        return $message;
    }
}
