// Ẩn hiện các form đăng nhập,đăng ký,lấy lại mật khẩu...
function goToForm(name) {
    $.ajax({
        url: 'loadForm',
        method: 'GET',
        data: { 'name': name, },
        success: function (response) {
            $('#include').html(response);
        }
    });

}
//Dang Nhap
function signIn() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    var data3 = {
        'tendangnhap': username,
        'matkhau': password,
    }
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'dn',
        data: data3,
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.flag == false) {
                AnHienThongBao(document.getElementById("error-login"), data.mess);
            }
            else {
                location.href = 'home';
            }
        }
    })
}

//Hien thi mat khau
function showPass(idname) {
    if (idname == 'pass_word') {
        var x = document.getElementById(idname);
        var x2 = document.getElementById('confirm_pass-signup');
        if (x.type === "password") {
            x.type = "text";
            x2.type = "text";
        } else {
            x.type = "password";
            x2.type = "password";
        }
    }
    else if (idname == 'new_pass') {
        var x = document.getElementById(idname);
        var x2 = document.getElementById('confirm_pass');
        if (x.type === "password") {
            x.type = "text";
            x2.type = "text";
        } else {
            x.type = "password";
            x2.type = "password";
        }
    } else {
        var x = document.getElementById(idname);
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

}

//dang ky
function signUp() {
    var username = document.getElementById("user_name").value;
    var passwordconfirm = document.getElementById("confirm_pass-signup").value;
    var password = document.getElementById("pass_word").value;
    var data3 = {
        'tendangnhap': username,
        'matkhau': password,
        'xacnhanmatkhau': passwordconfirm,
    }
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'dk',
        data: data3,
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.flag == false) {
                AnHienThongBao(document.getElementById("error-signUp"), data.mess);
            }
            else {
                window.location.href = 'login';
            }
        }
    });
}

//Xoa du lieu nhap cua the input
function clear_input() {
    document.getElementById("user_name").value = '';
    document.getElementById("confirm_pass-signup").value = '';
    document.getElementById("pass_word").value = '';
    document.getElementById("error-signUp").innerHTML = '';
    //
    document.getElementById("new_pass").value = '';
    document.getElementById("confirm_pass").value = '';
    document.getElementById("email_to").textContent = '';
    //
    for (var i = 1; i <= 5; i++)
        document.getElementById("i" + i).value = '';
}
//Dem nguoc thoi gian
var mail = '';
//
function startCountdown() {
    var countdownEL = document.getElementById('countdown');
    let seconds = 60;
    let interval = setInterval(function () {
        countdownEL.innerHTML = seconds;
        nextInput();
        if (seconds > 0) { seconds--; }
        else {
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: 'setOTPnull',
                success: function () { clearInterval(interval); }
            });
        }
        if (seconds == 9) { document.getElementById('countdown').style.color = "red"; }
    }, 1000);
}
// Sự kiện gửi và xác nhận mã OTP
function next() {
    mail = $('#email_otp').val();
    if (mail == '') {
        AnHienThongBao(document.getElementById("error-email"), 'Vui lòng nhập đầy đủ');
    }
    var data = {
        'email': mail,
    };
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'otp',
        data: data,
        success: function (res) {
            $('#include').html(res);
            startCountdown();
        }
    });
};
//kiem tra mat khau de cap nhat mat khau moi
function checkpass() {
    var new_pass = document.getElementById("new_pass").value;
    var confirm_pass = document.getElementById("confirm_pass").value;
    var data2 = {
        'gmail': mail,
        'newPassword': new_pass,
        'confirmPass': confirm_pass,
    };
    console.log(mail);
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'recoverpass',
        data: data2,
        success: function (response) {
            var data = $.parseJSON(response);
            if (data.flag == false) {
                AnHienThongBao(document.getElementById("error-newpass"), data.mess);
            }
            else {
                window.location.href = 'login';
            }
        }
    });
}
// Gui lai ma OTP
function reloadcode() {
    document.getElementById('countdown').style.color = "black";
    var data = {
        'email': mail,
    };
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: 'reloadOTP',
        data: data,
        success: function () { startCountdown(); }
    });
}
// Chuyển đến thẻ input tiếp theo
function nextInput() {
    const inputs = document.getElementById("inputs");

    inputs.addEventListener("input", function (e) {
        const target = e.target;
        const val = target.value;
        if (isNaN(val)) {
            target.value = "";
            return;
        }
        if (val != "") {
            const next = target.nextElementSibling;
            if (next) {
                next.focus();
            }
        }
    });

    inputs.addEventListener("keyup", function (e) {
        let target = e.target;
        let key = e.key.toLowerCase();

        if (key == "backspace" || key == "delete") {
            target.value = "";
            const prev = target.previousElementSibling;
            if (prev) {
                prev.focus();
            }
            return;
        }
    });
}
// kiem tra ma OTP
function checkcode() {
    var code_input = "";
    var fill = 1;
    for (var i = 1; i <= 5; i++) {
        if (document.getElementById("i" + i).value == '') {
            fill = 0;
        }
        code_input += document.getElementById("i" + i).value;
    }
    if (fill == 0) {
        AnHienThongBao(document.getElementById("error-otp"), "Mã OTP gồm 5 số");
    }
    else {
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: 'checkOTP',
            data: { 'code': code_input },
            success: function (res) {
                var data = $.parseJSON(res);
                if (data.flag == 'true') {
                    $('#include').html(data.view);
                    startCountdown = function () { };
                    nextInput = function () { };
                    $.ajax({
                        type: 'get',
                        dataType: 'html',
                        url: 'setOTPnull',
                        success: function () { }
                    });
                }

                else {
                    AnHienThongBao(document.getElementById("error-otp"), "Sai mã OTP");
                }
            }
        });
    }
}
//an hien thong bao sau 4s
function AnHienThongBao(element, thongbao) {
    element.style.display = "block";
    element.innerHTML = thongbao;
    setTimeout(() => {
        element.style.display = "none";
    }, 4000);
}