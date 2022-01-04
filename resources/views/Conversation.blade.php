@extends('layouts.app')

@section('content')
<meta name="user-id" content="{{ Auth::user()->id }}">
<div class="chat_window">
    <ul class="messages" v-chat-scroll>
        @foreach($chats as $chat)
        @if(Auth::user()->id!=$chat->from_id)
        <li>
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">{{$name}}</span>
                    <span class="direct-chat-timestamp float-right">{{$chat->created_at}}</span>
                </div>
                <img class="direct-chat-img" src="/dist/img/{{$avatar}}" alt="message user image">
                <div class="direct-chat-text">
                    {!! nl2br(e($chat->content)) !!}
                    @if($chat->offre=='yes')
                    <a class="icon" href="pdfOffre/{{$chat->id}}"><i class="bi bi-printer"></i></a>
                    @endif
                </div>
            </div>
        </li>
        @else
        <li>
            <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right"> You</span>
                    <span class="direct-chat-timestamp float-left">{{$chat->created_at}}</span>
                </div>
                <img class="direct-chat-img" src="/dist/img/{{Auth::user()->avatar}}" alt="message user image">
                <div class="direct-chat-text">
                    {!! nl2br(e($chat->content)) !!}
                    @if($chat->offre=='yes')
                    <a class="icon" href="pdfOffre/{{$chat->id}}"><i class="bi bi-printer"></i></a>
                    @endif
                </div>
            </div>
        </li>
        @endif
        @endforeach
        <new-msg v-for="value,index in chat.message" :key=value.index :color=chat.color[index] :user=chat.user[index]
            :offre=chat.offre[index] :time=chat.time[index] :image=chat.image[index] :message=chat.message[index]
            :idoffre=chat.idoffre[index]>@{{value}}
        </new-msg>
    </ul>

    <div class=" bottom_wrapper clearfix">
        <div class="row badge badge-pill badge-primary" style="width: 100px; " :style="styleTyping">@{{ typing }}
        </div>
        <div>
            <div class="message_input_wrapper row">
                <input class="message_input" placeholder="Type Message ..." class="form-control" v-model="message"
                    @keyup.enter="send" />
            </div>
            <div class="send_message">
                <div class="icon"></div>
                <div class="text" v-on:click="send">Send</div>
            </div>
            @if(Auth::user()->role=="fournisseur")
            <div class="row gutters ">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="Quantity">Quantity</label>
                        <input type="number" class="form-control" id="Quantity" placeholder="Enter Quantity..."
                            v-model="quantity">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="price">Price per item</label>
                        <input type="number" class="form-control" id="price" placeholder="Enter price ...."
                            v-model="price">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="cost">Delivery cost</label>
                        <input type="number" class="form-control" id="cost" placeholder="Enter Delivery cost ...."
                            v-model="cost">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="total">Total Price</label>
                        <input type="number" class="form-control" id="total" disabled placeholder="Total Price"
                            v-model="total">
                    </div>
                </div>
                <div class="send_message" style="width:100%">
                    <div class="icon"></div>
                    <div class="text" v-on:click="sendOffer">Send Offer</div>
                </div>
            </div>
            @endif
        </div>

    </div>
</div>


@endsection