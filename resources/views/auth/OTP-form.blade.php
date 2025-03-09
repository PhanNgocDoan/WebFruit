<div id="OTPform">
    <form action="#" method="get">
        <div class="tiltle">
            <h2>Xác nhận mã OTP</h2>
        </div>
        <p>Mã chỉ có tác dụng trong:</p>
        <p id="countdown" style="font-size:33px;"></p>
        <p id="email_to">{{$mail}}</p>
        <div id="inputs" class="inputs">
            <input class="input-otp" id="i1" type="text" inputmode="numeric" maxlength="1" required />
            <input class="input-otp" id="i2" type="text" inputmode="numeric" maxlength="1" required />
            <input class="input-otp" id="i3" type="text" inputmode="numeric" maxlength="1" required />
            <input class="input-otp" id="i4" type="text" inputmode="numeric" maxlength="1" required />
            <input class="input-otp" id="i5" type="text" inputmode="numeric" maxlength="1" required />
        </div><br>
    </form>
    <button onclick="checkcode();" class="btn btn-primary" style="margin-left:35%;">Xác
        nhận</button>
    <button onclick="reloadcode();" class="btn btn-secondary" style="margin-left:5%;">Gửi
        lại <i class="fa fa-refresh fa-spin" style="font-size:15px"></i></button>
    <br>
    <i>
        <h5 style="color:red;text-align:center;" id="error-otp"></h5>
    </i>
</div>