<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 02/02/2016
	 * Time: 01:51 PM
	 */
	
	require_once('control/definitions.php');
	require_once('control/DeviceClass.php');
	require_once('control/TempLoader.php');
	//    $userDeviceList = DefaultObjectsClass::NewUserDevice();
?>
<link rel="stylesheet" href="scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
<link rel="stylesheet" href="styles/device/device.css" type="text/css"/>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.js"></script>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.bundle.js"></script>
<script type="text/javascript" src="scripts/getdevicereport.js"></script>

<div id="content" class="main_container">
    <div class="report-search">
        <div style="padding:2px; float: right;">
            <label for="device-list"><?php echo _("فهرست دستگاه ها: ") ?></label>
            <select id="device-list">
				<?php
					foreach($userDeviceList->udDevs as $userDevice)
					{
						if($userDevice->dSerialNumber > 0)
						{
							$device = new  DeviceClass();
							$device = ToolsClass::LoadFromParentObj($userDevice, $device);
							$device->DecodeData();
							//                        $deviceRules = DefaultObjectsClass::NewDevice();
							?>
                            <option value="<?php echo $device->dSerialNumber ?>"><?php echo $device->dNikeName . "(" . $device->dSerialNumber . ")" ?></option>
							<?php
						}
					}
				?>
            </select>
        </div>
        <div style="padding:2px; float: right;">
            <label for="device-date-time-from"><?php echo _("از تاریخ : ") ?></label>
            <input type="text" id="device-date-time-from" name="data"/>
            <img id="device-date-time-btn-from" src="scripts/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;">
            <script type="text/javascript">
                var dt = new Date();
                dt.setHours(dt.getHours() + 4);
                dt.setMinutes(dt.getMinutes() + 30);
                //                var nowDateTime = toTimeZone(new Date(), "Asia/Tehran");
                Calendar.setup({
                    inputField: "device-date-time-from",   // id of the input field
                    button: "device-date-time-btn-from",   // trigger for the calendar (button ID)
                    ifFormat: "%Y/%m/%d %H:%M",       // format of the input field
                    showsTime: true,
                    dateType: 'jalali',
                    showOthers: true,
                    langNumbers: true,
                    weekNumbers: true,
                    date: dt,
                    onUpdate: dateFromChanged
                });
                function dateFromChanged(calendar) {
                    //do some thing with the selected date
                    dateTimeFrom = calendar.date.print('%Y-%m-%d %H:%M', '');
                }
            </script>
        </div>
        <div style="padding:2px; float: right;">
            <label for="device-date-time-to"><?php echo _("تا تاریخ : ") ?></label>
            <input type="text" id="device-date-time-to" name="data"/>
            <img id="device-date-time-btn-to" src="scripts/JalaliJSCalendar/examples/cal.png" style="vertical-align: top;">
            <script type="text/javascript">
                Calendar.setup({
                    inputField: "device-date-time-to",   // id of the input field
                    button: "device-date-time-btn-to",   // trigger for the calendar (button ID)
                    ifFormat: "%Y/%m/%d %H:%M",       // format of the input field
                    showsTime: true,
                    dateType: 'jalali',
                    showOthers: true,
                    langNumbers: true,
                    weekNumbers: true,
                    date: dt,
                    onUpdate: dateToChanged
                });
                function dateToChanged(calendar) {
                    //do some thing with the selected date
                    dateTimeTo = calendar.date.print('%Y-%m-%d %H:%M', '');
                }
            </script>
        </div>
        <div style="padding:2px; float: right;">
            <span id="get-reports" class="btn"><?php echo _("Submit") ?></span>
        </div>
    </div>

    <div class="reports" style="direction: ltr;">
        <div id="sectionner-report">
			<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACVOLTAGE], \webservice\SensorName::ACVOLTAGE, "AC Voltage", "ACV", LabelsVoltageS, "acvs",
				                          ChartRowsColumnsS[\webservice\SensorName::ACVOLTAGE][0], ChartRowsColumnsS[\webservice\SensorName::ACVOLTAGE][1], 0, 0, 0, 22, 22, 22,
				                          $device->localTime, 6, 2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACAMPERE], \webservice\SensorName::ACAMPERE, "AC Ampere", "ACA", LabelsAmpereS, "acas",
				                          ChartRowsColumnsS[\webservice\SensorName::ACAMPERE][0], ChartRowsColumnsS[\webservice\SensorName::ACAMPERE][1], 0, 0, 0, 250, 250, 150, $device->localTime, 4,
				                          2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::COSQ], \webservice\SensorName::COSQ, "Cos Φ", "CosΦ", LabelsCosqS, "cosqs",
				                          ChartRowsColumnsS[\webservice\SensorName::COSQ][0],
				                          ChartRowsColumnsS[\webservice\SensorName::COSQ][1], 0, 0, 0, 1, 1, 1, $device->localTime, 1, 2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::DIGITALEXIST], \webservice\SensorName::DIGITALEXIST, "Power", "Power", LabelsPowerS, "powers",
				                          ChartRowsColumnsS[\webservice\SensorName::DIGITALEXIST][0],
				                          ChartRowsColumnsS[\webservice\SensorName::DIGITALEXIST][1], 0, 0, 0, 1000, 1000, 1000, $device->localTime, 6, 2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::DIGITALOUTPUT], \webservice\SensorName::DIGITALOUTPUT, "Reactive", "Reactive", LabelsReactiveS, "reactives",
				                          ChartRowsColumnsS[\webservice\SensorName::DIGITALOUTPUT][0],
				                          ChartRowsColumnsS[\webservice\SensorName::DIGITALOUTPUT][1], 0, 0, 0, 1000, 1000, 1000, $device->localTime, 6, 2, FALSE, TRUE, TRUE);
			?>
        </div>
        <div id="manager-report">
			<?php
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACVOLTAGE], \webservice\SensorName::ACVOLTAGE, "AC Voltage", "ACV", LabelsVoltage, "acvm",
				                          ChartRowsColumns[\webservice\SensorName::ACVOLTAGE][0], ChartRowsColumns[\webservice\SensorName::ACVOLTAGE][1], 0, 140, 140, 300, 300, 300,
				                          $device->localTime, 4, 2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::ACAMPERE], \webservice\SensorName::ACAMPERE, "AC Ampere", "ACA", LabelsAmpere, "acam",
				                          ChartRowsColumns[\webservice\SensorName::ACAMPERE][0], ChartRowsColumns[\webservice\SensorName::ACAMPERE][1], 0, 0, 0, 250, 250, 150, $device->localTime, 4,
				                          2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::COSQ], \webservice\SensorName::COSQ, "Cos Φ", "CosΦ", LabelsCosq, "cosqm", ChartRowsColumns[\webservice\SensorName::COSQ][0],
				                          ChartRowsColumns[\webservice\SensorName::COSQ][1], 0, 0, 0, 1, 1, 1, $device->localTime, 1, 2, FALSE, TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::TEMPERATURE], \webservice\SensorName::TEMPERATURE, "Temperature", "TEM", array(), "temm", 4, 1, -50, -50, -50, 150, 150, 150,
				                          $device->localTime,
				                          4, 2, FALSE,
				                          TRUE, TRUE);
				$tempLoader->LoadChartBox($sensors[\webservice\SensorName::HUMIDITY], \webservice\SensorName::HUMIDITY, "Humidity", "HUM", array(), "humm", 4, 1, 0, 0, 0, 100, 100, 100,
				                          $device->localTime, 4, 2, FALSE,
				                          TRUE, TRUE);
			?>
        </div>
        <script>
            $(document).ready(function () {
                $("#get-reports").click(function (e) {
                    // Show loading icon
                    ShowLoadingImage("popup-loading", e);

                    $.ajax({
                        type: 'GET',
                        url: 'requests.php',
                        dataType: 'json',
                        data: {
                            'req': 'report',
                            'ID': $('#device-list').find(":selected").val(),
                            'start': dateTimeFrom,
                            'end': dateTimeTo
                        },
                        //Device
                        success: function (result) {
                            FillReportCharts(result);
                            // Show loading icon
                            HideLoadingImage("popup-loading", e);
                        },
                        error: function () {
                            HideLoadingImage("popup-loading", e);
                            alert("Error in get report data");
                        },
                        timeout: 120000
                    });
                });
            });
        </script>
    </div>
</div>
