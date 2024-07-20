<?php

namespace App\Http\Livewire;

use App\Models\Chat;
use App\Models\Room;

use Livewire\Component;
use App\Events\SendMessage;
use App\Http\Resources\Merchant\ChatResource;

class Chatmessages extends Component
{
    public $room, $merchant_id, $romid, $messageso = [], $message;
    public function mount($id = null)
    {
        $this->romid =  $id;
        $this->room = Room::where('archived', 0)->with('merchant', 'messages')->findOrFail($this->romid);
        $this->merchant_id = $this->room->merchant_id;
        $this->getmessagesold();
    }
    public function sentmessage()
    {
        $conversion = [
            'sender_id'     => 0,
            'message'       => $this->message,
            'receiver_id'   => $this->merchant_id,
            'room_id'       => $this->romid
        ];
        $conversion = Chat::create($conversion);
        event(new SendMessage($conversion,  $this->romid));
        $this->message = '';
    }
    public function getListeners()
    {

        return [
            "echo:channel-{$this->romid},.message" => 'appendContent', 'getmessagesold' => 'getmessagesold'
            // "echo:channel-{$this->romid},.message" => 'appendContent', 'getmessagesold' => 'getmessagesold'
        ];
    }


    public function appendContent($event)
    {

        array_push($this->messageso, $event);
        $this->dispatchBrowserEvent('scroll');
    }
    public function getmessagesold()
    {
        $query = Chat::where(['room_id' => $this->romid]);
        $conversion =  $query->get();
        $this->messageso = ChatResource::collection($conversion)->resolve();
        $query->where(['receiver_id'=>0,'is_read' =>0])->update(['is_read' => 1]);
    }

    public function render()
    {
        return view('livewire.chatmessages');
    }
}
