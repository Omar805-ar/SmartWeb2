<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\Room;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\Merchant\ChatResource;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $conversion;
    private $room_id,$count_unread;
    public function __construct($conversion, $room_id,$count_unread=0)
    {
        $this->conversion = $conversion;
        $this->room_id = $room_id;
        $this->count_unread = $count_unread;
    }


    public function broadcastOn(): array
    {

        return [
            new Channel('channel-' . $this->room_id),
        ];
    }
    public function broadcastWith()
    {
        return (new ChatResource($this->conversion,$this->count_unread))->toArray(request());
    }
    public function broadcastAs()
    {
        return  'message';
    }
}
