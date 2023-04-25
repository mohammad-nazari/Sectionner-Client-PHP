<?php
    /**
     * Created by PhpStorm.
     * User: mohammad
     * Date: 1/2/2015
     * Time: 4:27 PM
     */
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo _($pageName) . " " . $pagePrefix ?></title>
    <!-- Basics -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">

    <!-- Styles -->
    <!-- Main and menu and Header and Footer-->
    <link href="styles/style.css" type="text/css" rel="stylesheet"/>
    <link href="styles/main/style.css" type="text/css" rel="stylesheet"/>
    <link href="styles/menu/styles.css" type="text/css" rel="stylesheet"/>
    <!-- Login -->
    <link href="styles/login/animate.css" type="text/css" rel="stylesheet"/>
    <link href="styles/login/styles.css" type="text/css" rel="stylesheet"/>
    <!-- Online styles -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!-- gridster -->
    <link href="styles/gridster/jquery.gridster.css" rel="stylesheet">
    <link href="styles/gridster/style.css" rel="stylesheet">

    <!-- Device and Sensor -->
    <link href="styles/device/device.css" rel="stylesheet">

    <!-- Scripts -->
    <!-- jquery -->
    <script src="scripts/jquery/jquery-1.12.0/jquery-1.12.0.min.js" type="text/javascript"></script>
    <script src="scripts/jquery/jquery-2.2.0/jquery-2.2.0.min.js" type="text/javascript"></script>
    <script src="scripts/device/device.js" type="text/javascript"></script>

    <!-- Menu -->
    <script src="scripts/menu/script.js" type="text/javascript"></script>

    <!-- gridster -->
    <script src="scripts/gridster/jquery.gridster.js" type="text/javascript"></script>
    <script src="scripts/gridster/controllers.js" type="text/javascript"></script>

    <!-- Confirm  -->
    <link rel="stylesheet" type="text/css" media="all" href="scripts/craftpip-confirm/dist/jquery-confirm.min.css" title="Aqua"/>
    <script type="text/javascript" src="scripts/craftpip-confirm/dist/jquery-confirm.min.js"></script>
    
    <!-- Jalali JSCalendar   -->
    <link rel="stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/aqua/theme.css" title="Aqua"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-blue.css" title="winter"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-blue2.css" title="blue"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-brown.css" title="summer"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-green.css" title="green"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-win2k-1.css" title="win2k-1"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-win2k-2.css" title="win2k-2"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-win2k-cold-1.css" title="win2k-cold-1"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-win2k-cold-2.css" title="win2k-cold-2"/>
    <link rel="alternate stylesheet" type="text/css" media="all" href="scripts/JalaliJSCalendar/skins/calendar-system.css" title="system"/>

    <!--  Jalali JSCalendar  -->
    <script type="text/javascript" src="scripts/JalaliJSCalendar/jalali.js"></script>
    <script type="text/javascript" src="scripts/JalaliJSCalendar/calendar.js"></script>
    <script type="text/javascript" src="scripts/JalaliJSCalendar/calendar-setup.js"></script>
    <script type="text/javascript" src="scripts/JalaliJSCalendar/lang/calendar-fa.js"></script>

    <!--  Popup  -->
    <link rel="alternate stylesheet" type="text/css" media="all" href="styles/popup/style.css" title="system"/>

    <!--  Digital Numbers  -->
    <link href="styles/digital/style2.css" rel="stylesheet">

    <!-- Gauge and Temprature -->
    <link rel="stylesheet" href="scripts/jqwidgets/jqwidgets/styles/jqx.base.css" type="text/css"/>
    <script type="text/javascript" src="scripts/jqwidgets/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqwidgets/jqxdraw.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqwidgets/jqxgauge.js"></script>
    <script type="text/javascript" src="scripts/jqwidgets/jqwidgets/jqxprogressbar.js"></script>
    <script type="text/javascript" src="scripts/main/main.js"></script>
    <style>
        /* Outer */
        .popup
        {
            width      : 100%;
            height     : 100%;
            display    : none;
            position   : fixed;
            top        : 0px;
            left       : 0px;
            background : rgba(0, 0, 0, 0.75);
            z-index    : 1000;
            }

        /* Inner */
        .popup-inner
        {
            max-width         : 700px;
            width             : 90%;
            padding           : 40px;
            position          : absolute;
            top               : 50%;
            left              : 50%;
            -webkit-transform : translate(-50%, -50%);
            transform         : translate(-50%, -50%);
            box-shadow        : 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius     : 3px;
            background        : #fff;
            overflow          : auto;
            height            : inherit;
            }

        /* Close Button */
        .popup-close
        {
            width             : 30px;
            height            : 30px;
            padding-top       : 4px;
            display           : inline-block;
            position          : absolute;
            top               : 0px;
            right             : 0px;
            transition        : ease 0.25s all;
            -webkit-transform : translate(50%, -50%);
            transform         : translate(50%, -50%);
            border-radius     : 1000px;
            background        : rgba(0, 0, 0, 0.8);
            font-family       : Arial, Sans-Serif;
            font-size         : 20px;
            text-align        : center;
            line-height       : 100%;
            color             : #fff;
            }

        .popup-close:hover
        {
            -webkit-transform : translate(50%, -50%) rotate(180deg);
            transform         : translate(50%, -50%) rotate(180deg);
            background        : rgba(0, 0, 0, 1);
            text-decoration   : none;
            }
    </style>

    <script type="text/javascript">
        var userName          = '<?php echo $_SESSION[USERNAME]?>';
        var deviceModel       = '';
        var dateTimeFrom;
        var dateTimeTo;
        var map_device_edit;
        var map_device;
        var device_marker;
        var device_edit_marker;
        var deviceLatLng      = {lat: 30, lng: 20};
        var sensorChartConfig = [];
        var sensorChart       = [];
        var sensorTable       = [];
        var switchValue       = [];
        var digitalInputGauge = [];
        var temperatures      = [];
        var humidity          = [];
        var editRelays        = false;
        var loadImage         = false;
        var indexRelay        = 0;
        var greDateTime       = $.now();
        var progressStatus;
        var progressBarDiv;
        var progressText;
        var getPicture        = false;
        var progressBar;
        var gauge;
        var linear;
        var tcpType = true;

        var sectionnerState = 0;
        var gasOK           = 0;
        var lockState       = 0;
        var door1State      = 0;
        var door2State      = 0;

        var CosQBack = [0, 0, 0];

        var userID    = 0;
        var lastDateTime = 0; // The last time data received from device
    </script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js">
    </script>

</head>
<body>
<div id="wrapper" class="wrapper_container">
