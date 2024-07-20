<?php

namespace App\Http\Resources\Merchant;

use App\Models\Chat;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{

    protected $count_unread;

    public function __construct($resource, string $count_unread)
    {
        parent::__construct($resource);
        $this->count_unread = $count_unread;

    }

    public function toArray(Request $request): array
    {

        return   [
            'message_id'  => $this->id,
            'sender_id'   => $this->sender_id,
            'message'     => $this->message,
            'read'        => $this->is_read,
            'count'       => $this->count_unread

        ];
    }
}
