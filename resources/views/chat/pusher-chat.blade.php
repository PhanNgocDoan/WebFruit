<!DOCTYPE html>
<html lang="en">

<head>
    <title>Chat Laravel Pusher | Edlin App</title>
    <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JavaScript -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- End JavaScript -->

    <!-- CSS -->
    <link rel="icon" href="images/core-img/favicon.ico">
    <link rel="stylesheet" href="../css/chat.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" type="text/css" rel="stylesheet">
    <!-- End CSS -->

</head>

<body>
    <div id="app" class="container chat">
        <!-- <h3 class=" text-center">Messaging | User: </h3> -->
        <h3 class=" text-center">Messaging | {{$name}}</h3>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="inbox_chat">
                        @if($list!=null)
                        @foreach($list as $row)
                        <div class="chat_list" id="user{{$row->MaTaiKhoan}}"
                            onclick="location.href='chat_user{{$row->MaTaiKhoan}}'" style="cursor:pointer;">
                            <div class="chat_people">
                                <div class="chat_img"><img src="images/avatar/{{$row->Avatar}}" alt="sunil"></div>
                                <div class="chat_ib">
                                    <h5>{{$row->TaiKhoan}}<span class="chat_date">Dec 25</span></h5>
                                    <div>
                                        <span class="number mySpan{{$row->MaTaiKhoan}}">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="mesgs">
                    <div id="container-history">
                        <div id="msg">
                            <div class="messages">
                                @include('chat/ReceiveMessage',['message'=>"Hey! What's up!
                                 👋",'time'=>now()->subHours(5)])
                                @if($chat!=null)
                                @foreach($chat as $row)
                                @if($row->IsUser==$type)
                                @include('chat/BroadcastMessage',['message'=>$row->NoiDung,'time'=>$row->ThoiGian])
                                @else
                                @include('chat/ReceiveMessage',['message'=>$row->NoiDung,'time'=>$row->ThoiGian])
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="type_msg">
                            <div class="input_msg_write">
                                <form>
                                    <input type="text" class="write_msg" name="message" placeholder="Type a message"
                                        id="message" autocomplete="off">
                                    <button class="msg_send_btn" type="submit">
                                        <i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
function getSession(key) {
    const sessionValue = localStorage.getItem(key);
    return sessionValue;
}
// Get the value of the "session" 
var type = <?php echo $type ;?>;
if (type == 1) {
    var SessionValue = @json(session('user'));
} else {
    var SessionValue = @json(session('admin'));
}

// Pusher.logToConsole = true;

var pusher = new Pusher('951e298a4cf0d46d9655', {
    cluster: 'eu',
    encrypted: true,
});

//var channel = pusher.subscribe('public');
// nhận tin nhắn của người này

var channel = pusher.subscribe(<?php echo $chater1?> + 'and' + <?php echo $chater2?>);
channel.bind('chat', function(data) {
    $.post("/receive", {
            _token: '{{csrf_token()}}',
            message: data.message,
        })
        .done(function(res) {
            $(".messages > .message").last().after(res);
            $("#msg").scrollTop($("#msg")[0].scrollHeight);
            var number = parseInt($('.mySpan' + <?php echo $chater2?>).text());
            $('.mySpan' + "<?php echo $chater2?>").text(number + 1 + '');
        });
});

//Broadcast messages
$("form").submit(function(event) {
    event.preventDefault();
    $.ajax({
        url: "/broadcast",
        method: 'POST',
        headers: {
            'X-Socket-Id': pusher.connection.socket_id
        },
        data: {
            _token: '{{csrf_token()}}',
            message: $("form #message").val(),
            my: SessionValue,
            chatwith: <?php echo $chater2?>,
            type: type,
        }
    }).done(function(res) {
        $(".messages > .message").last().after(res);
        $("form #message").val('');
        $("#msg").scrollTop($("#msg")[0].scrollHeight);
    });
});
</script>

</html>