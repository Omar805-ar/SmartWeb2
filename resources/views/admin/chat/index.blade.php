@extends('layouts.admin')
@section('content')
<div class="flex justify-center align-items-center">
    <div class="card bg-blueGray-100" style="width: fit-content">
        <div class="card-body">
            <div class="sidebar">
                <div class="search flex-2 pb-6 px-2 mt-4">
                    <input type="text"
                        class="outline-none py-2 block w-full bg-transparent border-b-2 border-gray-200"
                        placeholder="Search">
                </div>
                <div class="flex-1 h-full overflow-auto px-2">
                    @foreach ($rooms as $room)
                    <a href="{{ route('admin.live.chats', ['id'=> $room->id]) }}"
                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md">
                        <div class="flex-2">
                            <div class="w-12 h-12 relative">
                                <img class="w-12 h-12 rounded-full mx-auto"
                                    src="https://ui-avatars.com/api/?name={{ $room->merchant->first_name }}+{{ $room->merchant->last_name }}&background=a0cff0&color=fff" alt="chat-user" />
                                <span class="absolute w-4 h-4 bg-green-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                            </div>
                        </div>
                        <div class="flex-1 px-2">
                            <div class="truncate w-32"><span class="text-gray-800">{{ $room->merchant->first_name . ' ' . $room->merchant->last_name }}</span></div>
                            <div>
                                <small class="text-gray-600">
                                    @if ($room->messages->count() > 0)

                                    {{ Str::limit($room->messages[0]->message, 15, '...') }}
                                    @endif
                                </small>
                            </div>
                        </div>
                        <div class="flex-2 text-right">
                            <div><small class="text-gray-500">{{ date('d F', strtotime($room->created_at)) }}</small></div>
                            @php
                                $count = App\Models\Chat::where('room_id', '=', $room->id)->where('is_read', '=', 0)->count();
                            @endphp
                            <div>
                            @if ( $count > 0)
                            <small class="text-xs bg-red-500 text-white rounded-full h-6 w-6 leading-6 text-center inline-block">
                                {{ $count }}
                            </small>
                            @endif
                            </div>
                        </div>
                    </a>
                    @endforeach



                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-body">

                <div class="w-full h-screen">
                    <div class="flex h-full">
                        <div class="flex-1 bg-gray-100 w-full h-full">
                            <div class="main-body container m-auto w-11/12 h-full flex flex-col">
                                <div class="main flex-1 flex flex-col">
                                    <div class="hidden lg:block heading flex-2">
                                        <h1 class="text-3xl text-gray-700 mb-4">Chat</h1>
                                    </div>

                                    <div class="flex-1 flex h-full">
                                        <div class="sidebar hidden lg:flex w-1/3 flex-2 flex-col pr-6">
                                            <div class="search flex-2 pb-6 px-2">
                                                <input type="text"
                                                    class="outline-none py-2 block w-full bg-transparent border-b-2 border-gray-200"
                                                    placeholder="Search">
                                            </div>
                                            <div class="flex-1 h-full overflow-auto px-2">
                                                <div
                                                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md">
                                                    <div class="flex-2">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full mx-auto"
                                                                src="../resources/profile-image.png" alt="chat-user" />
                                                            <span
                                                                class="absolute w-4 h-4 bg-green-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 px-2">
                                                        <div class="truncate w-32"><span class="text-gray-800">Ryann
                                                                Remo</span></div>
                                                        <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                    </div>
                                                    <div class="flex-2 text-right">
                                                        <div><small class="text-gray-500">15 April</small></div>
                                                        <div>
                                                            <small
                                                                class="text-xs bg-red-500 text-white rounded-full h-6 w-6 leading-6 text-center inline-block">
                                                                23
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md">
                                                    <div class="flex-2">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full mx-auto"
                                                                src="../resources/profile-image.png" alt="chat-user" />
                                                            <span
                                                                class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 px-2">
                                                        <div class="truncate w-32"><span class="text-gray-800">Karp
                                                                Bonolo</span></div>
                                                        <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                    </div>
                                                    <div class="flex-2 text-right">
                                                        <div><small class="text-gray-500">15 April</small></div>
                                                        <div>
                                                            <small
                                                                class="text-xs bg-red-500 text-white rounded-full h-6 w-6 leading-6 text-center inline-block">
                                                                10
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md border-l-4 border-red-500">
                                                    <div class="flex-2">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full mx-auto"
                                                                src="../resources/profile-image.png" alt="chat-user" />
                                                            <span
                                                                class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 px-2">
                                                        <div class="truncate w-32"><span class="text-gray-800">Mercedes
                                                                Yemelyan</span></div>
                                                        <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                    </div>
                                                    <div class="flex-2 text-right">
                                                        <div><small class="text-gray-500">15 April</small></div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md">
                                                    <div class="flex-2">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full mx-auto"
                                                                src="../resources/profile-image.png" alt="chat-user" />
                                                            <span
                                                                class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 px-2">
                                                        <div class="truncate w-32"><span class="text-gray-800">Cadi
                                                                Kajetán</span></div>
                                                        <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                    </div>
                                                    <div class="flex-2 text-right">
                                                        <div><small class="text-gray-500">15 April</small></div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="entry cursor-pointer transform hover:scale-105 duration-300 transition-transform bg-white mb-4 rounded p-4 flex shadow-md">
                                                    <div class="flex-2">
                                                        <div class="w-12 h-12 relative">
                                                            <img class="w-12 h-12 rounded-full mx-auto"
                                                                src="../resources/profile-image.png" alt="chat-user" />
                                                            <span
                                                                class="absolute w-4 h-4 bg-gray-400 rounded-full right-0 bottom-0 border-2 border-white"></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 px-2">
                                                        <div class="truncate w-32"><span class="text-gray-800">Rina
                                                                Samuel</span></div>
                                                        <div><small class="text-gray-600">Yea, Sure!</small></div>
                                                    </div>
                                                    <div class="flex-2 text-right">
                                                        <div><small class="text-gray-500">15 April</small></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
 --}}
