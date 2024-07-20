<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request) {

        $rooms = Room::with('merchant', 'messages');

        if ($request->search != "" && $request->search != null) {
            $search = $request->search;

            $rooms = $rooms->whereHas('merchant', function ($query) use($search) {

                return $query->where('first_name', 'LIKE', "%$search%")->orWhere('first_name', 'LIKE', "%$search%");

            });

        }
        $rooms = $rooms->where('archived',0)->get();
        return view('admin.chat.index', compact('rooms'));

    }

    public function single(int $id)
    {

        $room = Room::with('merchant', 'messages')->findOrFail($id);
        return view('admin.chat.single', compact('room'));

    }
    public function livemessage($id)
    {

        return view('admin.chat.live_single', compact('id'));

    }
}
