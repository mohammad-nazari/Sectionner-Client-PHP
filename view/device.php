<?php
    /**
     * Created by PhpStorm.
     * User: Mohammad
     * Date: 27/01/2016
     * Time: 11:38 AM
     */
    if(isset($_GET) and isset($_GET['ID']))
    {
        require_once('view/initialize.php');

        $deviceObject = DefaultObjectsClass::GetDeviceStatus();
//      exit(var_dump($deviceObject));
        $pageName     = _('Show device status');
        $pagePrefix   = $_GET['ID'];
        require_once('view/templates/headers.php');
        require_once('view/templates/menu.php');
        require_once('view/templates/device.php');
        require_once('view/templates/footer.php');
        $intervalTime = $deviceObject->dSamplingTime * 1000;
        if($intervalTime < 20000)
        {
            $intervalTime = 20000;
        }
        ?>
        <script src="scripts/device/device.js" type="text/javascript"></script>;
        <script src="scripts/getdevicestatus.js" type="text/javascript"></script>;
        <script>
            $(document).ready(function () {
                GetDeviceInformation(<?php echo $intervalTime ?>)
            });
        </script>
        <?php
    }
    else
    {
        require_once('view/alldevices.php');
    }