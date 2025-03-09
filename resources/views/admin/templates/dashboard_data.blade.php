<div class="bottom">
    <div class="bao-bieudo">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var type = '{{$type}}';
    var myChart = new Chart(ctx, {
        type: type,
        data: {
            labels: [
                <?php
                    for ($i = 1; $i <= 12; $i++) {
                        echo ($i . ',');
                    }
                    ?>
            ],
            datasets: [{
                label: 'My Cool Chart',
                data: [<?php
                            for ($i = 1; $i <= count($mangdoanhthu); $i++) {
                                echo ($mangdoanhthu[$i] . ',');
                            }
                            ?>],
            }]
        }
    });
    </script>
</div>