<div id="loginform">
    <form>
        <div class="tiltle">
            <h2>Đăng Nhập</h2>
        </div>
        <div>
            <b>Tài khoản <a style="color:red;">*</a></b><br>
            <input type="text" id="username" name="user_name" value="" placeholder="Username" required>
        </div>
        <div>
            <b>Mật khẩu <a style="color:red;">*</a></b><br>
            <input type="password" id="password" name="pass_word" value="" placeholder="Password" required>
        </div>
        <div>
            <input type="checkbox" onclick="showPass('password')" style="width:14px;height:12px;">
            Hiện mật khẩu
        </div>
        <div class="option">
            <i class="i">Chưa có tài khoản?<a href="javascript:goToForm('signup');" style="color:blue;"> Đăng
                    ký</a></i>
        </div>
        <div class="option">
            <i class="i">Quên mật khẩu?<a href="javascript:goToForm('recover');" style="color:blue;"> Khôi
                    phục</a></i>
        </div>
    </form>
    <div class="submit">
        <button class="btn btn-success" onclick="signIn();">Đăng nhập</button>
        <i>
            <h5 style="color:red;" id="error-login"></h5>
        </i>
    </div>
</div>