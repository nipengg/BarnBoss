@extends('layouts.app')

@section('content')

    <head>
        <style>
            /* body,html{
                                                    height: 100%;
                                                    margin: 0;
                                                    background: #7F7FD5;
                                                   background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
                                                    background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
                                                } */

            .chat {
                margin-top: auto;
                margin-bottom: auto;
            }

            .card {
                height: 650px;
                border-radius: 15px !important;
                background-color: rgba(0, 0, 0, 0.4) !important;
            }

            .msg_card_body {
                overflow-y: auto;
            }

            .msg_card_body::-webkit-scrollbar {
                display: none;
            }

            .card-footer {
                border-radius: 0 0 15px 15px !important;
                border-top: 0 !important;
            }

            .container {
                align-content: center;
            }

            .type_msg {
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                height: 60px !important;
                overflow-y: auto;
            }

            .attach_btn {
                border-radius: 15px 0 0 15px !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                cursor: pointer;
            }

            .msg_cotainer {
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 10px;
                border-radius: 25px;
                background-color: #78e08f;
                padding: 10px;
                position: relative;
            }

            .msg_cotainer_send {
                margin-top: auto;
                margin-bottom: auto;
                margin-right: 10px;
                border-radius: 25px;
                background-color: #82ccdd;
                padding: 10px;
                position: relative;
            }

            .msg_time {
                /* position: absolute; */
                left: 0;
                bottom: -15px;
                color: gray;
                font-size: 13px;
            }

            @media(max-width: 576px) {}
        </style>
    </head>

    <div class="container" style="margin-top: 80px">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chat</li>
            </ol>
        </nav>

        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="align-content: center">
            <h3 class="h3 mb-0 text-gray-800">Chat with {{ $chat->seller->id == Auth::user()->id ? $chat->user->name : $chat->seller->name }} | Transaction invoice #{{ $chat->invoice_id }}</h3>
        </div>
        <hr class="mb-4">
        <form action="{{ route('send', $chat->id) }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-xl-6 chat">
                        <input type="hidden" name="qa_id" value="">
                        <div class="card">
                            <div id="here" class="card-body msg_card_body">
                                @foreach ($messages as $item)
                                    @if (Auth::user()->id == $item->sender_id)
                                        <div class="d-flex justify-content-end mb-4">
                                            <div class="msg_cotainer">
                                                <span class="msg_time">{{ $item->messages }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-start mb-4">
                                            <div class="msg_cotainer_send">
                                                <span class="msg_time">{{ $item->messages }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="input-group">
                                    <textarea name="messages" class="form-control type_msg" placeholder="Type your message..." required></textarea>
                                    <div class="input-group-append">
                                        <button type="submit" id="btn-custom"
                                            class="btn-block btn btn-primary">Send</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            setInterval(function() {
                $("#here").load(window.location.href + " #here");
            }, 1000);
        });

        $('#here').scrollTop($('#here')[0].scrollHeight);
    </script>
@endsection
