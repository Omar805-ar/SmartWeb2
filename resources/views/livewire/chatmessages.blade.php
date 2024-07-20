<div class="flex justify-center align-items-center">
    <div class="card bg-blueGray-100">
        <div class="card-header  mb-1">
            <div class="flex-3">
                <h2 class="text-xl py-1 mb-8 border-b-2 border-gray-200">Chatting with
                    <b>{{ $room->merchant->first_name . ' ' . $room->merchant->last_name }}</b>
                </h2>
            </div>
        </div>
        <div class="card-body">


            <div class="chat-area   user-chats  flex-1 flex flex-col">
                <div class="messages flex-1 overflow-auto ">
                    {{-- @foreach ($room->messages as $message) --}}
                    @foreach ($messageso as $message)

                        @if ($message['sender_id'] ==  $merchant_id)
                            <div class="message mb-4 flex">
                                <div class="flex-2">
                                    <div class="w-12 h-12 relative">
                                        <img class="w-12 h-12 rounded-full mx-auto"
                                            src="https://ui-avatars.com/api/?name={{ $room->merchant->first_name }}+{{ $room->merchant->last_name }}&background=a0cff0&color=fff"
                                            alt="chat-user" />
                                    </div>
                                </div>
                                <div class="flex-1 px-2">
                                    <div style="max-width: 700px"
                                        class="inline-block bg-gray-300 rounded-full p-2 px-6 text-gray-700">
                                        <span>{{ $message['message'] }}</span>
                                    </div>
                                    <div class="pl-4"><small
                                            class="text-gray-500">{{ date('d F', strtotime($room->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="message me mb-4 flex text-right">
                                <div class="flex-1 px-2">
                                    <div style="max-width: 700px" class="inline-block bg-blue-600 rounded-full p-2 px-6 text-white">
                                        <span>{{ $message['message'] }}</span>
                                    </div>
                                    <div class="pl-4"><small
                                            class="text-gray-500">{{ date('d F', strtotime($room->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <form wire:submit.prevent="sentmessage" class="flex-2 pt-4 pb-10">
                    <div class="write bg-white shadow flex rounded-lg">
                        <div class="flex-1">
                            <textarea  wire:model="message" wire:keydown.enter="sentmessage"  name="message" class="w-full block outline-none py-4 px-4 bg-transparent" rows="1" autofocus></textarea>
                        </div>
                        <div class="flex-2 w-32 p-2 flex content-center text-center items-center">
                            <div class="flex-1">
                                <button type="submit"  class="sendMessageButton bg-blue-400 w-10 h-10 rounded-full inline-block">
                                    <i class="fas fa-paper-plane text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    window.addEventListener('scroll', event => {
        userChats = $('.user-chats');
    userChats.animate({ scrollTop: userChats[0].scrollHeight }, 400);
    })
    </script>


@endpush
