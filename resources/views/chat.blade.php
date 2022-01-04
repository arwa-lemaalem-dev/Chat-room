<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
    .list-group {
        overflow-y: scroll;
        height: 220px;
        padding-right: 5px;
        
    }

    </style>

</head>

<body>
    <div id="app">
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Direct Chat</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                        data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="direct-chat-messages">
                    <ul class="list-group" v-chat-scroll>
                        @foreach($chats as $chat)
                        @if(auth()->user()->id!=$chat->user)
                        <li>
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">{{$chat->nom}}</span>
                                    <span class="direct-chat-timestamp float-right">{{$chat->created_at}}</span>
                                </div>
                                <img class="direct-chat-img" src="/dist/img/{{$chat->image}}" alt="message user image">
                                <div class="direct-chat-text">
                                    {{$chat->message}}
                                </div>
                            </div>
                        </li>
                        @else
                        <li>
                            <a class=" text-dark supp" href="/supp/{{$chat->id}}">
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right"> You</span>
                                        <span class="direct-chat-timestamp float-left">{{$chat->created_at}}</span>
                                    </div>
                                    <img class="direct-chat-img" src="/dist/img/{{$chat->image}}"
                                        alt="message user image">
                                    <div class="direct-chat-text">
                                        {{$chat->message}}
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endif
                        @endforeach
                        <new-msg v-for="value,index in chat.message" :key=value.index :color=chat.color[index]
                            :user=chat.user[index] :time=chat.time[index] :image=chat.image[index]>@{{ value }}
                        </new-msg>
                    </ul>
                </div>
            </div>

            <div class="card-footer">
                <div class="input-group">
                    <input type="text" name="message" placeholder="Type Message ..." class="form-control"
                        v-model="message" @keyup.enter="send" />
                    <span class="input-group-append">
                        <button type="button" class="btn btn-primary" v-on:click="send">Send</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>