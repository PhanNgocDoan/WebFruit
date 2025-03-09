<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="demo">
        <h2 style="text-align:center">Nhân viên tư vấn</h2>
        <div class="demo2">
            @foreach($admin as $row)
            <div class="lol">
                <div class="card">
                    <img src="../images/avatar/avatar.png" alt="" style="width:50%">
                    <h1>{{$row->TaiKhoan}}</h1>
                    <p class="title">Tư vấn, hỗ trợ khách hàng</p>
                    <p>@if($row->TrangThai==1) <a style="color:green">Online</a> @else <a style="color:red">Offline</a>
                        @endif</p>
                    <div style="margin: 24px 0;">
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                    </div>
                    <p><button onclick="window.location.href='chat_admin{{$row->MaTaiKhoan}}'">Trò chuyện</button></p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
    }

    a {
        text-decoration: none;
        font-size: 22px;
        color: black;
    }

    button:hover,
    a:hover {
        opacity: 0.7;
    }



    .demo2 {
        display: flex;
        overflow-x: auto;
    }

    .demo2 .lol {
        margin-left: 20px;
    }
    </style>

</html>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
Pusher.logToConsole = true;

var pusher = new Pusher('951e298a4cf0d46d9655', {
    cluster: 'eu',
    encrypted: true,
});
var channel = pusher.subscribe('online');

channel.bind('list', function(data) {
    $('.demo').load(location.href + " .demo2");
});
</script>