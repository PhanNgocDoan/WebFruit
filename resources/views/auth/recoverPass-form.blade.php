<div id="recoverPassform">
    <a href=""><i style="font-size:24px;margin-left:10px;color:black" class="fa">&#xf0a8;</i></a>
    <form action="#" method="get">
        <div class="tiltle">
            <h2>Khôi phục mật khẩu</h2>
        </div>
        <div>
            <b>Email<a style="color:red;">*</a></b><br>
            <input type="email" id="email_otp" name="email" value=""
                placeholder="Mã OTP sẽ gửi về địa chỉ email tại đây!" required>
        </div>
        <br>
    </form>
    <div class="submit">
        <button class="btn btn-secondary" onclick="next();">Tiếp
            tục</button>
        <i>
            <h5 style="color:red;" id="error-email"></h5>
        </i>
    </div>

</div>