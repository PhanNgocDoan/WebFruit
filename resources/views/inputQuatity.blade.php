<script>
var arr = <?php echo($jsonArray); ?>;
var soluongcon = <?php echo($jsonArray2); ?>;
for (let i = 0; i < arr.length; i++) {
    $('#qty' + arr[i]).on('change keypress', function() {
        var newqty = $(this).val();
        if (newqty == '' && !$(this).is(':focus')) {
            $(this).val(1);
            newqty = 1;
        } else if (newqty <= 0 && !$(this).is(':focus')) {
            $(this).val(1);
            newqty = 1;
        } else if (soluongcon[i] < newqty && !$(this).is(':focus')) {
            $(this).val(soluongcon[i]);
            newqty = soluongcon[i];
            var mess =
                '<div class="alert alert-warning">' +
                '<i class="fa">&#xf071;</i> Số lượng hàng còn lại không đủ.' +
                '<button  type="button" class="close" data-dismiss="alert">x</button></div>';
            $('.session-message').html(mess);
            setTimeout(() => {
                document.getElementsByClassName('alert')[0].remove();
            }, 3000);
        }
        var data = {
            'SoLuong': newqty,
        };
        $.ajax({
            type: 'get',
            dataType: 'html',
            url: 'update' + arr[i],
            data: data,
            success: function() {
                $('.tongcong').load(location.href + ' .tongcong2');
            }
        });
    });
}
</script>