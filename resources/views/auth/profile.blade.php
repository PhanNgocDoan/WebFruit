@foreach($info as $row)
<div class="text-center" id="info">
    <h3>Thông tin tài khoản</h3>
    <div class="container-avatar">
        <div class="child-avatar">
            <a class="fancybox" data-fancybox="images2" href data-src="images/avatar/{{$row->Avatar}}">
                <img src="images/avatar/{{$row->Avatar}}" alt="">
            </a>
        </div>
    </div>
    <p><b>Tài Khoản:</b> {{$row->TaiKhoan}}</p>
    <p><b>Email:</b> {{$row->Email}}</p>
    <p><b>Số Điện Thoại:</b> {{$row->Phone}}</p>
    <p><b>Địa Chỉ:</b> {{$row->DiaChi}}</p>
    <p><b>Họ Tên:</b> {{$row->HoTen}}</p>
    <button class="btn-profile editpro" onclick="show_edit()"><i class="fa">Chỉnh sửa &#xf044;</i></button><br><br>
    <button class="btn-profile outpro" onclick="window.location.href='/logout'"><i class="fa">Đăng Xuất
            &#xf08b;</i></button>
</div>
<div id="edit-form" style="display:none">
    <a href=""><i style="font-size:24px;margin-left:10px;color:black" class="fa">&#xf0a8;</i></a>
    <form action="/edit{{$row->MaTaiKhoan}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="tiltle">
            <h2>Edit Profile</h2>
        </div>
        <div class="container-avatar">
            <div class="child-avatar">
                <label for="avatar-upload" class="label-avatar">
                    <img src="images/avatar/{{$row->Avatar}}" id="img-avatar" alt="">
                    <i class="fa camera">&#xf030;</i>
                </label>
                <input type="file" name="uploadAvatar" id="avatar-upload" onchange="loadImg(this)">
            </div>
        </div>
        <div>
            <b>Họ tên<a style="color:red;">*</a></b><br>
            <input type="text" id="username-edit" name="username-edit" value="{{$row->HoTen}}" placeholder="Full Name"
                required>
        </div>
        <div>
            <b>Địa chỉ<a style="color:red;">*</a></b><br>
            <input type="text" id="address-edit" name="address-edit" value="{{$row->DiaChi}}" placeholder="Your Address"
                required>
        </div>
        <div>
            <b>Email<a style="color:red;">*</a></b><br>
            <input type="email" id="email-edit" name="email-edit" value="{{$row->Email}}" placeholder="Your Email"
                required>
        </div>
        <div>
            <b>Số điện thoại<a style="color:red;">*</a></b><br>
            <input type="tel" id="phone-edit" name="phone-edit" value="{{$row->Phone}}" placeholder="Phone Number"
                pattern="[0]{1}[0-9]{3}[0-9]{3}[0-9]{3}" required>
        </div>
        <br>

        <div class="submit">
            <button class="btn btn-success" type="submit">Cập
                nhật</button>
            <i>
                <h5 style="color:green;" id="error-edit"></h5>
            </i>
        </div>
    </form>
</div>
@endforeach