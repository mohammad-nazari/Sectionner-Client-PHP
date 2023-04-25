<?php
    /**
     * Created by PhpStorm.
     * User: Mohammad
     * Date: 26/06/2016
     * Time: 11:24 AM
     */

    require_once('control/definitions.php');
    require_once('control/DeviceClass.php');
    require_once('control/TempLoader.php');
    //    $userDeviceList = DefaultObjectsClass::NewUserDevice();
?>
<div id="content" class="main_container">
    <div style="width: 100%;display: block;margin: 10px;">
        <div style="padding:2px; float: right;">
            <label for="device-list"><?php echo _("فهرست دستگاه ها : ") ?></label>
            <select id="device-list">
                <?php
                    foreach($userDeviceList->udDevs as $userDevice)
                    {
                        if($userDevice->dSerialNumber > 0)
                        {
                            $device = new  DeviceClass();
                            $device = ToolsClass::LoadFromParentObj($userDevice, $device);
                            $device->DecodeData();
                            ?>
                            <option value="<?php echo $device->dSerialNumber ?>"><?php echo $device->dNikeName . "(" . $device->dSerialNumber . ")" ?></option>
                            <?php
                        }
                    }
                ?>
            </select>
        </div>
        <div style="padding:2px; float: right;">
            <span id="get-calibration" class="btn"><?php echo _("دریافت داده های کالیبره") ?></span>
        </div>
        <div style="padding:2px; float: right;">
            <span id="set-calibration" class="btn"><?php echo _("ثبت داده های کالیبره") ?></span>
        </div>
        <script>
            $(document).ready(function () {
                $("#get-calibration").click(function (e) {
                    ShowLoadingImage("popup-loading", e);
                    $.ajax({
                        type    : 'GET',
                        url     : 'requests.php',
                        dataType: 'json',
                        data    : {
                            'req': 'getclb',
                            'ID' : $('#device-list').find(":selected").val(),
                        },
                        //Device
                        success : function (deviceCalibration) {
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);
                            <?php
                            $counts = ChartRowsColumns["ACVOLTAGE"][0] * ChartRowsColumns["ACVOLTAGE"][1];
                            ?>
                            var listCount = 0;
                            if (deviceCalibration.clVoltage) {
                                listCount = (deviceCalibration.clVoltage).length;
                            }
                            else {
                                listCount = 0;
                            }
                            for (var i = 0; i < listCount; i++) {
                                $("#voltage-offset-" + i).val(parseFloat(deviceCalibration.clVoltage[i].cOffset));
                                $("#voltage-min-" + i).val(parseFloat(deviceCalibration.clVoltage[i].cMin));
                                $("#voltage-max-" + i).val(parseFloat(deviceCalibration.clVoltage[i].cMax));
                                $("#voltage-zero-" + i).val(parseFloat(deviceCalibration.clVoltage[i].cZero));
                                $("#voltage-span-" + i).val(parseFloat(deviceCalibration.clVoltage[i].cSpan));
                            }
                            for (; i < <?php echo $counts?>; i++) {
                                $("#voltage-offset-" + i).val(0);
                                $("#voltage-min-" + i).val(0);
                                $("#voltage-max-" + i).val(240);
                                $("#voltage-zero-" + i).val(0);
                                $("#voltage-span-" + i).val(320);
                            }
                            <?php
                            $counts = ChartRowsColumns["ACAMPERE"][0] * ChartRowsColumns["ACAMPERE"][1];
                            ?>
                            if (deviceCalibration.clAmpere) {
                                listCount = (deviceCalibration.clAmpere).length;
                            }
                            else {
                                listCount = 0;
                            }
                            for (i = 0; i < listCount; i++) {
                                $("#ampere-offset-" + i).val(parseFloat(deviceCalibration.clAmpere[i].cOffset));
                                $("#ampere-min-" + i).val(parseFloat(deviceCalibration.clAmpere[i].cMin));
                                $("#ampere-max-" + i).val(parseFloat(deviceCalibration.clAmpere[i].cMax));
                                $("#ampere-zero-" + i).val(parseFloat(deviceCalibration.clAmpere[i].cZero));
                                $("#ampere-span-" + i).val(parseFloat(deviceCalibration.clAmpere[i].cSpan));
                            }
                            for (; i < <?php echo $counts?>; i++) {
                                $("#ampere-offset-" + i).val(0);
                                $("#ampere-min-" + i).val(0);
                                $("#ampere-max-" + i).val(250);
                                $("#ampere-zero-" + i).val(20);
                                $("#ampere-span-" + i).val(100);
                            }
                            <?php
                            $counts = ChartRowsColumns["COSQ"][0] * ChartRowsColumns["COSQ"][1];
                            ?>
                            if (deviceCalibration.clCosq) {
                                listCount = (deviceCalibration.clCosq).length;
                            }
                            else {
                                listCount = 0;
                            }
                            for (i = 0; i < listCount; i++) {
                                $("#cosq-offset-" + i).val(parseFloat(deviceCalibration.clCosq[i].cOffset));
                                $("#cosq-min-" + i).val(parseFloat(deviceCalibration.clCosq[i].cMin));
                                $("#cosq-max-" + i).val(parseFloat(deviceCalibration.clCosq[i].cMax));
                                $("#cosq-zero-" + i).val(parseFloat(deviceCalibration.clCosq[i].cZero));
                                $("#cosq-span-" + i).val(parseFloat(deviceCalibration.clCosq[i].cSpan));
                            }
                            for (; i < <?php echo $counts?>; i++) {
                                $("#cosq-offset-" + i).val(0);
                                $("#cosq-min-" + i).val(0);
                                $("#cosq-max-" + i).val(250);
                                $("#cosq-zero-" + i).val(20);
                                $("#cosq-span-" + i).val(100);
                            }
                        },
                        error   : function () {
                            HideLoadingImage("popup-loading", e);
                            ShowAlert("پیام","خطا در دریافت داده های کالیبره");
                        },
                        timeout: 45000
                    });
                });

                $("#set-calibration").click(function (e) {
                    ShowLoadingImage("popup-loading", e);
                    var vOff  = [];
                    var vMin  = [];
                    var vMax  = [];
                    var vZero = [];
                    var vSpan = [];
                    var aOff  = [];
                    var aMin  = [];
                    var aMax  = [];
                    var aZero = [];
                    var aSpan = [];
                    var cOff  = [];
                    var cMin  = [];
                    var cMax  = [];
                    var cZero = [];
                    var cSpan = [];
                    <?php
                    $counts = ChartRowsColumns["ACVOLTAGE"][0] * ChartRowsColumns["ACVOLTAGE"][1];
                    ?>
                    for (var i = 0; i <<?php echo $counts ?>; i++) {
                        vOff[i]  = $("#voltage-offset-" + i).val();
                        vMin[i]  = $("#voltage-min-" + i).val();
                        vMax[i]  = $("#voltage-max-" + i).val();
                        vZero[i] = $("#voltage-zero-" + i).val();
                        vSpan[i] = $("#voltage-span-" + i).val();
                    }
                    <?php
                    $counts = ChartRowsColumns["ACAMPERE"][0] * ChartRowsColumns["ACAMPERE"][1];
                    ?>
                    for (i = 0; i <<?php echo $counts ?>; i++) {
                        aOff[i]  = $("#ampere-offset-" + i).val();
                        aMin[i]  = $("#ampere-min-" + i).val();
                        aMax[i]  = $("#ampere-max-" + i).val();
                        aZero[i] = $("#ampere-zero-" + i).val();
                        aSpan[i] = $("#ampere-span-" + i).val();
                    }
                    <?php
                    $counts = ChartRowsColumns["COSQ"][0] * ChartRowsColumns["COSQ"][1];
                    ?>
                    for (i = 0; i <<?php echo $counts ?>; i++) {
                        cOff[i]  = $("#cosq-offset-" + i).val();
                        cMin[i]  = $("#cosq-min-" + i).val();
                        cMax[i]  = $("#cosq-max-" + i).val();
                        cZero[i] = $("#cosq-zero-" + i).val();
                        cSpan[i] = $("#cosq-span-" + i).val();
                    }
                    $.ajax({
                        type    : 'GET',
                        url     : 'requests.php',
                        dataType: 'json',
                        data    : {
                            'req'  : 'setclb',
                            'ID'   : $('#device-list').find(":selected").val(),
                            'vOff' : vOff,
                            'vMin' : vMin,
                            'vMax' : vMax,
                            'vZero': vZero,
                            'vSpan': vSpan,
                            'aOff' : aOff,
                            'aMin' : aMin,
                            'aMax' : aMax,
                            'aZero': aZero,
                            'aSpan': aSpan,
                            'cOff' : cOff,
                            'cMin' : cMin,
                            'cMax' : cMax,
                            'cZero': cZero,
                            'cSpan': cSpan
                        },
                        //Device
                        success : function (result) {
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);

                            if (result.eMsg && result.eMsg != "") {
                                ShowAlert("پیام","خطا در ثبت داده های کالیبره\n".result.eMsg);
                            }
                            else {
                                ShowAlert("پیام","تنظیمات کالیبره با موفقیت انجام شد");
                            }
                        },
                        error   : function () {
                            HideLoadingImage("popup-loading", e);
                            ShowAlert("پیام","خطا در ثبت داده های کالیبره");
                        },
                        timeout: 120000
                    });
                });
            });
        </script>
    </div>
    <div style="width: 100%;display: inline-block;margin: 10px;">
        <?php
            $tempLoader->LoadCalibrationTemp();
        ?>
    </div>
</div>
