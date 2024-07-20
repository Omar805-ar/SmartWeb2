<?php


namespace App\Http\Controllers\Api\V1\Merchant;

use App\Models\Room;
use Gate;
use App\Models\Chat;
use App\Models\Country;
use App\Events\SendMessage;
use Illuminate\Support\Str;
use App\Events\SendMessage1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Helpers\GlobalHelper;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Resources\Merchant\ChatResource;

class ChatApiController extends Controller
{

    use ResponseHelper, GlobalHelper;
    public function getmessage()
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());

        $room = Room::where('merchant_id', '=', $merchantID)->where('archived', '=', 0)->first();
        if ($room) {
            $messages = Chat::where(['room_id' => $room->id])->get();
            $this->read_messages();
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'), ChatResource::collection($messages,$this->count_unread()));
        }
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'));
    }
    public function read_messages()
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $room = Room::where('merchant_id', '=', $merchantID)->where('archived', '=', 0)->first();
        if ($room) {


            $query = Chat::where(['room_id' => $room->id, 'receiver_id' => $merchantID, 'is_read' => 0]);
            $query->update(['is_read' => 1]);
            return $this->apiResponseHandler(200, true, __('request.data_retrieved'));
        }
    }

    public function count_unread()
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $room = Room::where('merchant_id', '=', $merchantID)->where('archived', '=', 0)->first();
        if ($room) {

            return  Chat::where(['room_id' => $room->id, 'receiver_id' => $merchantID, 'is_read' => 0])->count();
        } else {
            return 0;
        }
    }
    public function send_message(Request $request)
    {


        if ($request->has('id')) {
            $merchantID = $request->id;
        } else {
            $merchantID = $this->getUserIDByToken(request()->bearerToken());
        }
        $room = Room::where(['merchant_id' => $merchantID, 'archived' => 0])->first();
        $conversion = [
            'sender_id'     => $merchantID,
            'message'       => $request->message,
            'receiver_id'   => 0,
            'room_id'   =>  $room->id,
        ];
        $conversion = Chat::create($conversion);
        event(new SendMessage($conversion, $room->id, $this->count_unread()));

        return $this->apiResponseHandler(200, true, __('request.data_retrieved'));
    }


    public function send_messagebyadmin(Request $request)
    {
        Chat::create([
            'sender_id'     => null,
            'message'       => $request->message,
            'receiver_id'   => $request->merchant_id
        ]);
        $conversion = Chat::where('sender_id', $request->merchant_id)->orWhere('receiver_id', $request->merchant_id)->get();
        $conversion =  ChatResource::collection($conversion);
        event(new SendMessage($conversion, $request->merchant_id, $this->count_unread()));
        return $this->apiResponseHandler(200, true, __('request.data_retrieved'));
    }
    public function check_if_merchant_has_opened_room()
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $room = Room::where('merchant_id', '=', $merchantID)->where('archived', '=', 0)->first();
        return $this->apiResponseHandler(200, true, [
            'has_room' => ($room != null ? true : false),
            'room_id' => ($room != null ? $room->id : null)
        ]);
    }
    public function start_chat_room()
    {
        $merchantID = $this->getUserIDByToken(request()->bearerToken());
        $room = Room::create([
            'merchant_id' => $merchantID
        ]);
        return $this->apiResponseHandler(200, true, $room);
    }
    public function end_chat_room($id)
    {
        //$merchantID = $this->getUserIDByToken(request()->bearerToken());
        $room = Room::find($id)->update([
            'archived'  => 1
        ]);
        return $this->apiResponseHandler(200, true, $room);
    }
}
