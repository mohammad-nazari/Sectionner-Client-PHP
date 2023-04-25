<?php

/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 09/06/2016
 * Time: 12:31 PM
 */
class TempLoader
{
    var $editSettings = "";

    /**
     * TempLoader constructor.
     */
    public function __construct()
    {
    }

    public function CreateDigitalNumber($sensorValue, $Prefix, $index, $numberIndex, $numberColorStyle)
    {
        ?>
        <!--suppress ALL -->
        <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>" class="number <?php echo NumbersName[$sensorValue[$numberIndex - 1]] ?>">
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-top" class="section top top-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-top-right" class="section top-right top-right-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-top-left" class="section top-left top-left-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-middle" class="middle middle-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-bottom-right" class="section bottom-right bottom-right-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-bottom-left" class="section bottom-left bottom-left-<?php echo $numberColorStyle ?>"></div>
            <div id="<?php echo $Prefix ?>-<?php echo $index ?>-<?php echo $numberIndex; ?>-bottom" class="section bottom bottom-<?php echo $numberColorStyle ?>"></div>
        </div>
        <?php
    }

    /**
     * @param      $sensors
     * @param      $SensorType
     * @param      $ChartName
     * @param      $Label
     * @param      $LabelList
     * @param      $Prefix
     * @param      $Rows
     * @param      $Cols
     * @param      $Minimum
     * @param      $Minimum1
     * @param      $Minimum2
     * @param      $Maximum
     * @param      $Maximum1
     * @param      $Maximum2
     * @param      $LocalTime
     * @param int  $LeadingZeros
     * @param int  $Precision
     * @param bool $ShowDigits
     * @param bool $ShowLegend
     * @param bool $LoadTable
     */
    public function LoadChartBox($sensors, $SensorType, $ChartName, $Label, $LabelList, $Prefix, $Rows, $Cols, $Minimum, $Minimum1, $Minimum2, $Maximum, $Maximum1, $Maximum2, $LocalTime,
                                 $LeadingZeros = 4, $Precision = 2,
                                 $ShowDigits = TRUE, $ShowLegend = FALSE,
                                 $LoadTable = FALSE)
    {
        $sensorsCount = 0;
        if(is_array($sensors))
        {
            $sensorsCount = count($sensors);
        }

        $numberColorStyle = "gray";
        $fuseColorStyle   = "gray";

        $sensorValue = 0;

        $dataSet    = "";
        $dataLabels = "'" . $LocalTime . "',";

        $index        = 0;
        $dataSetColor = "";
        $sensorLabel  = "";
        $tableTitles  = "{title: \"Date\"},";
        $tableDataSet = "";
        for($i = 0; $i < $Cols; $i++)
        {
            $dataSet = "";
            ?>
            <div class="panel_div">
                <fieldset>
                    <legend><?php echo _("دستگاه " . $Label) ?></legend>
                    <div class="board_box">
                        <div class="board_box">
                            <?php
                            $tableTitles = "{title: \"Date\"},";
                            for($j = 0; $j < $Rows; $j++)
                            {
                                $index            = (($i * $Rows) + ($j + 1));
                                $dataSetColor     = "rgba(" . ChartDataSetColor[$j]["red"] . "," .
                                    ChartDataSetColor[$j]["green"] . "," .
                                    ChartDataSetColor[$j]["blue"] . ",0.5)";
                                $numberColorStyle = "gray";
                                $sensorValue      = 0;

                                $sensorLabel = $LabelList[$index - 1];
                                if($sensorsCount >= $index)
                                {
                                    $numberColorStyle = "green";
                                    if($sensors[$index - 1] < $Minimum)
                                    {
                                        $sensors[$index - 1] = 0;
                                        $numberColorStyle    = "gray";
                                    }
                                    else
                                    {
                                        if($SensorType == \webservice\SensorName::ACVOLTAGE)
                                        {
                                            if($sensors[$index - 1] < $Minimum1)
                                            {
                                                $sensors[$index - 1] = 0;
                                            }
                                            if($sensors[$index - 1] > $Maximum1)
                                            {
                                                $sensors[$index - 1] = $Maximum1;
                                            }
                                        }
                                        else if($SensorType == \webservice\SensorName::ACAMPERE)
                                        {
                                            $highAmpere = ($index - 1 < 3) ? $Maximum1 : $Maximum2;
                                            if($sensors[$index - 1] > $highAmpere)
                                            {
                                                $numberColorStyle = "red";
                                            }
                                        }
                                    }
                                    $sensorValue = ToolsClass::printFloatWithLeadingZeros($sensors[$index - 1], $LeadingZeros, $Precision);
                                }
                                if($ShowDigits == TRUE)
                                {
                                    ?>
                                    <label for="<?php echo $Prefix ?>-<?php echo $index ?>"><?php echo $sensorLabel ?>: </label>
                                    <div id="<?php echo $Prefix ?>_show_hide_<?php echo $index ?>" class="show_hide" style="background-color: <?php echo $dataSetColor ?>">
                                        <span
                                                id="<?php echo $Prefix ?>-plusminus-<?php echo $index ?>" class="plusminus">+</span></div>
                                <?php $numberIndex = 1; ?>
                                    <div class="device_digital">
                                        <?php
                                        for($k = 0; $k < $LeadingZeros; $k++)
                                        {
                                            $this->CreateDigitalNumber($sensorValue, $Prefix, $index, $numberIndex, $numberColorStyle);
                                            $numberIndex++;
                                        }
                                        ?>
                                        <div id="<?php echo $Prefix ?>-<?php echo $index ?>-dot" class="number dots dots-<?php echo $numberColorStyle ?>"></div>
                                        <?php
                                        for($k = 0; $k < $Precision; $k++)
                                        {
                                            $numberIndex++;
                                            $this->CreateDigitalNumber($sensorValue, $Prefix, $index, $numberIndex, $numberColorStyle);
                                        }
                                        ?>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            $("#<?php echo $Prefix ?>_show_hide_<?php echo $index ?>").click(function () {
                                                if ($("#<?php echo $Prefix ?>-plusminus-<?php echo $index ?>").text() == '-') {
                                                    $("#<?php echo $Prefix ?>-plusminus-<?php echo $index ?>").text('+');
                                                    $.each(sensorChart['<?php echo $Prefix ?><?php echo $i ?>'].data.datasets, function (i, dataset) {
                                                        if (dataset.label == "<?php echo $sensorLabel ?>") {
                                                            dataset.hidden = false;
                                                        }
                                                    });
                                                }
                                                else {
                                                    $("#<?php echo $Prefix ?>-plusminus-<?php echo $index ?>").text('-');
                                                    $.each(sensorChart['<?php echo $Prefix ?><?php echo $i ?>'].data.datasets, function (i, dataset) {
                                                        if (dataset.label == "<?php echo $sensorLabel ?>") {
                                                            dataset.hidden = true;
                                                        }
                                                    });
                                                }
                                                sensorChart['<?php echo $Prefix ?><?php echo $i ?>'].update();
                                            });
                                        });
                                    </script>
                                    <?php
                                }

                                $tableTitles  .= "{ title: \"" . $sensorLabel . "\" },";
                                $tableDataSet .= " \"" . round($sensors[$index - 1], 2) . "\" ,";

                                $dataSet .= "{label: \"" . $sensorLabel . "\",
                                    borderWidth:0,
                                    borderColor: '" . $dataSetColor . "',
                                    backgroundColor: '" . $dataSetColor . "',
                                    pointBorderColor: '" . $dataSetColor . "',
                                    pointBackgroundColor: '" . $dataSetColor . "',
                                    pointBorderWidth: 1,
                                    data: [" . round($sensors[$index - 1], 2) . "],
                                    fill: false,
                                    borderDash: [],
                                    },";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="chart_box">
                        <canvas id="<?php echo $Prefix ?>Chart-<?php echo $i ?>" width="850px" height="400px"></canvas>
                        <script>
                            var ctx = document.getElementById("<?php echo $Prefix ?>Chart-<?php echo $i?>");
                            sensorChartConfig['<?php echo $Prefix ?><?php echo $i ?>'] = {
                                type: 'line',
                                data: {
                                    labels: [<?php echo $dataLabels?>],
                                    datasets: [<?php echo $dataSet?>]
                                },
                                options: {
                                    legend: {
                                        display: <?php echo $ShowLegend == TRUE ? "true" : "false"?>,
                                        labels: {
                                            fontColor: 'rgb(255, 99, 132)'
                                        }
                                    },
                                    responsive: true,
                                    title: {
                                        display: true,
                                        text: '<?php echo $ChartName?> Graph'
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
                                                labelString: 'Sensors Value'
                                            },
                                            ticks: {
                                                suggestedMin: <?php echo $Minimum ?>,
                                                suggestedMax: <?php echo $Maximum ?>
                                            }
                                        }]
                                    }
                                }
                            };
                            sensorChart['<?php echo $Prefix ?><?php echo $i ?>'] = new Chart(ctx, sensorChartConfig['<?php echo $Prefix ?><?php echo $i ?>']);
                        </script>
                    </div>
                </fieldset>
                <?php
                if($LoadTable == TRUE)
                {
                    ?>
                    <div id="table-<?php echo $Prefix ?>Table-<?php echo $i ?>" class="table_box">
                        <table id="<?php echo $Prefix ?>Table-<?php echo $i ?>" class="display" width="100%"></table>
                        <script>
                            $(document).ready(function () {
                                sensorTable['<?php echo $Prefix ?><?php echo $i ?>'] = $('#<?php echo $Prefix ?>Table-<?php echo $i ?>').DataTable({
                                    columns: [<?php echo $tableTitles?>]
                                });
                            });
                        </script>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }

    /**
     * @param      $sensors
     * @param      $Label
     * @param      $TextList
     * @param      $Prefix
     * @param      $Rows
     * @param      $Cols
     * @param bool $IsEditable
     */
    public function LoadSwitchBox($sensors, $Model, $Label, $Labels, $TextList, $Prefix, $Rows, $Cols, $DeviceModel, $IsEditable = FALSE)
    {
        //            $sensors      = array(DefaultObjectsClass::NewSensor());$sensorsCount = 0;
        $sensorsCount = 0;
        if(is_array($sensors))
        {
            $sensorsCount = count($sensors);
        }

        $numberColorStyle = "-gray";
        $sensorValue      = 0;
        $sensorLabel      = "";
        ?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("دستگاه " . $Label) ?></legend>
                <div id="<?php echo $Prefix ?>-switch" class="board_box">
                    <?php
                    for($i = 0; $i < $Cols; $i++)
                    {
                        ?>
                        <div class="board_box">
                            <?php
                            for($j = 0; $j < $Rows; $j++)
                            {
                                $index = (($j * $Cols) + ($i + 1));

                                $numberColorStyle = "-gray";
                                $sensorValue      = "";
                                $sensorLabel      = $Labels[$index - 1];
                                if($sensorsCount >= $index)
                                {
                                    $sensorValue = $sensors[$index - 1] > 0 ? "checked" : "";
                                    //if($DeviceModel == webservice\DeviceModel::SECTIONNER)
                                    {
                                        $numberColorStyle = "-" . $TextList[$index - 1];
                                    }
                                }
                                ?>
                                <label for="<?php echo $Prefix ?>-<?php echo $index ?>"><?php echo $sensorLabel ?>: </label>
                                <div id="onoffswitch-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch<?php echo $numberColorStyle ?>">
                                    <input type="checkbox" name="<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-checkbox<?php echo $numberColorStyle ?>"
                                           id="<?php echo $Prefix ?>-<?php echo $index ?>"
                                           disabled
                                        <?php echo $sensorValue ?>>
                                    <label id="onoffswitch-label-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-label<?php echo $numberColorStyle ?>"
                                           for="<?php echo $Prefix ?>-<?php echo $index ?>">
                                        <span id="onoffswitch-inner-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-inner<?php echo $numberColorStyle ?>"></span>
                                        <span id="onoffswitch-switch-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-switch<?php echo $numberColorStyle ?>"></span>
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
                <?php
                if($IsEditable == TRUE)
                {
                    ?>
                    <div class="<?php echo $Prefix ?>_show_hide" id="<?php echo $Prefix ?>-show-hide"><span id="<?php echo $Prefix ?>-edit" class="btn">ویرایش</span></div>
                    <div class="<?php echo $Prefix ?>_cancel" id="<?php echo $Prefix ?>-cancel"><span id="<?php echo $Prefix ?>-cancel" class="btn">لغو</span></div>
                    <script>
                        $("#<?php echo $Prefix ?>-cancel").hide();
                        $(document).ready(function () {
                            for (indexRelay = 1; indexRelay <  <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                switchValue[indexRelay - 1] = $("#relay-" + indexRelay).prop('checked');
                            }
                            $("#<?php echo $Prefix ?>-edit").click(function (e) {
                                if ($("#<?php echo $Prefix ?>-edit").text() == 'ویرایش') {
                                    editRelays = true;
                                    $("#<?php echo $Prefix ?>-edit").text('ثبت');
                                    for (indexRelay = 1; indexRelay <  <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                        $("#relay-" + indexRelay).prop('disabled', false);
                                        switchValue[indexRelay - 1] = $("#relay-" + indexRelay).prop('checked');
                                    }
                                    $("#<?php echo $Prefix ?>-cancel").show();
                                }
                                else {
                                    $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                    for (indexRelay = 1; indexRelay <  <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                        $("#relay-" + indexRelay).prop('disabled', true);
                                    }

                                    // Show loading icon
                                    ShowLoadingImage("popup-loading", e);

                                    /* Do action */
                                    // Get relays value list
                                    const switchValueNew = [];
                                    for (indexRelay = 1; indexRelay <  <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                        switchValueNew[indexRelay - 1] = $("#relay-" + indexRelay).prop('checked');
                                    }

                                    // Send to server
                                    $.ajax({
                                        type: 'GET',
                                        url: 'requests.php',
                                        dataType: 'json',
                                        data: {
                                            'req': 'relay',
                                            'ID': $("#device-serial-number").text(),
                                            'relays': switchValueNew,
                                            'sms';0,
                                            'tcp':tcpType
                                        },
                                        //Device
                                        success: function (result) {
                                            if (ShowMessage(result, "دستور با موفقیت انجام شد.") == true) {
                                                switchValue = switchValueNew;
                                            }
                                            for (indexRelay = 1; indexRelay < <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                                $("#relay-" + indexRelay).prop('disabled', true);
                                                $("#relay-" + indexRelay).prop('checked', switchValue[indexRelay - 1]);
                                            }

                                            // Finish loading icon
                                            HideLoadingImage("popup-loading", e);

                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                            editRelays = false;
                                        },
                                        error: function () {
                                            // Finish loading icon
                                            HideLoadingImage("popup-loading", e);

                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                            editRelays = false;
                                            ShowAlert("خطا در ثبت دستور رله،", "هیچ پیامی از سمت سرور و دستگاه دریافت نشد.");
                                        },
                                        timeout: 45000
                                    });

                                }
                            });
                            $("#<?php echo $Prefix ?>-cancel").click(function () {
                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                for (indexRelay = 1; indexRelay <  <?php  echo ($Rows * $Cols) + 1?>; indexRelay++) {
                                    $("#relay-" + indexRelay).prop('disabled', true);
                                    $("#relay-" + indexRelay).prop('checked', switchValue[indexRelay - 1]);
                                }
                                $("#<?php echo $Prefix ?>-cancel").hide();
                                editRelays = false;
                            });
                        });
                    </script>
                    <?php
                }
                ?>
            </fieldset>
        </div>
        <?php
    }

    /**
     * @param      $sensors
     * @param      $Model
     * @param      $Label
     * @param      $Labels
     * @param      $TextList
     * @param      $Prefix
     * @param      $Rows
     * @param      $Cols
     * @param      $DeviceModel
     * @param bool $IsEditable
     */
    public function LoadRelay($sensors, $Model, $Label, $Labels, $TextList, $Prefix, $Rows, $Cols, $DeviceModel, $IsEditable = FALSE)
    {
        //            $sensors      = array(DefaultObjectsClass::NewSensor());$sensorsCount = 0;
        $sensorsCount = 0;
        if(is_array($sensors))
        {
            $sensorsCount = count($sensors);
        }

        $numberColorStyle = "-gray";
        $sensorValue      = 0;
        $sensorLabel      = "";
        ?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("دستگاه " . $Label) ?></legend>
                <div id="<?php echo $Prefix ?>-switch" class="board_box">
                    <?php
                    for($i = 0; $i < $Cols; $i++)
                    {
                        ?>
                        <div class="board_box">
                            <?php
                            for($j = 0; $j < $Rows; $j++)
                            {
                                $index = (($j * $Cols) + ($i + 1));

                                $numberColorStyle = "-gray";
                                $sensorValue      = "";
                                $sensorLabel      = $Labels[$index - 1];
                                if($sensorsCount >= $index)
                                {
                                    $sensorValue = $sensors[$index - 1] > 0 ? "checked" : "";
                                    //if($DeviceModel == webservice\DeviceModel::SECTIONNER)
                                    {
                                        $numberColorStyle = "-" . $TextList[$index - 1];
                                    }
                                }
                                ?>
                                <label for="<?php echo $Prefix ?>-<?php echo $index ?>"><?php echo $sensorLabel ?>: </label>
                                <div id="onoffswitch-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch<?php echo $numberColorStyle ?>">
                                    <input type="checkbox" name="<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-checkbox<?php echo $numberColorStyle ?>"
                                           id="<?php echo $Prefix ?>-<?php echo $index ?>"
                                           disabled
                                        <?php echo $sensorValue ?>>
                                    <label id="onoffswitch-label-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-label<?php echo $numberColorStyle ?>"
                                           for="<?php echo $Prefix ?>-<?php echo $index ?>">
                                        <span id="onoffswitch-inner-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-inner<?php echo $numberColorStyle ?>"></span>
                                        <span id="onoffswitch-switch-<?php echo $Prefix ?>-<?php echo $index ?>" class="onoffswitch-switch<?php echo $numberColorStyle ?>"></span>
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
                <div style="float: right;text-align: center;direction: rtl;">
                    <br><br><br><span style="font-weight: bold; font-size: 24px;color: red;" class="blink">در بهره برداری از شبکه ی توزیع، همه چیز فدای خاموشی و خاموشی فدای ایمنی. <br><br><br>در صورت نیاز به انجام تعمیرات روی شبکه قبل از ارت شبکه، حتما سکسیونر را قفل نمائید.<br></span>
                </div>
                <?php
                if($IsEditable == TRUE)
                {
                    ?>
                    <div class="<?php echo $Prefix ?>_show_hide" id="<?php echo $Prefix ?>-show-hide"><span id="<?php echo $Prefix ?>-edit" class="btn">ویرایش</span></div>
                    <div class="<?php echo $Prefix ?>_cancel" id="<?php echo $Prefix ?>-cancel"><span id="<?php echo $Prefix ?>-cancel" class="btn">لغو</span></div>
                    <script>
                        $("#<?php echo $Prefix ?>-cancel").hide();
                        $(document).ready(function () {
                            $("#<?php echo $Prefix ?>-edit").click(function (e) {

                                var oldClass = "";
                                var doCommand = true;
                                var openEnable = false;
                                var closeEnable = false;
                                var openStyle = "gray";
                                var closeStyle = "gray";
                                var alertText = "";
                                var WarningTextBlink = '<br><br><br><span style="font-weight: bold; font-size: 24px;color: red;" class="blink">در بهره برداری از شبکه ی توزیع، همه چیز فدای خاموشی و خاموشی فدای ایمنی. <br><br><br>در صورت نیاز به انجام تعمیرات روی شبکه قبل از ارت شبکه، حتما سکسیونر را قفل نمائید.<br></span>';

                                if ($("#<?php echo $Prefix ?>-edit").text() == 'ویرایش') {
                                    editRelays = true;
                                    doCommand = true;
                                    // Sectionner is not connect
                                    if (sectionnerState == 1) {
                                        doCommand = false;
                                        openEnable = true;
                                        closeEnable = true;
                                        openStyle = "gray";
                                        closeStyle = "gray";

                                        alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                    }
                                    else {
                                        if (gasOK != 100) {
                                            alertText += "<br>گاز سکسیونر خالی است.";
                                        }
                                        if (lockState != 0) {
                                            alertText += "<br>سکسیونر قفل می باشد.";
                                        }
                                        if (sectionnerState == 0) {
                                            // Sectionner is close now
                                            if (gasOK == 100 && lockState == 0) {
                                                doCommand = true;
                                                openEnable = false;
                                                openStyle = "open";
                                            }
                                            else {
                                                doCommand = false;
                                                openEnable = true;
                                                openStyle = "gray";
                                            }
                                            closeEnable = true;
                                            closeStyle = "gray";
                                        }
                                        else {
                                            // Sectionner is open now
                                            openEnable = true;
                                            openStyle = "gray";
                                            if (gasOK == 100 && lockState == 0) {
                                                doCommand = true;
                                                closeEnable = false;
                                                closeStyle = "close";
                                            }
                                            else {
                                                doCommand = false;
                                                closeEnable = true;
                                                closeStyle = "gray";
                                            }
                                        }
                                    }
                                    if (doCommand == true) {
                                        $("#<?php echo $Prefix ?>-edit").text('ثبت');
                                        $("#<?php echo $Prefix ?>-cancel").show();

                                        $("#relay-1").prop('disabled', openEnable);
                                        $("#relay-2").prop('disabled', closeEnable);
                                        SetRelayStyle("relay-1", "-" + openStyle);
                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                    }
                                    else {
                                        openEnable = true;
                                        closeEnable = true;
                                        $("#relay-1").prop('disabled', openEnable);
                                        $("#relay-2").prop('disabled', closeEnable);
                                        $("#relay-1").prop('checked', false);
                                        $("#relay-2").prop('checked', false);
                                        openStyle = "gray";
                                        closeStyle = "gray";
                                        SetRelayStyle("relay-1", "-" + openStyle);
                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                        editRelays = false;

                                        ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);
                                    }
                                }
                                else {
                                    doCommand = true;
                                    alertText = "";
                                    if (sectionnerState == 1) {
                                        doCommand = false;
                                    }
                                    else {
                                        if (sectionnerState == 0) {
                                            // Sectionner is close now
                                            doCommand = (gasOK == 100 && lockState == 0 && $("#relay-1").prop('checked') == true);
                                            openEnable = false;
                                            closeEnable = true;

                                            alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                        }
                                        else {
                                            if (gasOK != 100) {
                                                alertText += "<br>گاز سکسیونر خالی است.";
                                            }
                                            if (lockState != 0) {
                                                alertText += "<br>سکسیونر قفل می باشد.";
                                            }
                                            // Sectionner is open now
                                            doCommand = (gasOK == 100 && lockState == 0 && $("#relay-2").prop('checked') == true);
                                            openEnable = true;
                                            closeEnable = false;
                                        }
                                    }
                                    if (doCommand == true) {
                                        // Try to close
                                        $.confirm({
                                            title: 'اخطار',
                                            content: 'نحوه ارسال دستور را انتخاب کنید:' + WarningTextBlink,
                                            confirmButton: 'از طریق شبکه',
                                            cancelButton: 'از طریق پیامک',
                                            rtl: true,
                                            confirm: function () {
                                                if (closeEnable == true) {
                                                    // Try to close
                                                    $.confirm({
                                                        title: 'اخطار',
                                                        content: 'آیااز قطع کردن سکسیونر اطمینان دارید؟' + WarningTextBlink,
                                                        confirmButton: 'بله',
                                                        cancelButton: 'خیر',
                                                        rtl: true,
                                                        confirm: function () {
                                                            doCommand = true;
                                                            alertText = "";
                                                            if (sectionnerState == 1) {
                                                                doCommand = false;
                                                            }
                                                            else {
                                                                if (sectionnerState == 0) {
                                                                    // Sectionner is close now
                                                                    doCommand = (gasOK == 100 && lockState == 0 && $("#relay-1").prop('checked') == true);
                                                                    openEnable = false;
                                                                    closeEnable = true;

                                                                    alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                                                }
                                                                else {
                                                                    if (gasOK != 100) {
                                                                        alertText += "<br>گاز سکسیونر خالی است.";
                                                                    }
                                                                    if (lockState != 0) {
                                                                        alertText += "<br>سکسیونر قفل می باشد.";
                                                                    }
                                                                    // Sectionner is open now
                                                                    doCommand = (gasOK == 100 && lockState == 0 && $("#relay-2").prop('checked') == true);
                                                                    openEnable = true;
                                                                    closeEnable = false;
                                                                }
                                                            }
                                                            if (doCommand == true) {
                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');

                                                                // Show loading icon
                                                                ShowLoadingImage("popup-loading", e);

                                                                /* Do action */
                                                                // Get relays value list
                                                                const switchValueNew = [$("#relay-1").prop('checked'), $("#relay-2").prop('checked')];
                                                                // Send to server
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: 'requests.php',
                                                                    dataType: 'json',
                                                                    data: {
                                                                        'req': 'relay',
                                                                        'ID': $("#device-serial-number").text(),
                                                                        'relays': switchValueNew,
                                                                        'sms': 0,
                                                                        'tcp':tcpType
                                                                    },
                                                                    //Device
                                                                    success: function (result) {
                                                                        if (ShowMessage(result, "دستور با موفقیت از طریق شبکه انجام شد. لطفا منتظر نتیجه باشید.") == true) {
                                                                            $.ajax({
                                                                                type: 'GET',
                                                                                url: 'requests.php',
                                                                                dataType: 'json',
                                                                                data: {
                                                                                    'req': 'device',
                                                                                    'ID': $.urlParam('ID')
                                                                                },
                                                                                success: function (result) {
                                                                                    UpdateDevice(result);
                                                                                    // Finish loading icon
                                                                                    HideLoadingImage("popup-loading", e);
                                                                                    $("#device-errors").text("نرمال");
                                                                                },
                                                                                error: function () {
                                                                                    // Finish loading icon
                                                                                    HideLoadingImage("popup-loading", e);
                                                                                    $("#device-errors").text("خطا در دریافت وضعیت دستگاه");
                                                                                },
                                                                                timeout: 10000
                                                                            });
                                                                        }
                                                                        else {
                                                                            // Finish loading icon
                                                                            HideLoadingImage("popup-loading", e);
                                                                        }
                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                        editRelays = false;

                                                                        openEnable = true;
                                                                        closeEnable = true;
                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                        $("#relay-1").prop('checked', false);
                                                                        $("#relay-2").prop('checked', false);
                                                                        openStyle = "gray";
                                                                        closeStyle = "gray";
                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    },
                                                                    error: function () {
                                                                        // Finish loading icon
                                                                        HideLoadingImage("popup-loading", e);

                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                        editRelays = false;
                                                                        //ShowAlert("خطا در ثبت دستور", "هیچ  پیامی از سمت سرور و دستگاه دریافت نشد. ");
                                                                        ShowAlert("دستور با موفقیت از طریق شبکه انجام شد. لطفا منتظر نتیجه باشید.");
                                                                        openEnable = true;
                                                                        closeEnable = true;
                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                        $("#relay-1").prop('checked', false);
                                                                        $("#relay-2").prop('checked', false);
                                                                        openStyle = "gray";
                                                                        closeStyle = "gray";
                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    },
                                                                    timeout: 5000
                                                                });
                                                            }
                                                            else {
                                                                ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);

                                                                $("#<?php echo $Prefix ?>-cancel").hide();
                                                                editRelays = false;

                                                                openEnable = true;
                                                                closeEnable = true;
                                                                $("#relay-1").prop('disabled', openEnable);
                                                                $("#relay-2").prop('disabled', closeEnable);
                                                                $("#relay-1").prop('checked', false);
                                                                $("#relay-2").prop('checked', false);
                                                                openStyle = "gray";
                                                                closeStyle = "gray";
                                                                SetRelayStyle("relay-1", "-" + openStyle);
                                                                SetRelayStyle("relay-2", "-" + closeStyle);
                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                            }
                                                        },
                                                        cancel: function () {
                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                            editRelays = false;

                                                            openEnable = true;
                                                            closeEnable = true;
                                                            $("#relay-1").prop('disabled', openEnable);
                                                            $("#relay-2").prop('disabled', closeEnable);
                                                            $("#relay-1").prop('checked', false);
                                                            $("#relay-2").prop('checked', false);
                                                            openStyle = "gray";
                                                            closeStyle = "gray";
                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                        }
                                                    });
                                                }
                                                else if (openEnable === true) {
                                                    // Try to open
                                                    $.confirm({
                                                        title: 'اخطار',
                                                        content: 'آیااز پایین آمدن گروه های کاری از روی شبکه اطمینان دارید؟' + WarningTextBlink,
                                                        confirmButton: 'بله',
                                                        cancelButton: 'خیر',
                                                        rtl: true,
                                                        confirm: function () {

                                                            // Try to close
                                                            $.confirm({
                                                                title: 'اخطار',
                                                                content: 'آیااز از جمع آوری سیستم های ارت از روی شبکه اطمینان دارید؟' + WarningTextBlink,
                                                                confirmButton: 'بله',
                                                                cancelButton: 'خیر',
                                                                rtl: true,
                                                                confirm: function () {

                                                                    // Try to close
                                                                    $.confirm({
                                                                        title: 'اخطار',
                                                                        content: 'آیااز وصل کردن سکسیونر اطمینان دارید؟' + WarningTextBlink,
                                                                        confirmButton: 'بله',
                                                                        cancelButton: 'خیر',
                                                                        rtl: true,
                                                                        confirm: function () {
                                                                            doCommand = true;
                                                                            alertText = "";
                                                                            if (sectionnerState === 1) {
                                                                                doCommand = false;

                                                                                alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                                                            }
                                                                            else {
                                                                                if (gasOK !== 100) {
                                                                                    alertText += "<br>گاز سکسیونر خالی است.";
                                                                                }
                                                                                if (lockState !== 0) {
                                                                                    alertText += "<br>سکسیونر قفل می باشد.";
                                                                                }
                                                                                if (sectionnerState === 0) {
                                                                                    // Sectionner is close now
                                                                                    doCommand = (gasOK == 100 && lockState === 0 && $("#relay-1").prop('checked') == true);
                                                                                    openEnable = false;
                                                                                    closeEnable = true;
                                                                                }
                                                                                else {
                                                                                    // Sectionner is open now
                                                                                    doCommand = (gasOK === 100 && lockState === 0 && $("#relay-2").prop('checked') == true);
                                                                                    openEnable = true;
                                                                                    closeEnable = false;
                                                                                }
                                                                            }
                                                                            if (doCommand === true) {
                                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');

                                                                                // Show loading icon
                                                                                ShowLoadingImage("popup-loading", e);

                                                                                /* Do action */
                                                                                // Get relays value list
                                                                                const switchValueNew = [$("#relay-1").prop('checked'), $("#relay-2").prop('checked')];
                                                                                // Send to server
                                                                                $.ajax({
                                                                                    type: 'GET',
                                                                                    url: 'requests.php',
                                                                                    dataType: 'json',
                                                                                    data: {
                                                                                        'req': 'relay',
                                                                                        'ID': $("#device-serial-number").text(),
                                                                                        'relays': switchValueNew,
                                                                                        'sms': 0,
                                                                                        'tcp':tcpType
                                                                                    },
                                                                                    //Device
                                                                                    success: function (result) {
                                                                                        if (ShowMessage(result, "دستور با موفقیت از طریق شبکه انجام شد. لطفا منتظر نتیجه باشید.") == true) {
                                                                                            $.ajax({
                                                                                                type: 'GET',
                                                                                                url: 'requests.php',
                                                                                                dataType: 'json',
                                                                                                data: {
                                                                                                    'req': 'device',
                                                                                                    'ID': $.urlParam('ID')
                                                                                                },
                                                                                                success: function (result) {
                                                                                                    UpdateDevice(result);
                                                                                                    // Finish loading icon
                                                                                                    HideLoadingImage("popup-loading", e);
                                                                                                    $("#device-errors").text("نرمال");
                                                                                                },
                                                                                                error: function () {
                                                                                                    // Finish loading icon
                                                                                                    HideLoadingImage("popup-loading", e);
                                                                                                    $("#device-errors").text("خطا در دریافت وضعیت دستگاه");
                                                                                                },
                                                                                                timeout: 10000
                                                                                            });
                                                                                        }
                                                                                        else {
                                                                                            // Finish loading icon
                                                                                            HideLoadingImage("popup-loading", e);
                                                                                        }
                                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                        editRelays = false;

                                                                                        openEnable = true;
                                                                                        closeEnable = true;
                                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                                        $("#relay-1").prop('checked', false);
                                                                                        $("#relay-2").prop('checked', false);
                                                                                        openStyle = "gray";
                                                                                        closeStyle = "gray";
                                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                    },
                                                                                    error: function () {
                                                                                        // Finish loading icon
                                                                                        HideLoadingImage("popup-loading", e);

                                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                        editRelays = false;
                                                                                        //ShowAlert("خطا در ثبت دستور", " هیچ پیامی از سمت سرور و دستگاه دریافت نشد. ");
                                                                                        ShowAlert("دستور با موفقیت از طریق شبکه انجام شد. لطفا منتظر نتیجه باشید.");
                                                                                        openEnable = true;
                                                                                        closeEnable = true;
                                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                                        $("#relay-1").prop('checked', false);
                                                                                        $("#relay-2").prop('checked', false);
                                                                                        openStyle = "gray";
                                                                                        closeStyle = "gray";
                                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                    },
                                                                                    timeout: 5000
                                                                                });
                                                                            }
                                                                            else {
                                                                                ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);

                                                                                $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                editRelays = false;

                                                                                openEnable = true;
                                                                                closeEnable = true;
                                                                                $("#relay-1").prop('disabled', openEnable);
                                                                                $("#relay-2").prop('disabled', closeEnable);
                                                                                $("#relay-1").prop('checked', false);
                                                                                $("#relay-2").prop('checked', false);
                                                                                openStyle = "gray";
                                                                                closeStyle = "gray";
                                                                                SetRelayStyle("relay-1", "-" + openStyle);
                                                                                SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                            }
                                                                        },
                                                                        cancel: function () {
                                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                                            editRelays = false;

                                                                            openEnable = true;
                                                                            closeEnable = true;
                                                                            $("#relay-1").prop('disabled', openEnable);
                                                                            $("#relay-2").prop('disabled', closeEnable);
                                                                            $("#relay-1").prop('checked', false);
                                                                            $("#relay-2").prop('checked', false);
                                                                            openStyle = "gray";
                                                                            closeStyle = "gray";
                                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                        }
                                                                    });
                                                                },
                                                                cancel: function () {
                                                                    $("#<?php echo $Prefix ?>-cancel").hide();
                                                                    editRelays = false;

                                                                    openEnable = true;
                                                                    closeEnable = true;
                                                                    $("#relay-1").prop('disabled', openEnable);
                                                                    $("#relay-2").prop('disabled', closeEnable);
                                                                    $("#relay-1").prop('checked', false);
                                                                    $("#relay-2").prop('checked', false);
                                                                    openStyle = "gray";
                                                                    closeStyle = "gray";
                                                                    SetRelayStyle("relay-1", "-" + openStyle);
                                                                    SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                }
                                                            });
                                                        },
                                                        cancel: function () {
                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                            editRelays = false;

                                                            openEnable = true;
                                                            closeEnable = true;
                                                            $("#relay-1").prop('disabled', openEnable);
                                                            $("#relay-2").prop('disabled', closeEnable);
                                                            $("#relay-1").prop('checked', false);
                                                            $("#relay-2").prop('checked', false);
                                                            openStyle = "gray";
                                                            closeStyle = "gray";
                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                        }
                                                    });
                                                }
                                            },
                                            cancel: function () {
                                                if (closeEnable == true) {
                                                    // Try to close
                                                    $.confirm({
                                                        title: 'اخطار',
                                                        content: 'آیااز قطع کردن سکسیونر اطمینان دارید؟' + WarningTextBlink,
                                                        confirmButton: 'بله',
                                                        cancelButton: 'خیر',
                                                        rtl: true,
                                                        confirm: function () {
                                                            doCommand = true;
                                                            alertText = "";
                                                            if (sectionnerState == 1) {
                                                                doCommand = false;
                                                            }
                                                            else {
                                                                if (sectionnerState == 0) {
                                                                    // Sectionner is close now
                                                                    doCommand = (gasOK == 100 && lockState == 0 && $("#relay-1").prop('checked') == true);
                                                                    openEnable = false;
                                                                    closeEnable = true;

                                                                    alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                                                }
                                                                else {
                                                                    if (gasOK != 100) {
                                                                        alertText += "<br>گاز سکسیونر خالی است.";
                                                                    }
                                                                    if (lockState != 0) {
                                                                        alertText += "<br>سکسیونر قفل می باشد.";
                                                                    }
                                                                    // Sectionner is open now
                                                                    doCommand = (gasOK == 100 && lockState == 0 && $("#relay-2").prop('checked') == true);
                                                                    openEnable = true;
                                                                    closeEnable = false;
                                                                }
                                                            }
                                                            if (doCommand == true) {
                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');

                                                                // Show loading icon
                                                                ShowLoadingImage("popup-loading", e);

                                                                /* Do action */
                                                                // Get relays value list
                                                                const switchValueNew = [$("#relay-1").prop('checked'), $("#relay-2").prop('checked')];
                                                                // Send to server
                                                                $.ajax({
                                                                    type: 'GET',
                                                                    url: 'requests.php',
                                                                    dataType: 'json',
                                                                    data: {
                                                                        'req': 'relay',
                                                                        'ID': $("#device-serial-number").text(),
                                                                        'relays': switchValueNew,
                                                                        'sms': 1,
                                                                        'tcp':tcpType
                                                                    },
                                                                    //Device
                                                                    success: function (result) {
                                                                        if (ShowMessage(result, "دستور با موفقیت انجام شد، لطفا تا دریافت نتیجه از طریق پیامک صبر کنید.") == true) {
                                                                            $.ajax({
                                                                                type: 'GET',
                                                                                url: 'requests.php',
                                                                                dataType: 'json',
                                                                                data: {
                                                                                    'req': 'device',
                                                                                    'ID': $.urlParam('ID')
                                                                                },
                                                                                success: function (result) {
                                                                                    UpdateDevice(result);
                                                                                    // Finish loading icon
                                                                                    HideLoadingImage("popup-loading", e);
                                                                                    $("#device-errors").text("نرمال");
                                                                                },
                                                                                error: function () {
                                                                                    // Finish loading icon
                                                                                    HideLoadingImage("popup-loading", e);
                                                                                    $("#device-errors").text("خطا در دریافت وضعیت دستگاه");
                                                                                },
                                                                                timeout: 10000
                                                                            });
                                                                        }
                                                                        else {
                                                                            // Finish loading icon
                                                                            HideLoadingImage("popup-loading", e);
                                                                        }
                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                        editRelays = false;

                                                                        openEnable = true;
                                                                        closeEnable = true;
                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                        $("#relay-1").prop('checked', false);
                                                                        $("#relay-2").prop('checked', false);
                                                                        openStyle = "gray";
                                                                        closeStyle = "gray";
                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    },
                                                                    error: function () {
                                                                        // Finish loading icon
                                                                        HideLoadingImage("popup-loading", e);

                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                        editRelays = false;
                                                                        ShowAlert("خطا در ثبت دستور", "هیچ  پیامی از سمت سرور و دستگاه دریافت نشد. ");

                                                                        openEnable = true;
                                                                        closeEnable = true;
                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                        $("#relay-1").prop('checked', false);
                                                                        $("#relay-2").prop('checked', false);
                                                                        openStyle = "gray";
                                                                        closeStyle = "gray";
                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    },
                                                                    timeout: 5000
                                                                });
                                                            }
                                                            else {
                                                                ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);

                                                                $("#<?php echo $Prefix ?>-cancel").hide();
                                                                editRelays = false;

                                                                openEnable = true;
                                                                closeEnable = true;
                                                                $("#relay-1").prop('disabled', openEnable);
                                                                $("#relay-2").prop('disabled', closeEnable);
                                                                $("#relay-1").prop('checked', false);
                                                                $("#relay-2").prop('checked', false);
                                                                openStyle = "gray";
                                                                closeStyle = "gray";
                                                                SetRelayStyle("relay-1", "-" + openStyle);
                                                                SetRelayStyle("relay-2", "-" + closeStyle);
                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                            }
                                                        },
                                                        cancel: function () {
                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                            editRelays = false;

                                                            openEnable = true;
                                                            closeEnable = true;
                                                            $("#relay-1").prop('disabled', openEnable);
                                                            $("#relay-2").prop('disabled', closeEnable);
                                                            $("#relay-1").prop('checked', false);
                                                            $("#relay-2").prop('checked', false);
                                                            openStyle = "gray";
                                                            closeStyle = "gray";
                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                        }
                                                    });
                                                }
                                                else if (openEnable === true) {
                                                    // Try to open
                                                    $.confirm({
                                                        title: 'اخطار',
                                                        content: 'آیااز پایین آمدن گروه های کاری از روی شبکه اطمینان دارید؟' + WarningTextBlink,
                                                        confirmButton: 'بله',
                                                        cancelButton: 'خیر',
                                                        rtl: true,
                                                        confirm: function () {

                                                            // Try to close
                                                            $.confirm({
                                                                title: 'اخطار',
                                                                content: 'آیااز از جمع آوری سیستم های ارت از روی شبکه اطمینان دارید؟' + WarningTextBlink,
                                                                confirmButton: 'بله',
                                                                cancelButton: 'خیر',
                                                                rtl: true,
                                                                confirm: function () {

                                                                    // Try to close
                                                                    $.confirm({
                                                                        title: 'اخطار',
                                                                        content: 'آیااز وصل کردن سکسیونر اطمینان دارید؟' + WarningTextBlink,
                                                                        confirmButton: 'بله',
                                                                        cancelButton: 'خیر',
                                                                        rtl: true,
                                                                        confirm: function () {
                                                                            doCommand = true;
                                                                            alertText = "";
                                                                            if (sectionnerState === 1) {
                                                                                doCommand = false;

                                                                                alertText += "وضعیت قطع یا وصل بودن سکسیونر نامشخص است.<br>";
                                                                            }
                                                                            else {
                                                                                if (gasOK !== 100) {
                                                                                    alertText += "<br>گاز سکسیونر خالی است.";
                                                                                }
                                                                                if (lockState !== 0) {
                                                                                    alertText += "<br>سکسیونر قفل می باشد.";
                                                                                }
                                                                                if (sectionnerState === 0) {
                                                                                    // Sectionner is close now
                                                                                    doCommand = (gasOK == 100 && lockState === 0 && $("#relay-1").prop('checked') == true);
                                                                                    openEnable = false;
                                                                                    closeEnable = true;
                                                                                }
                                                                                else {
                                                                                    // Sectionner is open now
                                                                                    doCommand = (gasOK === 100 && lockState === 0 && $("#relay-2").prop('checked') == true);
                                                                                    openEnable = true;
                                                                                    closeEnable = false;
                                                                                }
                                                                            }
                                                                            if (doCommand === true) {
                                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');

                                                                                // Show loading icon
                                                                                ShowLoadingImage("popup-loading", e);

                                                                                /* Do action */
                                                                                // Get relays value list
                                                                                const switchValueNew = [$("#relay-1").prop('checked'), $("#relay-2").prop('checked')];
                                                                                // Send to server
                                                                                $.ajax({
                                                                                    type: 'GET',
                                                                                    url: 'requests.php',
                                                                                    dataType: 'json',
                                                                                    data: {
                                                                                        'req': 'relay',
                                                                                        'ID': $("#device-serial-number").text(),
                                                                                        'relays': switchValueNew,
                                                                                        'sms': 1,
                                                                                        'tcp':tcpType
                                                                                    },
                                                                                    //Device
                                                                                    success: function (result) {
                                                                                        if (ShowMessage(result, "دستور با موفقیت انجام شد، لطفا تا دریافت نتیجه از طریق پیامک صبر کنید.") == true) {
                                                                                            $.ajax({
                                                                                                type: 'GET',
                                                                                                url: 'requests.php',
                                                                                                dataType: 'json',
                                                                                                data: {
                                                                                                    'req': 'device',
                                                                                                    'ID': $.urlParam('ID')
                                                                                                },
                                                                                                success: function (result) {
                                                                                                    UpdateDevice(result);
                                                                                                    // Finish loading icon
                                                                                                    HideLoadingImage("popup-loading", e);
                                                                                                    $("#device-errors").text("نرمال");
                                                                                                },
                                                                                                error: function () {
                                                                                                    // Finish loading icon
                                                                                                    HideLoadingImage("popup-loading", e);
                                                                                                    $("#device-errors").text("خطا در دریافت وضعیت دستگاه");
                                                                                                },
                                                                                                timeout: 10000
                                                                                            });
                                                                                        }
                                                                                        else {
                                                                                            // Finish loading icon
                                                                                            HideLoadingImage("popup-loading", e);
                                                                                        }
                                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                        editRelays = false;

                                                                                        openEnable = true;
                                                                                        closeEnable = true;
                                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                                        $("#relay-1").prop('checked', false);
                                                                                        $("#relay-2").prop('checked', false);
                                                                                        openStyle = "gray";
                                                                                        closeStyle = "gray";
                                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                    },
                                                                                    error: function () {
                                                                                        // Finish loading icon
                                                                                        HideLoadingImage("popup-loading", e);

                                                                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                        editRelays = false;
                                                                                        ShowAlert("خطا در ثبت دستور", " هیچ پیامی از سمت سرور و دستگاه دریافت نشد. ");

                                                                                        openEnable = true;
                                                                                        closeEnable = true;
                                                                                        $("#relay-1").prop('disabled', openEnable);
                                                                                        $("#relay-2").prop('disabled', closeEnable);
                                                                                        $("#relay-1").prop('checked', false);
                                                                                        $("#relay-2").prop('checked', false);
                                                                                        openStyle = "gray";
                                                                                        closeStyle = "gray";
                                                                                        SetRelayStyle("relay-1", "-" + openStyle);
                                                                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                    },
                                                                                    timeout: 5000
                                                                                });
                                                                            }
                                                                            else {
                                                                                ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);

                                                                                $("#<?php echo $Prefix ?>-cancel").hide();
                                                                                editRelays = false;

                                                                                openEnable = true;
                                                                                closeEnable = true;
                                                                                $("#relay-1").prop('disabled', openEnable);
                                                                                $("#relay-2").prop('disabled', closeEnable);
                                                                                $("#relay-1").prop('checked', false);
                                                                                $("#relay-2").prop('checked', false);
                                                                                openStyle = "gray";
                                                                                closeStyle = "gray";
                                                                                SetRelayStyle("relay-1", "-" + openStyle);
                                                                                SetRelayStyle("relay-2", "-" + closeStyle);
                                                                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                            }
                                                                        },
                                                                        cancel: function () {
                                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                                            editRelays = false;

                                                                            openEnable = true;
                                                                            closeEnable = true;
                                                                            $("#relay-1").prop('disabled', openEnable);
                                                                            $("#relay-2").prop('disabled', closeEnable);
                                                                            $("#relay-1").prop('checked', false);
                                                                            $("#relay-2").prop('checked', false);
                                                                            openStyle = "gray";
                                                                            closeStyle = "gray";
                                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                        }
                                                                    });
                                                                },
                                                                cancel: function () {
                                                                    $("#<?php echo $Prefix ?>-cancel").hide();
                                                                    editRelays = false;

                                                                    openEnable = true;
                                                                    closeEnable = true;
                                                                    $("#relay-1").prop('disabled', openEnable);
                                                                    $("#relay-2").prop('disabled', closeEnable);
                                                                    $("#relay-1").prop('checked', false);
                                                                    $("#relay-2").prop('checked', false);
                                                                    openStyle = "gray";
                                                                    closeStyle = "gray";
                                                                    SetRelayStyle("relay-1", "-" + openStyle);
                                                                    SetRelayStyle("relay-2", "-" + closeStyle);
                                                                    $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                                }
                                                            });
                                                        },
                                                        cancel: function () {
                                                            $("#<?php echo $Prefix ?>-cancel").hide();
                                                            editRelays = false;

                                                            openEnable = true;
                                                            closeEnable = true;
                                                            $("#relay-1").prop('disabled', openEnable);
                                                            $("#relay-2").prop('disabled', closeEnable);
                                                            $("#relay-1").prop('checked', false);
                                                            $("#relay-2").prop('checked', false);
                                                            openStyle = "gray";
                                                            closeStyle = "gray";
                                                            SetRelayStyle("relay-1", "-" + openStyle);
                                                            SetRelayStyle("relay-2", "-" + closeStyle);
                                                            $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                                        }
                                                    });
                                                }
                                            }
                                        });
                                    }
                                    else {
                                        ShowAlert("عدم امکان فعال کردن تنظیمات", "سکسیونر در وضعیت مناسب جهت ارسال دستور نیست: <br>" + alertText);

                                        $("#<?php echo $Prefix ?>-cancel").hide();
                                        editRelays = false;

                                        openEnable = true;
                                        closeEnable = true;
                                        $("#relay-1").prop('disabled', openEnable);
                                        $("#relay-2").prop('disabled', closeEnable);
                                        $("#relay-1").prop('checked', false);
                                        $("#relay-2").prop('checked', false);
                                        openStyle = "gray";
                                        closeStyle = "gray";
                                        SetRelayStyle("relay-1", "-" + openStyle);
                                        SetRelayStyle("relay-2", "-" + closeStyle);
                                        $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                    }
                                }
                            });
                            $("#<?php echo $Prefix ?>-cancel").click(function () {
                                $("#<?php echo $Prefix ?>-edit").text('ویرایش');
                                $("#<?php echo $Prefix ?>-cancel").hide();
                                editRelays = false;

                                openEnable = true;
                                closeEnable = true;
                                $("#relay-1").prop('disabled', openEnable);
                                $("#relay-2").prop('disabled', closeEnable);
                                $("#relay-1").prop('checked', false);
                                $("#relay-2").prop('checked', false);
                                openStyle = "gray";
                                closeStyle = "gray";
                                SetRelayStyle("relay-1", "-" + openStyle);
                                SetRelayStyle("relay-2", "-" + closeStyle);
                            });
                        });
                    </script>
                    <?php
                }
                ?>
            </fieldset>
        </div>
        <?php
    }

    /**
     * @param      $sensors
     * @param      $Label
     * @param      $TextList
     * @param      $Prefix
     * @param      $Rows
     * @param      $Cols
     * @param bool $IsEditable
     */
    public function LoadDigitalState($sensors, $Model, $Label, $TextList, $Prefix, $Rows, $Cols, $DeviceModel, $IsEditable = FALSE)
    {
        //            $sensors      = array(DefaultObjectsClass::NewSensor());$sensorsCount = 0;
        $sensorsCount = 0;
        if(is_array($sensors))
        {
            $sensorsCount = count($sensors);
        }

        $numberColorStyle = "-gray";
        $sensorValue      = 0;
        $sensorLabel      = "";
        ?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("دستگاه ") . $Label ?></legend>
                <div id="<?php echo $Prefix ?>-switch01" class="board_box" style="float: right">
                    <?php
                    $sensorValue = 1; // Un normal
                    if($sensorsCount > 0)
                    {
                        if($sensors[0] == 1)
                        {
                            // Sectionner is open now
                            $sensorValue = 2;
                        }
                        if($sensorsCount > 1)
                        {
                            if($sensors[1] == $sensors[0])
                            {
                                // Sectionner is in error now
                                $sensorValue = 1;
                            }
                            else if($sensors[1] > $sensors[0])
                            {
                                // Sectionner is close now
                                $sensorValue = 0;
                            }
                        }
                    }
                    ?>
                    <div style="float: right">
                        <div id="device-<?php echo $Prefix ?>-01"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                const digits = {
                                    0: 'وصل',
                                    1: 'خطا',
                                    2: 'قطع'
                                };
                                sectionnerState = <?php echo $sensorValue?>;
                                digitalInputGauge['device-<?php echo $Prefix?>-01'] = $('#device-<?php echo $Prefix?>-01').jqxGauge({
                                    value: sectionnerState,
                                    width: 200,
                                    height: 200,
                                    min: 0,
                                    max: 2,
                                    ranges: [{startValue: 0, endValue: 1, style: {fill: 'red', stroke: '#4bb648'}, endWidth: 10, startWidth: 10},
                                        {startValue: 1, endValue: 2, style: {fill: 'green', stroke: '#fbd109'}, endWidth: 10, startWidth: 10}],
                                    ticksMajor: {interval: 1, size: '20%'},
                                    labels: {
                                        distance: '50%',
                                        interval: 1,
                                        formatValue: function (val) {
                                            return digits[val];

                                        }
                                    },
                                    colorScheme: 'scheme05',
                                    caption: {
                                        value: 'وضعیت سکسیونر',
                                        position: 'bottom',
                                        offset: [0, 10],
                                        visible: true
                                    },
                                    pointer: {length: '80%', width: '5%'},
                                    animationDuration: 150
                                });
                            });
                        </script>
                    </div>
                    <?php
                    $sensorValue = 0; // Un normal
                    if($sensorsCount > 2)
                    {
                        if($sensors[2] == 1)
                        {
                            $sensorValue = 0;
                        }
                        else
                        {
                            $sensorValue = 100;
                        }
                    }
                    ?>
                    <div style="float: right">
                        <div id="device-<?php echo $Prefix ?>-02"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                const digits = {
                                    0: 'خالی',
                                    100: 'پر'
                                };
                                gasOK = <?php echo $sensorValue?>;
                                digitalInputGauge['device-<?php echo $Prefix ?>-02'] = $('#device-<?php echo $Prefix ?>-02').jqxGauge({
                                    value: gasOK,
                                    width: 200,
                                    height: 200,
                                    min: 0,
                                    max: 100,
                                    ranges: [
                                        {startValue: 0, endValue: 25, style: {fill: 'red', stroke: '#4bb648'}, endWidth: 5, startWidth: 1},
                                        {startValue: 25, endValue: 50, style: {fill: 'orange', stroke: '#fbd109'}, endWidth: 7, startWidth: 5},
                                        {startValue: 50, endValue: 75, style: {fill: 'yellow', stroke: '#fbd109'}, endWidth: 9, startWidth: 7},
                                        {startValue: 75, endValue: 100, style: {fill: 'green', stroke: '#fbd109'}, endWidth: 13, startWidth: 9}
                                    ],
                                    ticksMajor: {interval: 20, size: '10%'},
                                    ticksMinor: {interval: 10, size: '5%'},
                                    labels: {
                                        distance: '40%',
                                        interval: 10,
                                        formatValue: function (val) {
                                            if (val == 0 || val == 100) {
                                                return digits[val];
                                            }
                                            return val;
                                        }
                                    },
                                    colorScheme: 'scheme05',
                                    caption: {
                                        value: 'گاز سکسیونر',
                                        position: 'bottom',
                                        offset: [0, 10],
                                        visible: true
                                    },
                                    pointer: {length: '80%', width: '5%'},
                                    animationDuration: 150
                                });
                            });
                        </script>
                    </div>
                    <?php
                    $sensorValue = 1; // Un normal
                    if($sensorsCount > 3)
                    {
                        if($sensors[3] == 1)
                        {
                            $sensorValue = 2;
                        }
                        else
                        {
                            $sensorValue = 0;
                        }
                    }
                    ?>
                    <div style="float: right">
                        <div id="device-<?php echo $Prefix ?>-03"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                const digits = {
                                    0: 'باز',
                                    1: 'خطا',
                                    2: 'قفل'
                                };
                                lockState = <?php echo $sensorValue?>;
                                digitalInputGauge['device-<?php echo $Prefix ?>-03'] = $('#device-<?php echo $Prefix?>-03').jqxGauge({
                                    value: lockState,
                                    width: 200,
                                    height: 200,
                                    min: 0,
                                    max: 2,
                                    ranges: [{startValue: 0, endValue: 1, style: {fill: 'red', stroke: '#4bb648'}, endWidth: 10, startWidth: 10},
                                        {startValue: 1, endValue: 2, style: {fill: 'green', stroke: '#fbd109'}, endWidth: 10, startWidth: 10}],
                                    ticksMajor: {interval: 1, size: '20%'},
                                    labels: {
                                        distance: '50%',
                                        interval: 1,
                                        formatValue: function (val) {
                                            return digits[val];
                                        }
                                    },
                                    colorScheme: 'scheme05',
                                    caption: {
                                        value: 'وضعیت قفل',
                                        position: 'bottom',
                                        offset: [0, 10],
                                        visible: true
                                    },
                                    pointer: {length: '80%', width: '5%'},
                                    animationDuration: 150
                                });
                            });
                        </script>
                    </div>
                    <?php
                    $sensorValue = 1; // Un normal
                    if($sensorsCount > 4)
                    {
                        if($sensors[4] == 1)
                        {
                            $sensorValue = 0;
                        }
                        else
                        {
                            $sensorValue = 2;
                        }
                    }
                    ?>
                    <div style="float: right">
                        <div id="device-<?php echo $Prefix ?>-04"></div>
                        <script type="text/javascript">
                            $(document).ready(function () {
                                const digits = {
                                    0: 'باز',
                                    1: 'خطا',
                                    2: 'بسته'
                                };
                                door1State = <?php echo $sensorValue?>;
                                digitalInputGauge['device-<?php echo $Prefix ?>-04'] = $('#device-<?php echo $Prefix?>-04').jqxGauge({
                                    value: door1State,
                                    width: 200,
                                    height: 200,
                                    min: 0,
                                    max: 2,
                                    ranges: [{startValue: 0, endValue: 1, style: {fill: 'yellow', stroke: '#4bb648'}, endWidth: 10, startWidth: 10},
                                        {startValue: 1, endValue: 2, style: {fill: 'green', stroke: '#fbd109'}, endWidth: 10, startWidth: 10}],
                                    ticksMajor: {interval: 1, size: '20%'},
                                    labels: {
                                        distance: '50%',
                                        interval: 1,
                                        formatValue: function (val) {
                                            return digits[val];
                                        }
                                    },
                                    colorScheme: 'scheme05',
                                    caption: {
                                        value: 'وضعیت درها',
                                        position: 'bottom',
                                        offset: [0, 10],
                                        visible: true
                                    },
                                    pointer: {length: '80%', width: '5%'},
                                    animationDuration: 150
                                });
                            });
                        </script>
                    </div>
                    <?php
                    $sensorValue = 1; // Un normal
                    if($sensorsCount > 5)
                    {
                        if($sensors[5] == 1)
                        {
                            $sensorValue = 0;
                        }
                        else
                        {
                            $sensorValue = 2;
                        }
                    }

                    ?>
                </div>
            </fieldset>
        </div>
        <?php
    }

    /**
     * @param string $Label
     * @param string $PictureName
     */
    public function LoadDevicePicture($Label = "device", $PictureName = "images/device/no_image.png")
    {
        if($PictureName == NULL or $PictureName == "")
        {
            $PictureName = "no_image";
        }
        if($Label == NULL or $Label == "")
        {
            $Label = "device";
        }
        ?>
        <img id="<?php echo $Label ?>-image" src="<?php echo strtolower($PictureName) ?>" class="device_picture_icon">
        <?php
    }

    /**
     *
     */
    public function LoadDeviceErrorList()
    {
        //            $device = DefaultObjectsClass::NewDevice();
        ?>
        <div class="panel_div">
            <fieldset id="device-error-box" style="height: 200px;overflow: auto;">
                <legend><?php echo _("خظا های دستگاه") ?></legend>
                <div id="device-errors-list" class="Table">
                    <!-- Device errors -->
                    <div id="device-errors-row" class="Heading">
                        <div id="error-date-time" class="Cell">
                            <?php echo _("تاریخ") . ' ' . _('زمان') . ' ' ?>
                        </div>
                        <div id="error-description" class="Cell">
                            <?php echo _("توضیح خطا") ?>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div id="device-clean" style="float: left;padding: 20px 0 0 20px;align-items: center"><span id="device-clean-errors" class="btn"><?php echo _("پاک کردن فهرست خطا") ?></span></div>
            <script>
                $(document).ready(function () {
                    $("#device-clean-errors").click(function () {
                        $("#device-errors-list").html('<div id="device-errors-row" class="Heading"><div id="error-date-time" class="Cell"><?php echo _("تاریخ") . ' ' . _('زمان') .
                            ' ' ?></div><div id="error-description" class="Cell"><?php echo _("توضیح خطا") ?></div></div>');
                        $('#device-error-box').animate({
                            scrollTop: $('#device-error-box').scrollHeight
                        }, 2000);
                    });
                });
            </script>
        </div>
        <?php
    }

    /**
     * @param $device
     *
     */
    public function LoadDeviceStatus($device)
    {
        //            $device = DefaultObjectsClass::NewDevice();
        ?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("اطلاعات دستگاه") ?></legend>
                <div class="Table">
                    <!-- Device Information -->
                    <div class="Heading">
                        <div class="Cell">
                            <?php echo _("نام ویژگی") ?>
                        </div>
                        <div class="Cell">
                            <?php echo _("مقدار") . "(" . _("وضعیت") . ")" ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('وضعیت') . ' :' ?>
                        </div>
                        <div id="device-status" class="Cell">
                            <?php echo $device->dErr->eType ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('شماره دستگاه') . ' :' ?>
                        </div>
                        <div id="device-serial-number" class="Cell">
                            <?php echo $device->dSerialNumber ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('مدل دستگاه') . ' :' ?>
                        </div>
                        <div id="device-model" class="Cell">
                            <?php echo $device->dModel ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('نام دستگاه') . ' :' ?>
                        </div>
                        <div id="device-nike-name" class="Cell">
                            <?php echo $device->dNikeName ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('زمان تاریخ دستگاه') . ' :' ?>
                        </div>
                        <div id="device-date-time" class="Cell">
                            <?php
                            $timeZoneA = date_default_timezone_get();
                            $timeZone  = new DateTimeZone($timeZoneA);
                            $datetime  = new DateTime($device->dDDateTime, $timeZone); // current time = server time
                            $offset    = $timeZone->getOffset($datetime);
                            $datetime->add(new DateInterval('PT' . $offset . 'S'));

                            $jalaliObject = new PersianCalendar();
                            list($year, $month, $day) = $jalaliObject->gregorian_to_jalali((new DateTime($device->dDDateTime, new DateTimeZone(date_default_timezone_get())))->format("Y"),
                                $datetime->format("m"),
                                $datetime->format("d"));
                            echo $year . "-" . $month . "-" . $day . $datetime->format(" H:i"); ?>
                            <script>
                                greDateTime = '<?php echo $datetime->format("Y-m-d H:i"); ?>';
                            </script>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('مکان دستگاه') . ' :' ?>
                        </div>
                        <div id="device-location" class="Cell">
                            <?php echo $device->dLocation ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('شهر دستگاه') . ' :' ?>
                        </div>
                        <div id="device-city" class="Cell">
                            <?php echo $device->dCity ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('آدرس آی پی دستگاه') . ' :' ?>
                        </div>
                        <div id="device-ip" class="Cell">
                            <?php echo $device->dIP->ip1 . "." . $device->dIP->ip2 . "."
                                . $device->dIP->ip3 . "." . $device->dIP->ip4 . ":" .
                                $device->dPort ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('زمان نمونه گیری') . ' (' . _('ثانیه') . ') :' ?>
                        </div>
                        <div id="device-sampling" class="Cell">
                            <?php echo $device->dSamplingTime ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('زمان ارسال پیامک') . ' (' . _('دقیقه') . ') :' ?>
                        </div>
                        <div id="device-sms" class="Cell">
                            <?php echo $device->dSmsTerm ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <?php
    }

    public function LoadSettingButton($device)
    {
        ?>
        <div style="float: left;padding: 0 0 0 35px;align-items: center">
            <span data-popup-open="popup-1" id="device-settings-change" class="btn"><?php echo _("تغییر تنظیمات") ?></span>
        </div>

        <div class="popup" data-popup="popup-1">
            <div class="popup-inner">
                <div class="panel_div">
                    <div class="Table">
                        <!-- Device Information -->
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('نام دستگاه') . ' :' ?>
                            </div>
                            <div class="Cell">
                                <input type="text" id="device-nike-name-text">
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('زمان تاریخ دستگاه') . ' :' ?>
                            </div>
                            <div id="device-calendar" class="Cell">
                                <input type="text" id="device-date-time-text" name="data"/>
                                <img id="device-date-time-btn" src="scripts/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;">
                                <script type="text/javascript">
                                    const dt = new Date();
                                    dt.setHours(dt.getHours() + 4);
                                    dt.setMinutes(dt.getMinutes() + 30);
                                    //                var nowDateTime = toTimeZone(new Date(), "Asia/Tehran");
                                    Calendar.setup({
                                        inputField: "device-date-time-text",   // id of the input field
                                        button: "device-date-time-btn",   // trigger for the calendar (button ID)
                                        ifFormat: "%Y/%m/%d %H:%M",       // format of the input field
                                        showsTime: true,
                                        dateType: 'jalali',
                                        showOthers: true,
                                        langNumbers: true,
                                        weekNumbers: true,
                                        date: dt,
                                        flatCallback: dateChanged,
                                        flat: "device-calendar"
                                    });

                                    function dateChanged(calendar) {
                                        //do some thing with the selected date
                                        greDateTime = calendar.date.print('%Y-%m-%d %H:%M', '');
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('مکان دستگاه') . ' :' ?>
                            </div>
                            <div class="Cell">
                                <input type="text" id="device-location-text">
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('شهر دستگاه') . ' :' ?>
                            </div>
                            <div class="Cell">
                                <input type="text" id="device-city-text">
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('زمان نمونه گیری') . ' (' . _('ثانیه') . ') :' ?>
                            </div>
                            <div class="Cell">
                                <input type="text" id="device-sampling-text">
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('زمان ارسال پیامک') . ' (' . _('دقیقه') . ') :' ?>
                            </div>
                            <div class="Cell">
                                <input type="text" id="device-sms-text">
                            </div>
                        </div>
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _('موقعیت دستگاه') . ' :' ?>
                            </div>
                            <div class="Cell">
                                <div>
                                    <label for="x-pos">X Position</label>
                                    <input type="number" id="x-pos" value="">
                                </div>
                                <div>
                                    <label for="y-pos">Y Position</label>
                                    <input type="number" id="y-pos" value="">
                                </div>
                                <div class="panel_div">
                                    <div id="device-map-edit" style="min-width:200px; min-height:200px;"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if($device != NULL and $device->dModel != NULL and $device->dModel == webservice\DeviceModel::MANAGER)
                        {
                            ?>
                            <div class="Row">
                                <div class="Cell">
                                    <?php echo /*_($device->dModel) . ' ' .*/
                                        _('توان دستگاه') . ' :' ?>
                                </div>
                                <div id="device-power" class="Cell">
                                    <input type="number" id="device-power-text">
                                </div>
                            </div>
                            <div class="Row">
                                <div class="Cell">
                                    <?php echo /*_($device->dModel) . ' ' .*/
                                        _('ظرفیت دستگاه') . ' :' ?>
                                </div>
                                <div id="device-capacity" class="Cell">
                                    <input type="number" id="device-capacity-text">
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div style="text-align: center;padding: inherit;"><span id="device-settings" class="btn"><?php echo _("ثبت") ?></span></div>
                </div>
                <p><a data-popup-close="popup-1" href="#"><?php echo _("بستن") ?></a></p>
                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                //----- OPEN
                $('[data-popup-open]').on('click', function (e) {
                    const targeted_popup_class = jQuery(this).attr('data-popup-open');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
                    e.preventDefault();

                    const position = map_device.getCenter();
                    map_device_edit.setCenter(position);
                    device_edit_marker.setPosition(position);
                    google.maps.event.trigger(map_device_edit, 'resize');
                    $("#x-pos").val(position.lat);
                    $("#y-pos").val(position.lng);

                    $("#device-nike-name-text").val($.trim($("#device-nike-name").text()));
                    $("#device-date-time-text").val($.trim($("#device-date-time").text()));
                    $("#device-location-text").val($.trim($("#device-location").text()));
                    $("#device-city-text").val($.trim($("#device-city").text()));
                    $("#device-sampling-text").val($.trim($("#device-sampling").text()));
                    $("#device-sms-text").val($.trim($("#device-sms").text()));
                    <?php
                    if($device != NULL and $device->dModel != NULL and $device->dModel == webservice\DeviceModel::MANAGER)
                    {
                    ?>
                    $("#device-power-text").val($.trim($("#device-power").text()));
                    $("#device-capacity-text").val($.trim($("#device-capacity").val()));
                    <?php
                    }
                    ?>
                });

                //----- CLOSE
                $('[data-popup-close]').on('click', function (e) {
                    const targeted_popup_class = jQuery(this).attr('data-popup-close');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
                    e.preventDefault();

                    google.maps.event.trigger(map_device_edit, 'resize');
                });

                $("#x-pos").change(function () {
                    const position = {lat: parseFloat($("#x-pos").val()), lng: parseFloat($("#y-pos").val())};
                    map_device_edit.setCenter(position);
                    device_edit_marker.setPosition(position);
                });
                $("#y-pos").change(function () {
                    const position = {lat: parseFloat($("#x-pos").val()), lng: parseFloat($("#y-pos").val())};
                    map_device_edit.setCenter(position);
                    device_edit_marker.setPosition(position);
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("#device-settings").click(function (e) {
                    // Show loading icon
                    ShowLoadingImage("popup-loading", e);

                    // Send to server
                    $.ajax({
                        type: 'GET',
                        url: 'requests.php',
                        dataType: 'json',
                        data: {
                            'req': 'settings',
                            'ID': $("#device-serial-number").text(),
                            'nike-name': $("#device-nike-name-text").val(),
                            'date-time': $.now()/*greDateTime*/,
                            'location': $("#device-location-text").val(),
                            'city': $("#device-city-text").val(),
                            'sampling': $("#device-sampling-text").val(),
                            'sms': $("#device-sms-text").val(),
                            'x-pos': $("#x-pos").val(),
                            'y-pos': $("#y-pos").val(),
                            'power': $("#device-power-text").val(),
                            'capacity': $("#device-capacity-text").val()
                        },
                        //Device
                        success: function (result) {
                            if (ShowMessage(result, "تنظیمات با موفقیت ثبت شد") == true) {
                            }
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);
                        },
                        error: function () {
                            ShowAlert("خطا در ثبت تنظیمات", "ثبت تنظیمات با خطا مواجه شد. <br>");
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);
                        }

                        ,
                        timeout: 45000
                    });
                });
            });
        </script>
        <?php
    }

    /**
     * @param $device
     *
     */
    public function LoadDeviceStatus2($device)
    {
        //                        $device = DefaultObjectsClass::NewDevice();
        ?>
        <div id="device-status2" class="panel_div">
            <fieldset>
                <legend><?php echo _("وضعیت دستگاه") ?></legend>
                <input type="hidden" id="device-capacity" value="<?php echo $device->dTableCapacity ?>">
                </input>
                <div class="Table">
                    <!-- Device Information -->
                    <div class="Heading">
                        <div class="Cell">
                            <?php echo _("نام ویژگی") ?>
                        </div>
                        <div class="Cell">
                            <?php echo _("مقدر") . "(" . _("وضعیت") . ")" ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('توان مجاز (وات)') . ' :' ?>
                        </div>
                        <div id="device-pok" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dPOK, 2) ?>
                        </div>
                    </div>
                    <div id="device-ptotal-box" class="Row" <?php echo ($device->dPOK < $device->dPTotal) ? "style= background-color:red;" : "" ?>>
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('توان اکتیو مصرفی کل (وات)') . ' :' ?>
                        </div>
                        <div id="device-ptotal" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dPTotal, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('توان نامی ترانسفورماتور (ولت آمپر)') . ' :' ?>
                        </div>
                        <div id="device-power" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dTransPower, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('PR (وات)') . ' :' ?>
                        </div>
                        <div id="device-pr" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dPR, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('PS (وات)') . ' :' ?>
                        </div>
                        <div id="device-ps" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dPS, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('PT (وات)') . ' :' ?>
                        </div>
                        <div id="device-pt" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dPT, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('توان راکتیو مصرفی (وار)') . ' :' ?>
                        </div>
                        <div id="device-reactive" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dQR + $device->dQS + $device->dQT, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('QR (وار)') . ' :' ?>
                        </div>
                        <div id="device-qr" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dQR, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('QS (وار)') . ' :' ?>
                        </div>
                        <div id="device-qs" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dQS, 2) ?>
                        </div>
                    </div>
                    <div class="Row">
                        <div class="Cell">
                            <?php echo /*_($device->dModel) . ' ' .*/
                                _('QT (وار)') . ' :' ?>
                        </div>
                        <div id="device-qt" style="font-weight: bold; font-size: 20px;" class="Cell">
                            <?php echo number_format($device->dQT, 2) ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <?php
    }

    /**
     * @param $device
     *
     */
    public function LoadFUS($device)
    {
        //            $device = DefaultObjectsClass::NewDevice();
        ?>
        <div id="device-status2" class="panel_div">
            <fieldset>
                <legend><?php echo _("وضعیت فیوزهای دستگاه") ?></legend>
                <div class="Table">
                    <?php
                    for($i = 0; $i < 8; $i++)
                    {
                        $label = "";
                        if($i != 0)
                        {
                            $label = $i;
                            if($i == 7)
                            {
                                $label = "L";
                            }
                        }
                        ?>
                        <!-- Device Information -->
                        <div class="Row">
                            <div id="fuR<?php echo $label ?>" class="Cell" style="text-align: center;background-color: lightgreen;color: blue;">
                                fuR<?php echo $label ?><img src="images/fuse/hrc-fuse.png" class="fuse">
                            </div>
                            <div id="fuS<?php echo $label ?>" class="Cell" style="text-align: center;background-color: lightgreen;color: blue;">
                                fuS<?php echo $label ?><img src="images/fuse/hrc-fuse.png" class="fuse">
                            </div>
                            <div id="fuT<?php echo $label ?>" class="Cell" style="text-align: center;background-color:  lightgreen;color: blue;">
                                fuT<?php echo $label ?><img src="images/fuse/hrc-fuse.png" class="fuse">
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </fieldset>
        </div>
        <?php
    }

    /**
     * @param $DeviceName
     * @param $CameraIP
     */
    public function LoadProgressBar($DeviceName, $CameraIP)
    {
        ?>
        <script>
            $(document).ready(function () {
                progressBar = $("#device-progressbar").jqxProgressBar({
                    value: 0,
                    width: 230,
                    height: 20,
                    min: 0,
                    max: 100,
                    showText: true,
                    theme: 'energyblue'
                });
            });
        </script>
        <div class="Table">
            <!-- Device Information -->
            <div class="Row">
                <div class="Cell">
                    <?php echo _('آی پی دوربین دستگاه') . ' :' ?>
                </div>
                <div id="device-camera-ip" class="Cell">
                    <?php echo $CameraIP ?></div>
            </div>
        </div>
        <div id="progress-status" style="float: left;padding: 20px 0 0 50px;align-items: center">
            <span id="progress-text"></span><img src="images/loading/Loading2.gif">
        </div>
        <div id='device-progressbar'></div>
        <div id="device-load" style="float: left;padding: 20px 0 0 50px;align-items: center"><span id="device-load-image" class="btn"><?php echo _("بارگذاری تصویر") ?></span></div>
        <script>
            $(document).ready(function () {
                progressStatus = $("#progress-status");
                progressText = $("#progress-text");
                progressBarDiv = $("#device-progressbar");
                getPicture = false;

                progressStatus.hide();
                //progressBarDiv.hide();

                $("#device-load-image").click(function () {
                    // Show loading icon
//                      ShowLoadingImage("popup-loading", e);

                    getPicture = true;
                    progressStatus.show();
                    progressText.text("درحال گرفتن عکس ...");
                    if ($(this).text() == 'بارگذاری تصویر') {
                        $(this).text('لغو');
                        loadImage = true;
                        /* Do action */
                        $.ajax({
                            type: 'GET',
                            url: 'requests.php',
                            dataType: 'json',
                            data: {
                                'req': 'pic',
                                'ID': $("#device-serial-number").text()
                            },
                            //Device
                            success: function (result) {
                                // Finish loading icon
                                GetDevicePictureParts(result);
                            },
                            error: function () {
                                ShowAlert("خطا در گرفتن عکس", "ارتباط با سیستم جهت دریافت عکس با مشکل مواجه است. <br>");
                                UpdateProgressStatus(0, "");
                            },
                            timeout: 45000
                        });
                    }
                    else {
                        progressStatus.hide();
                        //progressBarDiv.hide();
                        $(this).text('بارگذاری تصویر');
                        UpdateProgressStatus(0, "");
                        loadImage = false;
                    }
                });
            });
        </script>
        <?php
    }

    /**
     * @param $device
     * @param $sensors
     * @param $SensorType
     * @param $Label
     * @param $Prefix
     * @param $Rows
     * @param $Symbol
     * @param $Class
     */
    public function LoadTemHum($device, $sensors, $SensorType, $Label, $Prefix, $Rows, $Symbol, $Class)
    {
        $sensorsCount = 0;
        if(is_array($sensors))
        {
            $sensorsCount = count($sensors);
        }
        ?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo $Label . " " . _("دستگاه") ?></legend>
                <?php
                for($i = 0; $i < $Rows; $i++)
                {
                    $sensorValue = 0;
                    if($sensorsCount > $i)
                    {
                        $sensorValue = $sensors[$i];
                    }
                    ?>
                    <div id="device-<?php echo $Prefix . "-" . $i ?>" class="<?php echo $Class ?>"></div>
                    <div class="Table">
                        <!-- Device Information -->
                        <div class="Row">
                            <div class="Cell">
                                <?php echo /*_($device->dModel) . ' ' .*/
                                    _($Label) . ' :' ?>
                            </div>
                            <div id="device-<?php echo $Prefix ?>-value<?php echo $i ?>" class="Cell">
                                <?php echo $sensorValue . $Symbol ?>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            <?php
                            if($SensorType == \webservice\SensorName::HUMIDITY)
                            {
                            ?>
                            humidity['device-<?php echo $Prefix . "-" . $i?>'] = $('#device-<?php echo $Prefix . "-" . $i?>').jqxGauge({
                                value: 0,
                                width: 200,
                                height: 200,
                                min: 0,
                                max: 100,
                                ranges: [{startValue: 0, endValue: 25, style: {fill: '#4bb648', stroke: '#4bb648'}, endWidth: 5, startWidth: 1},
                                    {startValue: 25, endValue: 50, style: {fill: '#fbd109', stroke: '#fbd109'}, endWidth: 10, startWidth: 5},
                                    {startValue: 50, endValue: 75, style: {fill: '#ff8000', stroke: '#ff8000'}, endWidth: 13, startWidth: 10},
                                    {startValue: 75, endValue: 100, style: {fill: '#e02629', stroke: '#e02629'}, endWidth: 16, startWidth: 13}],
                                ticksMinor: {interval: 5, size: '5%'},
                                ticksMajor: {interval: 10, size: '9%'},
                                colorScheme: 'scheme05',
                                caption: {
                                    value: 'رطوبت',
                                    position: 'bottom',
                                    offset: [0, 10],
                                    visible: true
                                },
                                animationDuration: 150
                            });
                            humidity['device-<?php echo $Prefix . "-" . $i?>'].jqxGauge('value', <?php echo $sensorValue ?>);
                            <?php
                            }
                            else
                            {
                            ?>
                            temperatures['device-<?php echo $Prefix . "-" . $i?>'] = $('#device-<?php echo $Prefix . "-" . $i?>').jqxLinearGauge({
                                value: 0,
                                orientation: 'vertical',
                                width: 100,
                                height: 300,
                                ticksMajor: {size: '10%', interval: 10},
                                ticksMinor: {size: '5%', interval: 2.5, style: {'stroke-width': 1, stroke: '#aaaaaa'}},
                                pointer: {size: '5%'},
                                colorScheme: 'scheme05',
                                min: -50,
                                max: 150,
                                labels: {
                                    position: 'near'
                                },
                                ranges: [
                                    {startValue: -50, endValue: 0, style: {fill: '#fbd109', stroke: '#fbd109'}},
                                    {startValue: 0, endValue: 50, style: {fill: '#4bb648', stroke: '#4bb648'}},
                                    {startValue: 50, endValue: 100, style: {fill: '#ff8000', stroke: '#ff8000'}},
                                    {startValue: 100, endValue: 150, style: {fill: '#e02629', stroke: '#e02629'}}],
                                animationDuration: 150
                            });
                            temperatures['device-<?php echo $Prefix . "-" . $i?>'].jqxLinearGauge('value', <?php echo $sensorValue ?>);
                            <?php
                            }
                            ?>
                        });
                    </script>
                    <?php
                }
                ?>
            </fieldset>
        </div>
        <?php
    }

    public function LoadCalibrationTemp()
    {
        ?>
        <div style="width: 48%;float: left;margin: 5px;">
            <div class="Table">
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام ستسور") ?>
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
                        <?php echo _("ACVOLTAGE") ?>
                    </div>
                </div>
            </div>
            <div class="Table">
                <!-- Device Information -->
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام سنسور") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار آفست") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه دستگاه") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه دستگاه") ?>
                    </div>
                </div>
                <?php
                $counts = ChartRowsColumns["ACVOLTAGE"][0] * ChartRowsColumns["ACVOLTAGE"][1];
                for($i = 0; $i < $counts; $i++)
                {
                    ?>
                    <div class="Row" id="voltage-name-<?php echo $i ?>">
                        <div class="Cell" style="direction: ltr">
                            <?php echo LabelsVoltage[$i] ?>
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="voltage-offset-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="voltage-min-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="voltage-max-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="voltage-zero-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="voltage-span-<?php echo $i ?>">
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="Table">
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام سنسور") ?>
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
                        <?php echo _("COSQ") ?>
                    </div>
                </div>
            </div>
            <div class="Table">
                <!-- Device Information -->
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام سنسور") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار آفست") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه دستگاه") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه دستگاه") ?>
                    </div>
                </div>
                <?php
                $counts = ChartRowsColumns["COSQ"][0] * ChartRowsColumns["COSQ"][1];
                for($i = 0; $i < $counts; $i++)
                {
                    ?>
                    <div class="Row">
                        <div class="Cell" id="cosq-name-<?php echo $i ?>" style="direction: ltr">
                            <?php echo LabelsCosq[$i] ?>
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="cosq-offset-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="cosq-min-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="cosq-max-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="cosq-zero-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="cosq-span-<?php echo $i ?>">
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div style="width: 48%;float: left;margin: 5px;">
            <div class="Table">
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام سنسور") ?>
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
                        <?php echo _("ACAMPERE") ?>
                    </div>
                </div>
            </div>
            <div class="Table">
                <!-- Device Information -->
                <div class="Heading">
                    <div class="Cell">
                        <?php echo _("نام سنسور") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار آفست") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه واقعی") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار کمینه دستگاه") ?>
                    </div>
                    <div class="Cell">
                        <?php echo _("مقدار بیشینه دستگاه") ?>
                    </div>
                </div>
                <?php
                $counts = ChartRowsColumns["ACAMPERE"][0] * ChartRowsColumns["ACAMPERE"][1];
                for($i = 0; $i < $counts; $i++)
                {
                    ?>
                    <div class="Row">
                        <div class="Cell" id="ampere-name-<?php echo $i ?>" style="direction: ltr">
                            <?php echo LabelsAmpere[$i] ?>
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="ampere-offset-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="ampere-min-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="ampere-max-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="ampere-zero-<?php echo $i ?>">
                        </div>
                        <div class="Cell">
                            <input type="number" class="NumberClass" value="0" id="ampere-span-<?php echo $i ?>">
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}

$tempLoader = new TempLoader();