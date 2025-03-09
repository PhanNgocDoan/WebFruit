//let numb = document.getElementById("msg").childElementCount;
$("#msg").scrollTop($("#msg")[0].scrollHeight);
var tg;
var flag = false;
var cookie = document.getElementById("ck").value;
//
var myinterval = setInterval(getdatamessage, 1500);
function getdatamessage() {
    var data = {
        'chatid': document.getElementById("IDchat").value,
    };
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'getmsg',
        data: data,
        success: function (response) {
            var json = $.parseJSON(response);
            if (flag == false) {
                tg = json.tg;
                flag = true;
            }
            if (json.tg != tg && json.is != cookie) {
                var chat = chatUser(json.nd, json.tg);
                $("#msg").append(chat);
                $("#msg").scrollTop($("#msg")[0].scrollHeight);
                tg = json.tg;
            }
            else if (json.tg != tg && json.is == cookie) {
                var chat = chatadmin(json.nd, json.tg);
                $("#msg").append(chat);
                $("#msg").scrollTop($("#msg")[0].scrollHeight);
                tg = json.tg;
            }
        }
    });
}
//
function send(isUser, chatid) {
    var message = document.getElementById("message").value;
    if (message == '') {
        alert('vui long nhap noi dung');
    }
    else {
        var data = {
            'message': message,
            'is_user': isUser,
            'chatid': chatid,
        }
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: 'send',
            data: data,
            success: function () {
                document.getElementById('message').value = '';
            }
        });
    }
}
//
function chatUser(noidung, thoigian) {
    var div = '<div><div class="incoming_msg">' +
        '<div class="incoming_msg_img">' +
        '<img src="https://ptetutorials.com/images/user-profile.png" alt="sunil">' +
        '</div>' +
        '<div class="received_msg">' +
        '<div class="received_withd_msg">' +
        '<p>' + noidung + '</p>' +
        '<span class="time_date" style="font-size:10px;">' + thoigian + '</span></div></div></div></div>';
    return div;
}
//
function chatadmin(noidung, thoigian) {
    var div = '<div><div class="outgoing_msg"><div class="sent_msg"><p>' + noidung +
        '</p><span class="time_date" style="font-size:10px;">' + thoigian +
        '</span></div></div></div>';
    return div;
}
//
function toMessage(id) {

}

// function reload() {
//     var scrollTarget = $('#msg');
//     var pos = scrollTarget.scrollTop();
//     $("#container-history").load(location.href + ' #msg', function () {
//         $('#msg').scrollTop(pos);
//     });
// }



