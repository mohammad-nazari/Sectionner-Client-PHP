<?php
    require_once('control/definitions.php');
    require_once('view/templates/headers.php');
    require_once('view/templates/menu.php');
    require_once('control/persian_date/PCalendar.Class.php');
    require_once("control/DigitalClock.php");
    require_once('control/TempLoader.php');
    //        $device = DefaultObjectsClass::NewDevice();

?>
<link rel="stylesheet" href="scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
<link rel="stylesheet" href="styles/device/device.css" type="text/css"/>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.js"></script>
<script type="text/javascript" src="scripts/Chart.js-master/dist/Chart.bundle.js"></script>
<div id="content" class="main_container">
    <div class="left_panel">
        <?php
            $tempLoader->LoadDevicePicture("device", $device->dModel);
            $tempLoader->LoadDeviceStatus($device);
            if($device != NULL and $device->dModel != NULL and $device->dModel == webservice\DeviceModel::SECTIONNER)
            {
                $tempLoader->LoadDevicePicture("device-last");
                $tempLoader->LoadProgressBar();
            }
            else
            {
                $tempLoader->LoadDeviceStatus2($device);
            }
            $tempLoader->LoadTemHum($device);
        ?>
        <div id="device-map" class="panel_div">
            <div id="device-map"></div>
            <script>
                var map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById('device-map'), {
                        center: {lat: <?php echo $device->dGPS->gX ?>, lng: <?php echo $device->dGPS->gY ?>},
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
        <?php
            $tempLoader->LoadSwitchBox("relay", 4, 8, TRUE);
            $tempLoader->LoadChartBox("AC Voltage", "acv", 8, 4, NULL);
            $tempLoader->LoadChartBox("AC Ampere", "aca", 8, 4, NULL);
            $tempLoader->LoadChartBox("Cos Q", "CosΦ", 3, 1, NULL);
            $tempLoader->LoadSwitchBox("digital-in", 4, 8);
        ?>
        <!--<div id="sensor-dcv" class="panel_div">
        </div>
        <div id="sensor-dca" class="panel_div">
        </div>-->
    </div>
</div>
<?php
    require_once('view/templates/footer.php');
    echo '<script src = "scripts/getdevicestatus.js" type="text/javascript"></script>';
?>


