<!DOCTYPE html>
<html lang="en">
@include("admin/templates/css")
@include("admin/templates/js")

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
</head>

<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="login-admin" method="post">
            @csrf
            <label for="username">Username: </label>
            <div class="input-group">
                <span><i class="fa-solid fa-user"></i></span>
                <input type="text" id="username" name="username" required>
            </div>
            <label for="password">Password: </label>
            <div class="input-group">
                <span><i class="fa-solid fa-lock"></i></span>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-check">
                <input type="checkbox" id="showPassword"> <span class="ml-2" for="showPassword">Hiển thị mật khẩu</span>
            </div>
            <div class="mt-3" style="text-align: center;"><button type="submit">Login</button></div>
        </form>
    </div>
</body>
<script>
var err = <?php
                if (isset($flag)) echo $flag;
                else echo ('');
                ?>;
if (err == 1) {
    document.getElementById('password').style = "border:1px solid red";
} else if (err == 0) {
    document.getElementById('username').style = "border:1px solid red";
    document.getElementById('password').style = "border:1px solid red";
}
</script>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    background-color: #f4f4f4;
    position: relative;
}

.login-admin {
    position: relative;
}

.login-container {
    background-color: #fff;
    padding: 30px;
    width: 100%;
    max-width: 300px;
    border-radius: 5px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

.input-check {
    display: flex;
    align-items: center;
}

.input-group {
    margin-bottom: 15px;
    width: 100%;
    border: 1px solid #ccc;
    display: flex;
    background-color: -internal-light-dark(rgb(232, 240, 254), rgba(70, 90, 126, 0.4)) !important;
}

.input-group>span {
    width: 40px;
    line-height: 30px;
    text-align: center;
    border-right: 1px solid #ccc;
    display: block;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    height: 30px;
    border-radius: 3px;
    border: 1px solid transparent;
    padding: 0px 10px;
    width: calc(100% - 40px);
}

button {
    padding: 8px 25px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>
<script>
const passwordField = document.getElementById('password');
const showPasswordCheckbox = document.getElementById('showPassword');

showPasswordCheckbox.addEventListener('change', function() {
    if (showPasswordCheckbox.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});
</script>

</html>