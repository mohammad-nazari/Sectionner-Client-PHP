<?php
/**
 * Created by PhpStorm.
 * User: Mohammad
 * Date: 02/02/2016
 * Time: 01:51 PM
 */

require_once('control/definitions.php');
require_once('control/persian_date/PCalendar.Class.php');
require_once("control/DigitalClock.php");
require_once('control/TempLoader.php');

require_once('control/DeviceClass.php');

$device = new  DeviceClass();
$device = ToolsClass::LoadFromParentObj($deviceObject, $device);
$device->InitializeDevice();
?>
<style>
    .sectionCSS {
        display: none;
        padding: 20px 0 0;
        border-top: 1px solid #ddd;
    }

    .inputCSS {
        display: none;
    }

    .labelCSS {
        display: inline-block;
        margin: 0 0 -1px;
        padding: 15px 25px;
        font-weight: 600;
        text-align: center;
        color: #bbb;
        border: 1px solid transparent;
    }

    .labelCSS:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 10px;
    }

    .labelCSS:hover {
        color: #888;
        cursor: pointer;
    }

    .inputCSS:checked + .labelCSS {
        color: #555;
        border: 1px solid #ddd;
        border-top: 2px solid orange;
        border-bottom: 1px solid #fff;
    }

    #tab1:checked ~ #content1,
    #tab2:checked ~ #content2,
    #tab3:checked ~ #content3,
    #tab4:checked ~ #content4,
    #tab5:checked ~ #content5,
    #tab6:checked ~ #content6,
    #tab7:checked ~ #content7 {
        display: block;
    }

    @media screen and (max-width: 650px) {
        .labelCSS {
            font-size: 0;
        }

        .labelCSS:before {
            margin: 0;
            font-size: 18px;
        }
    }

    @media screen and (max-width: 400px) {
        .labelCSS {
            padding: 15px;
        }
    }

</style>
<script src="scripts/tabs/js/prefixfree.min.js"></script>

