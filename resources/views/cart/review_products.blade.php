<button onclick="show_hide_review(1);" id="review-btn-cancel">X</button>
<form action="/upload" id="uploadForm" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <table class="review-table">
            <thead style="background-color:gray;color:white">
                <tr>
                    <th>SẢN PHẨM</th>
                    <th>NHẬN XÉT</th>
                    <th>ĐÁNH GIÁ</th>
                </tr>
            </thead>
            <tbody>
                <?php $arr=array(); ?>
                @foreach($list_products as $row)
                @php
                array_push($arr,$row->MaTraiCay);
                $mahd=$row->MaHD;
                @endphp
                <tr>
                    <td>
                        <img src="images/sanpham/{{$row->Anh}}" width=70 height=70 alt="Product">
                        <div style="font-size:12px">{{$row->TenTraiCay}}</div>
                    </td>
                    <td>
                        <div class="chung">
                            <textarea id="text_review{{$row->MaTraiCay}}" name="textarea{{$row->MaTraiCay}}"
                                spellcheck="false" placeholder="Nhận xét của bạn." required></textarea>
                            <div class="upload-img">
                                <div class="container-upload id{{$row->MaTraiCay}}">
                                    <div class="btn-del">
                                        <a href="javascript:xoaAnh({{$row->MaTraiCay}},1)" class="img-del">x</a>
                                    </div>
                                    <div class="img-up">
                                        <label for="file-upload1-{{$row->MaTraiCay}}" class="custom-file-upload">
                                            <img src="images/img.jpg" id="img1-{{$row->MaTraiCay}}" alt="">
                                        </label>
                                        <input type="file" name="fileToUpload1-{{$row->MaTraiCay}}"
                                            id="file-upload1-{{$row->MaTraiCay}}"
                                            onchange="loadImg(this,1,{{$row->MaTraiCay}})">
                                    </div>
                                </div>
                                <div class="container-upload id{{$row->MaTraiCay}}">
                                    <div class="btn-del">
                                        <a href="javascript:xoaAnh({{$row->MaTraiCay}},2)" class="img-del">x</a>
                                    </div>
                                    <div class="img-up">
                                        <label for="file-upload2-{{$row->MaTraiCay}}" class="custom-file-upload">
                                            <img src="images/img.jpg" id="img2-{{$row->MaTraiCay}}" alt="">
                                        </label>
                                        <input type="file" name="fileToUpload2-{{$row->MaTraiCay}}"
                                            id="file-upload2-{{$row->MaTraiCay}}"
                                            onchange="loadImg(this,2,{{$row->MaTraiCay}})">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="idsp{{$row->MaTraiCay}}" value="{{$row->MaTraiCay}}">
                        </div>
                    </td>
                    <td>
                        <div class="ratings">
                            <a href="javascript:setstar({{$row->MaTraiCay}},1)"><i
                                    class="fa fa-star ngoisao{{$row->MaTraiCay}}" aria-hidden="true"></i></a>
                            <a href="javascript:setstar({{$row->MaTraiCay}},2)"><i
                                    class="fa fa-star ngoisao{{$row->MaTraiCay}}" aria-hidden="true"></i></a>
                            <a href="javascript:setstar({{$row->MaTraiCay}},3)"><i
                                    class="fa fa-star ngoisao{{$row->MaTraiCay}}" aria-hidden="true"></i></a>
                            <a href="javascript:setstar({{$row->MaTraiCay}},4)"><i
                                    class="fa fa-star ngoisao{{$row->MaTraiCay}}" aria-hidden="true"></i></a>
                            <a href="javascript:setstar({{$row->MaTraiCay}},5)"><i
                                    class="fa fa-star ngoisao{{$row->MaTraiCay}}" aria-hidden="true"></i></a>
                            <input type="hidden" value="1" name="sao{{$row->MaTraiCay}}" id="star{{$row->MaTraiCay}}">
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <?php $jsonArray = json_encode($arr);?>
    <button class="btn-save" type="submit">Lưu đánh giá</button>
    <input type="hidden" name="data_arr" value="{{$jsonArray}}">
    <input type="hidden" name="mahd" value="{{$mahd}}">
</form>
<style>
.review-table {
    width: 100%;
    border-collapse: collapse;
}

.review-table td {
    border-bottom: 2px solid rgba(0, 0, 0, 0.30);
    text-align: center;
    padding-top: 10px;
    /* height: 100%; */
}

.btn-save {
    margin-top: 20px;
    color: white;
    text-align: center;
    width: 100%;
    background-color: #0da685;
    padding: 20px;
    border-radius: 50px 20px;
    border: none;
}

.fa-star {
    color: white;
    -webkit-text-stroke-width: 2px;
    -webkit-text-stroke-color: #0da685
}

/* -------------------!!!!!!!!!!!!!!------------------- */
.upload-img {
    display: flex;
}

.container-upload {
    /* display: none; */
    position: relative;
    width: 60px;
    padding-left: 5px;
}

.btn-del {
    background-color: black;
    position: absolute;
    right: 0px;
    border-radius: 50%;
    width: 15px;
}

.btn-del a {
    color: white;
}

.img-del:hover {
    color: red;
}

.upload-img img {
    width: 50px;
    height: 50px;
}
</style>
<script src="{{asset('ckeditor5-build-classic/ckeditor.js')}}"></script>
<script>
var arr = <?php echo($jsonArray);?>;

function xoaAnh(id, n) {
    document.getElementById('img' + n + '-' + id).src = 'images/img.jpg';
}

function loadImg(fileInput, n, id) {
    if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#img' + n + '-' + id).attr('src', e.target.result);
        }
        reader.readAsDataURL(fileInput.files[0]);
    }
}

for (var i = 0; i < arr.length; i++) {
    $(document).ready(function() {
        $('#text_review' + arr[i]).click(function() {
            this.classList.toggle('textarea-expanded');
        });
    });
}
</script>