<?php
    require_once('control/definitions.php');
    require_once('control/persian_date/PCalendar.Class.php');
    require_once("control/DigitalClock.php");
    require_once('view/templates/headers.php');
    require_once('view/templates/menu.php');
?>
<link rel="stylesheet" href="scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
<link rel="stylesheet" href="styles/device/device.css" type="text/css"/>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.js"></script>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.bundle.js"></script>
<div id="content" class="main_container">
    <div class="left_panel">
        <div id="device-image" class="panel_div">
            <img src="images/device/manager.png" class="device_picture_icon">
        </div>
        <div id="device-status" class="panel_div">
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
            <div id="device-serial-number" class="device_info"></div>
        </div>
        <div id="device-last-picture" class="panel_div">
            <img src="images/device/no_image.png" class="device_picture_icon">
        </div>
        <div id="device-tem-hum" class="panel_div">
            <div style="float: left;" id="gaugeContainer"></div>
            <div style=" float: left;" id="linearGauge"></div>
        </div>
        <div id="device-map" class="panel_div">
            <div id="device-map"></div>
            <script>
                var map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById('device-map'), {
                        center: {lat: -34.397, lng: 150.644},
                        zoom: 8
                    });
                }
            </script>
        </div>
    </div>
    <div class="right_panel">
        <script>
            var randomScalingFactor = function () {
                return Math.round(Math.random() * 250);
                //return 0;
            };
            var randomColorFactor = function () {
                return Math.round(Math.random() * 255);
            };
            var randomColor = function (opacity) {
                return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
            };
        </script>
        <div id="sensor-relay" class="panel_div">
            <div id="relay-switch" class="board_box">
                <?php
                    for($i = 0; $i < 8; $i++)
                    {
                        ?>
                        <div class="board_box">
                            <?php
                                for($j = 0; $j < 4; $j++)
                                {
                                    $relayIndex = (($j * 8) + ($i + 1));
                                    ?>
                                    <label for="relay-<?php echo $relayIndex ?>" id="relay-lbl-<?php echo $relayIndex ?>">Relay <?php echo $relayIndex ?>: </label>
                                    <div class="onoffswitch">
                                        <input type="checkbox" name="relay-<?php echo $relayIndex ?>" class="onoffswitch-checkbox" id="relay-<?php echo $relayIndex ?>" disabled checked>
                                        <label class="onoffswitch-label" for="relay-<?php echo $relayIndex ?>">
                                            <span class="onoffswitch-inner"></span>
                                            <span class="onoffswitch-switch"></span>
                                        </label>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div>
                <div class="relay_show_hide" id="relay-show-hide"><span id="relay-edit" class="relay_edit">Edit</span></div>
                <script>
                    $(document).ready(function () {
                        $("#relay-show-hide").click(function () {
                            if ($("#relay-edit").text() == 'Edit') {
                                $("#relay-edit").text('Submit');
                                $('#relay-switch input:checkbox').each(function (index) {
                                    $(this).prop('disabled', false);
                                });
                            }
                            else {
                                $("#relay-edit").text('Edit');
                                $('#relay-switch input:checkbox').each(function (index) {
                                    $(this).prop('disabled', true);
                                });
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <?php
            $dataSet      = "";
            $dataLabels   = range(1, 20);
            $acvIndex     = 0;
            $dataSetColor = "";
            for($i = 0; $i < 4; $i++)
            {
                $dataSet = "";
                ?>
                <div id="sensor-acv" class="panel_div">
                    <div class="board_box">
                        <div class="board_box">
                            <?php
                                for($j = 0; $j < 8; $j++)
                                {
                                    $acvIndex     = (($i * 8) + ($j + 1));
                                    $dataSetColor = "rgba(" . ChartDataSetColor[$acvIndex - 1]["red"] . "," .
                                                    ChartDataSetColor[$acvIndex - 1]["green"] . "," .
                                                    ChartDataSetColor[$acvIndex - 1]["blue"] . ",0.5)";
                                    ?>
                                    <label for="acv-<?php echo $acvIndex ?>" id="acv-lbl-<?php echo $acvIndex ?>">ACV <?php echo $acvIndex ?>: </label>
                                    <div class="show_hide" style="background-color: <?php echo $dataSetColor ?>" id="acv_show_hide_<?php echo $acvIndex ?>"><span
                                                id="acv-plusminus-<?php echo $acvIndex ?>" class="plusminus">+</span></div>
                                    <div class="device_digital" id="acv-<?php echo $acvIndex ?>">
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number dots">
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $("#acv_show_hide_<?php echo $acvIndex ?>").click(function () {
                                                if ($("#acv-plusminus-<?php echo $acvIndex ?>").text() == '-') {
                                                    $("#acv-plusminus-<?php echo $acvIndex ?>").text('+');
                                                    $.each(acvChart.data.datasets, function (i, dataset) {
                                                        if (dataset.label == "acv-<?php echo $acvIndex ?>") {
                                                            dataset.hidden = false;
                                                        }
                                                    });
                                                }
                                                else {
                                                    $("#acv-plusminus-<?php echo $acvIndex ?>").text('-');
                                                    $.each(acvChart.data.datasets, function (i, dataset) {
                                                        if (dataset.label == "acv-<?php echo $acvIndex ?>") {
                                                            dataset.hidden = true;
                                                        }
                                                    });
                                                }
                                                window.myLine.update();
                                            });
                                        });
                                    </script>
                                    <?php
                                    $dataSet .= "{label: \"acv-" . $acvIndex . "\",
                                    borderWidth:0,
                                    borderColor: '" . $dataSetColor . "',
                                    backgroundColor: '" . $dataSetColor . "',
                                    pointBorderColor: '" . $dataSetColor . "',
                                    pointBackgroundColor: '" . $dataSetColor . "',
                                    pointBorderWidth: 1,
                                    data: [
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor(),
                                            randomScalingFactor()],
                                    fill: false,
                                    borderDash: [],
                                    },";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="chart_box">
                        <canvas id="acvChart-<?php echo $i ?>" width="600px" height="400px"></canvas>
                        <script>
                            var ctx = document.getElementById("acvChart-<?php echo $i?>");
                            var acvChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: [<?php echo implode(",", $dataLabels)?>],
                                    datasets: [<?php echo $dataSet?>]
                                },
                                options: {
                                    legend: {
                                        display: false,
                                        labels: {
                                            fontColor: 'rgb(255, 99, 132)'
                                        }
                                    },
                                    responsive: true,
                                    title: {
                                        display: true,
                                        text: 'AC Voltage'
                                    },
                                    tooltips: {
                                        mode: 'label',
                                        callbacks: {
                                            // beforeTitle: function() {
                                            //     return '...beforeTitle';
                                            // },
                                            // afterTitle: function() {
                                            //     return '...afterTitle';
                                            // },
                                            // beforeBody: function() {
                                            //     return '...beforeBody';
                                            // },
                                            // afterBody: function() {
                                            //     return '...afterBody';
                                            // },
                                            // beforeFooter: function() {
                                            //     return '...beforeFooter';
                                            // },
                                            // footer: function() {
                                            //     return 'Footer';
                                            // },
                                            // afterFooter: function() {
                                            //     return '...afterFooter';
                                            // },
                                        }
                                    },
                                    hover: {
                                        mode: 'dataset'
                                    },
                                    scales: {
                                        xAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                show: true,
                                                labelString: 'Date Time'
                                            }
                                        }],
                                        yAxes: [{
                                            display: true,
                                            scaleLabel: {
                                                show: true,
                                                labelString: 'ACV Value'
                                            },
                                            ticks: {
                                                suggestedMin: 0,
                                                suggestedMax: 250,
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
                <?php
            }
        ?>
        <div id="sensor-aca" class="panel_div">
            <div class="board_box">
                <?php
                    for($i = 0; $i < 4; $i++)
                    {
                        ?>
                        <div class="board_box">
                            <?php
                                for($j = 0; $j < 8; $j++)
                                {
                                    $acaIndex = (($i * 8) + ($j + 1));
                                    ?>
                                    <label for="aca-<?php echo $acaIndex ?>" id="aca-lbl-<?php echo $acaIndex ?>">ACA <?php echo $acaIndex ?>: </label>
                                    <div class="device_digital" id="aca-<?php echo $acaIndex ?>">
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number dots">
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                        <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                            <div class="section top"></div>
                                            <div class="section top-right"></div>
                                            <div class="section top-left"></div>
                                            <div class="middle"></div>
                                            <div class="section bottom-right"></div>
                                            <div class="section bottom-left"></div>
                                            <div class="section bottom"></div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="chart_box">
                <canvas id="acaChart" width="600px" height="400px"></canvas>
                <script>
                    var ctx = document.getElementById("acaChart");
                    var acaChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <!--<div id="sensor-dcv" class="panel_div">
        </div>
        <div id="sensor-dca" class="panel_div">
        </div>-->
        <div id="sensor-cosq" class="panel_div">
            <div class="board_box">
                <?php
                    for($j = 0; $j < 3; $j++)
                    {
                        $cosqIndex = $j + 1;
                        ?>
                        <label for="cosq-<?php echo $cosqIndex ?>" id="cosq-lbl-<?php echo $cosqIndex ?>">Cosq <?php echo $cosqIndex ?>: </label>
                        <div class="device_digital" id="cosq-<?php echo $cosqIndex ?>">
                            <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                <div class="section top"></div>
                                <div class="section top-right"></div>
                                <div class="section top-left"></div>
                                <div class="middle"></div>
                                <div class="section bottom-right"></div>
                                <div class="section bottom-left"></div>
                                <div class="section bottom"></div>
                            </div>
                            <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                <div class="section top"></div>
                                <div class="section top-right"></div>
                                <div class="section top-left"></div>
                                <div class="middle"></div>
                                <div class="section bottom-right"></div>
                                <div class="section bottom-left"></div>
                                <div class="section bottom"></div>
                            </div>
                            <div class="number dots">
                            </div>
                            <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                <div class="section top"></div>
                                <div class="section top-right"></div>
                                <div class="section top-left"></div>
                                <div class="middle"></div>
                                <div class="section bottom-right"></div>
                                <div class="section bottom-left"></div>
                                <div class="section bottom"></div>
                            </div>
                            <div class="number <?php echo $NumbersName[array_rand($NumbersName)] ?>">
                                <div class="section top"></div>
                                <div class="section top-right"></div>
                                <div class="section top-left"></div>
                                <div class="middle"></div>
                                <div class="section bottom-right"></div>
                                <div class="section bottom-left"></div>
                                <div class="section bottom"></div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <div class="chart_box">
                <canvas id="cosqChart" width="600px" height="200px"></canvas>
                <script>
                    var ctx = document.getElementById("cosqChart");
                    var cosqChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <div id="sensor-digital-in" class="panel_div">
            <?php
                for($i = 0; $i < 8; $i++)
                {
                    ?>
                    <div class="board_box">
                        <?php
                            for($j = 0; $j < 4; $j++)
                            {
                                $digitalIndex = (($j * 8) + ($i + 1));
                                ?>
                                <label for="digital-<?php echo $digitalIndex ?>" id="digital-lbl-<?php echo $digitalIndex ?>">Digital <?php echo $digitalIndex ?>: </label>
                                <div class="onoffswitch">
                                    <input type="checkbox" name="digital-<?php echo $digitalIndex ?>" class="onoffswitch-checkbox" id="digital-<?php echo $digitalIndex ?>" checked>
                                    <label class="onoffswitch-label" for="digital-<?php echo $digitalIndex ?>">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>
<?php
    require_once('view/templates/footer.php');
    echo '<script src = "scripts/getdevicestatus.js" type="text/javascript"></script>';
?>