<link rel="stylesheet" href="scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
<link rel="stylesheet" href="styles/device/device.css" type="text/css"/>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.js"></script>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.bundle.js"></script>
<div id="content" class="main_container">
    <div id="device-errors" class="errors"></div>
    <div class="left_panel">
		<?php
		$sensors = array(\webservice\SensorName::TEMPERATURE => "", \webservice\SensorName::HUMIDITY => "",
		                 \webservice\SensorName::ACVOLTAGE => "", \webservice\SensorName::ACAMPERE => "",
		                 \webservice\SensorName::COSQ => "", \webservice\SensorName::DIGITALINPUT => "",
		                 \webservice\SensorName::RELAY => "");
		if (is_array($device->dSensors))
		{
			foreach ($device->dSensors as $sensorEx)
			{
				$sensors[$sensorEx->seName] = $sensorEx->seVal;
			}
		}
		?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("تصویر دستگاه") ?></legend>
				<?php
				$tempLoader->LoadDevicePicture("device", "images/device/" . $device->_dImage);
				?>
            </fieldset>
            <div style="float: left;padding: 20px 0 0 20px;align-items: center"><span id="device-get-status"
                                                                                      class="btn"><?php echo _("دریافت وضعیت دستگاه") ?></span>
            </div>
            <script>
                $(document).ready(function () {
                    $("#device-get-status").click(function (e) {
                        // Try to close
                        $.confirm({
                            title: 'اخطار',
                            content: 'نحوه ارسال دستور را انتخاب کنید:',
                            confirmButton: 'از طریق شبکه',
                            cancelButton: 'از طریق پیامک',
                            rtl: true,
                            confirm: function () {
                                // Show loading icon
                                ShowLoadingImage("popup-loading", e);
                                // Send to server
                                $.ajax({
                                    type: 'GET',
                                    url: 'requests.php',
                                    dataType: 'json',
                                    data: {
                                        'req': 'status',
                                        'ID': $("#device-serial-number").text(),
                                        'tcp': tcpType
                                    },
                                    //Device
                                    success: function (result) {
                                        if (ShowMessage(result, "درخواست ارسال گردید. منتظر دریافت نتیجه باشید.") === true) {
                                            $.ajax({
                                                type: 'GET',
                                                url: 'requests.php',
                                                dataType: 'json',
                                                data: {
                                                    'req': 'device',
                                                    'ID': $.urlParam('ID')
                                                },
                                                success: function (result) {
                                                    $("#device-errors").text("نرمال");
                                                    UpdateDevice(result);
                                                    ShowAlert("پیام", "وضعیت دستگاه با موفقیت دریافت گردید");
                                                    HideLoadingImage("popup-loading", e);
                                                },
                                                error: function () {
                                                    // Finish loading icon
                                                    HideLoadingImage("popup-loading", e);
                                                    ShowAlert("خطا", "خطا در دریافت وضعیت دستگاه");
                                                    $("#device-errors").text("خطا در دریافت وضعیت دستگاه");
                                                },
                                                timeout: 20000
                                            });
                                        }
                                        else {
                                            HideLoadingImage("popup-loading", e);
                                            //$("#device-errors").text("خطا : " + result.responseError.eMsg);
                                        }
                                    },
                                    error: function () {
//                            var err = eval("(" + xhr.responseText + ")");
                                        //ShowAlert("خطا", "خطا در دریافت وضعیت دستگاه");
                                        ShowAlert("درخواست ارسال گردید. منتظر دریافت نتیجه باشید.");
                                        // Finish loading icon
                                        HideLoadingImage("popup-loading", e);
                                        $("#device-errors").text("خطا در دریافت وضعیت دستگاه")
                                    },
                                    timeout: 30000
                                });
                            },
                            cancel: function () {
                                // Show loading icon
                                ShowLoadingImage("popup-loading", e);
                                // Send to server
                                $.ajax({
                                    type: 'GET',
                                    url: 'requests.php',
                                    dataType: 'json',
                                    data: {
                                        'req': 'sms',
                                        'ID': $("#device-serial-number").text(),
                                    },
                                    //Device
                                    success: function (result) {
                                        HideLoadingImage("popup-loading", e);
                                        if (result.eMsg && result.eMsg != "") {
                                            ShowAlert("پیام", "خطا در ثبت داده های کالیبره\n".result.eMsg);
                                            $("#device-errors").text("خطا : " + result.eMsg);
                                        }
                                        else {
                                            ShowAlert("پیام", "درخواست انجام شد. لطفا تا دریافت اطلاعات از طریق پیامک صبر کنید.");
                                        }
                                    },
                                    error: function () {
//                            var err = eval("(" + xhr.responseText + ")");
                                        ShowAlert("خطا", "خطا در دریافت وضعیت دستگاه");
                                        // Finish loading icon
                                        HideLoadingImage("popup-loading", e);
                                        $("#device-errors").text("خطا در دریافت وضعیت دستگاه")
                                    },
                                    timeout: 10000
                                });
                            }
                        });
                    });
                });
            </script>
        </div>
		<?php
		$tempLoader->LoadDeviceErrorList();
		$tempLoader->LoadDeviceStatus($device);
		if ($device != NULL and $device->dModel != NULL and $device->dModel == webservice\DeviceModel::SECTIONNER)
		{
			$tempLoader->LoadSettingButton($device);
			$lastImage = "images/device/no_image.png";
			if (file_exists("images/device/" . $device->dSerialNumber . $_SESSION[USERNAME] . ".gif"))
			{
				$lastImage = "images/device/" . $device->dSerialNumber . $_SESSION[USERNAME] . ".gif";
			}
			?>
            <div class="panel_div">
                <fieldset>
                    <legend><?php echo _("آخرین تصویر دستگاه") ?></legend>
					<?php
					$tempLoader->LoadDevicePicture("device-last", $lastImage);
					?>
                </fieldset>
				<?php
				$tempLoader->LoadProgressBar($device->dModel,
					$device->dCamera->cIP->ip1 . "." . $device->dCamera->cIP->ip2 . "." . $device->dCamera->cIP->ip3 .
					"." .
					$device->dCamera->cIP->ip4 . " : " . $device->dCamera->cPort);
				?>
            </div>
			<?php
			$tempLoader->LoadTemHum($device, $sensors[\webservice\SensorName::HUMIDITY],
				\webservice\SensorName::HUMIDITY, "رطوبت", "hum", 1, "%", "");
			$tempLoader->LoadTemHum($device, $sensors[\webservice\SensorName::TEMPERATURE],
				\webservice\SensorName::TEMPERATURE, "دما", "tem", 1, "℃", "linear_gauge");
		}
		else
		{
			$tempLoader->LoadDeviceStatus2($device);
			$tempLoader->LoadSettingButton($device);
			$tempLoader->LoadFUS($device);
			$tempLoader->LoadTemHum($device, $sensors[\webservice\SensorName::HUMIDITY],
				\webservice\SensorName::HUMIDITY, "رطوبت", "hum", 2, "%", "");
			$tempLoader->LoadTemHum($device, $sensors[\webservice\SensorName::TEMPERATURE],
				\webservice\SensorName::TEMPERATURE, "دما", "tem", 2, "℃", "linear_gauge");
		}
		?>
        <div class="panel_div">
            <fieldset>
                <legend><?php echo _("موقعیت دستگاه") ?></legend>
                <div id="device-map" style="width:200px; height:200px;"></div>
                <script>
                    deviceLatLng = {lat: <?php echo $device->dGPS->gX ?>, lng: <?php echo $device->dGPS->gY?>};

                    function initMap() {
                        map_device = new google.maps.Map(document.getElementById('device-map'), {
                            center: deviceLatLng,
                            zoom: 8
                        });
                        device_marker = new google.maps.Marker({
                            position: deviceLatLng,
                            map: map_device,
                            title: '<?php echo $device->dNikeName ?>(<?php echo $device->dSerialNumber ?>)'
                        });

                        map_device_edit = new google.maps.Map(document.getElementById('device-map-edit'), {
                            center: deviceLatLng,
                            zoom: 8
                        });
                        device_edit_marker = new google.maps.Marker({
                            position: deviceLatLng,
                            map: map_device_edit,
                            title: '<?php echo $device->dNikeName ?>(<?php echo $device->dSerialNumber ?>)'
                        });
                        // This event listener will call addMarker() when the map is clicked.
                        map_device_edit.addListener('click', function (event) {
                            device_edit_marker.setPosition(event.latLng);
                            $("#x-pos").val(event.latLng.lat);
                            $("#y-pos").val(event.latLng.lng);
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAp5IhK73NtzMevlRWg6ePDtw2KfPVGAC8&callback=initMap"
                        async defer></script>
            </fieldset>
        </div>
    </div>
    <div class="right_panel">
		<?php
		if ($device != NULL and $device->dModel != NULL and $device->dModel == webservice\DeviceModel::SECTIONNER)
		{
			$tempLoader->LoadDigitalState($sensors[\webservice\SensorName::DIGITALINPUT],
				\webservice\SensorName::DIGITALINPUT, "Digital In", LabelsInputS, "digital-in",
				ChartRowsColumnsS[\webservice\SensorName::DIGITALINPUT][0],
				ChartRowsColumnsS[\webservice\SensorName::DIGITALINPUT][1], $device->dModel);
			?>
            <input class="inputCSS" id="tab1" type="radio" name="tabs" checked>
            <label class="labelCSS" for="tab1"><?php echo _("AC Voltage") ?></label>

            <input class="inputCSS" id="tab2" type="radio" name="tabs">
            <label class="labelCSS" for="tab2"><?php echo _("AC Ampere") ?></label>

            <input class="inputCSS" id="tab3" type="radio" name="tabs">
            <label class="labelCSS" for="tab3"><?php echo _("CosΦ") ?></label>

            <input class="inputCSS" id="tab4" type="radio" name="tabs">
            <label class="labelCSS" for="tab4"><?php echo _("Power") ?></label>

            <input class="inputCSS" id="tab5" type="radio" name="tabs">
            <label class="labelCSS" for="tab5"><?php echo _("Reactive") ?></label>

            <input class="inputCSS" id="tab6" type="radio" name="tabs">
            <label class="labelCSS" for="tab6"><?php echo _("Relay") ?></label>

            <!--<input class="inputCSS" id="tab7" type="radio" name="tabs">
                <label class="labelCSS" for="tab7"><?php /*echo _("Digital In") */
			?></label>-->

            <section class="sectionCSS" id="content1">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACVOLTAGE],
					\webservice\SensorName::ACVOLTAGE, "AC Voltage", "ACV (KV)", LabelsVoltageS, "acv",
					ChartRowsColumnsS[\webservice\SensorName::ACVOLTAGE][0],
					ChartRowsColumnsS[\webservice\SensorName::ACVOLTAGE][1], 0, 0, 0, 22, 22, 22,
					$device->localTime, 4, 2);
				?>
            </section>
            <section class="sectionCSS" id="content2">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACAMPERE], \webservice\SensorName::ACAMPERE,
					"AC Ampere", "ACA (A)", LabelsAmpereS, "aca",
					ChartRowsColumnsS[\webservice\SensorName::ACAMPERE][0],
					ChartRowsColumnsS[\webservice\SensorName::ACAMPERE][1], 0, 0, 0, 250, 250, 150,
					$device->localTime, 4,
					2);
				?>
            </section>
            <section class="sectionCSS" id="content3">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::COSQ], \webservice\SensorName::COSQ, "Cos Φ",
					"CosΦ", LabelsCosqS, "cosq",
					ChartRowsColumnsS[\webservice\SensorName::COSQ][0],
					ChartRowsColumnsS[\webservice\SensorName::COSQ][1], 0, 0, 0, 1, 1, 1, $device->localTime, 1, 2);
				?>
            </section>
            <section class="sectionCSS" id="content4">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::DIGITALEXIST],
					\webservice\SensorName::DIGITALEXIST, "Power", "Power (KW)", LabelsPowerS, "power",
					ChartRowsColumnsS[\webservice\SensorName::DIGITALEXIST][0],
					ChartRowsColumnsS[\webservice\SensorName::DIGITALEXIST][1], 0, 0, 0, 1000, 1000, 1000,
					$device->localTime, 4, 2);
				?>
            </section>
            <section class="sectionCSS" id="content5">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::DIGITALOUTPUT],
					\webservice\SensorName::DIGITALOUTPUT, "Reactive", "Reactive (KVAR)", LabelsReactiveS, "reactive",
					ChartRowsColumnsS[\webservice\SensorName::DIGITALOUTPUT][0],
					ChartRowsColumnsS[\webservice\SensorName::DIGITALOUTPUT][1], 0, 0, 0, 1000, 1000, 1000,
					$device->localTime, 4, 2);
				?>
            </section>
            <section class="sectionCSS" id="content6">
				<?php
				$tempLoader->LoadRelay($sensors[\webservice\SensorName::RELAY], \webservice\SensorName::RELAY, "Relay",
					LabelsRelayS, TextRelayS, "relay",
					ChartRowsColumnsS[\webservice\SensorName::RELAY][0],
					ChartRowsColumnsS[\webservice\SensorName::RELAY][1], $device->dModel, TRUE);
				?>
                <!--</section>
				<section class="sectionCSS" id="content7">-->
				<?php
				/*$tempLoader->LoadDigitalState($sensors[\webservice\SensorName::DIGITALINPUT], \webservice\SensorName::DIGITALINPUT, "Digital In", LabelsInputS, "digital-in",
											  ChartRowsColumnsS[\webservice\SensorName::DIGITALINPUT][0], ChartRowsColumnsS[\webservice\SensorName::DIGITALINPUT][1], $device->dModel);*/
				?>
            </section>
			<?php
		}
		else
		{
			?>
            <input class="inputCSS" id="tab1" type="radio" name="tabs" checked>
            <label class="labelCSS" for="tab1"><?php echo _("AC Voltage") ?></label>

            <input class="inputCSS" id="tab2" type="radio" name="tabs">
            <label class="labelCSS" for="tab2"><?php echo _("AC Ampere") ?></label>

            <input class="inputCSS" id="tab3" type="radio" name="tabs">
            <label class="labelCSS" for="tab3"><?php echo _("CosΦ") ?></label>

            <!--<input class="inputCSS" id="tab4" type="radio" name="tabs">
                <label class="labelCSS" for="tab4"><?php /*echo _("Relay") */
			?></label>-->

            <!--<input class="inputCSS" id="tab5" type="radio" name="tabs">
                <label class="labelCSS" for="tab5"><?php /*echo _("Digital In") */
			?></label>-->

            <section class="sectionCSS" id="content1">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACVOLTAGE],
					\webservice\SensorName::ACVOLTAGE, "AC Voltage", "ACV (V)", LabelsVoltage, "acv",
					ChartRowsColumns[\webservice\SensorName::ACVOLTAGE][0],
					ChartRowsColumns[\webservice\SensorName::ACVOLTAGE][1], 0, 140, 140, 300, 300, 300,
					$device->localTime, 4, 2);
				?>
            </section>
            <section class="sectionCSS" id="content2">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACAMPERE], \webservice\SensorName::ACAMPERE,
					"AC Ampere", "ACA (A)", LabelsAmpere, "aca",
					ChartRowsColumns[\webservice\SensorName::ACAMPERE][0],
					ChartRowsColumns[\webservice\SensorName::ACAMPERE][1], 0, 0, 0, 250, 250, 150,
					$device->localTime, 4,
					2);
				?>
            </section>
            <section class="sectionCSS" id="content3">
				<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::COSQ], \webservice\SensorName::COSQ, "Cos Φ",
					"CosΦ", LabelsCosq, "cosq",
					ChartRowsColumns[\webservice\SensorName::COSQ][0],
					ChartRowsColumns[\webservice\SensorName::COSQ][1], 0, 0, 0, 1, 1, 1, $device->localTime, 1, 2);
				?>
            </section>
            <!-- <section class="sectionCSS" id="content4">
                    <?php
			/*                        $tempLoader->LoadSwitchBox($sensors[\webservice\SensorName::RELAY], \webservice\SensorName::RELAY, "Relay", LabelsInput, TextRelay, "relay",
															   ChartRowsColumns[\webservice\SensorName::RELAY][0],
															   ChartRowsColumns[\webservice\SensorName::RELAY][1], $device->dModel, TRUE);
								*/
			?>
                <!--</section>
                <section class="sectionCSS" id="content5">-->
			<?php
			/*                        $tempLoader->LoadSwitchBox($sensors[\webservice\SensorName::DIGITALINPUT], \webservice\SensorName::DIGITALINPUT, "Digital In", LabelsRelay, TextInput, "digital-in",
															   ChartRowsColumns[\webservice\SensorName::DIGITALINPUT][0], ChartRowsColumns[\webservice\SensorName::DIGITALINPUT][1], $device->dModel);
								*/
			?>
            </section>-->
			<?php
		}
		?>
    </div>
</div>
