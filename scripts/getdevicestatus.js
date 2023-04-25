/**
 * Created by Mohammad on 31/01/2016.
 */

/*
 *
 */
$.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    return results[1] || 0;
};

function GetDeviceInformation(IntervalTime) {
    $("#device-errors").text("Normal");
    setInterval(function () {
        $.ajax({
            type: 'GET',
            url: 'requests.php',
            dataType: 'json',
            data: {
                'req': 'device',
                'ID': $.urlParam('ID')
            },
            success: function (result) {
                $("#device-errors").text("Normal");
                UpdateDevice(result);
            },
            error: function () {
                $("#device-errors").text("خطا در دریافت وضعیت دستگاه")
            },
            timeout: 30000
        });
    }, IntervalTime);
}

function SetRelays(RelaysList, DeviceId) {
    $.when(SendRelays()).done(function (data, textStatus, jqXHR) {
        ShowAlert("پیام", data);
    });
}

function SendRelays() {
    return $.ajax({
        type: 'GET',
        url: 'requests.php',
        dataType: 'json',
        data: {
            'req': 'relay',
            'ID': $.urlParam('ID'),
            'relays': "lll"
        },
        //Device
        success: function (result) {
            return result;
        },
        error: function () {
            ShowAlert("پیام", "هیچ پیامی از سمت سرور و دستگاه دریافت نشد.");
        },
        timeout: 45000
    });
}

/*
 *
 */
function UpdateDevice(device) {
    if (device.dDDateTime !== lastDateTime) {
        lastDateTime = device.dDDateTime; // Save Last time
        $("#device-errors").text(SetResultMessage(device.dErr, device.dErr.eType));
        // Update current information
        var sensors = [];
        $.each(device.dSensors, function (key, sensorEx) {
            sensors[sensorEx.seName] = sensorEx.seVal;
        });

        const TextRelay
            = ["gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray",
            "gray", "gray", "gray", "gray", "gray", "gray"];

        const TextInput
            = ["off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off",
            "off", "off", "off", "off", "off", "off"];

        const TextRelayS
            = ["gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray", "gray",
            "gray", "gray", "gray", "gray", "gray", "gray"];

        const TextInputS
            = ["close", "close", "gas", "lock", "door1", "door2", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off", "off"];

        deviceModel = device.dModel;
        if (device.dModel === "SECTIONNER") {
            LoadChartBox(sensors["ACVOLTAGE"], "ACVOLTAGE", "acv", 6, 1, 15, 15, 15, 22, 22, 22, device.dLocalDateTime, 4, 2);
            LoadChartBox(sensors["ACAMPERE"], "ACAMPERE", "aca", 3, 1, 0, 20, 20, 250, 250, 250, device.dLocalDateTime, 4, 2);
            LoadChartBox(sensors["COSQ"], "COSQ", "cosq", 3, 1, 0, 0, 0, 1, 1, 1, device.dLocalDateTime, 1, 2);

            LoadChartBox(sensors["DIGITALEXIST"], "Power", "power", 4, 1, 0, 0, 0, 1000, 1000, 1000, device.dLocalDateTime, 4, 2);
            LoadChartBox(sensors["DIGITALOUTPUT"], "Reactive", "reactive", 4, 1, 0, 0, 0, 1000, 1000, 1000, device.dLocalDateTime, 4, 2);

            LoadDigitalState(sensors["DIGITALINPUT"], "digital-in", TextInputS, 1, 5, device.dModel);
            LoadTemHum(sensors["HUMIDITY"], "HUMIDITY", "hum", 1, "%");
            LoadTemHum(sensors["TEMPERATURE"], "TEMPERATURE", "tem", 1, "℃");
            LoadDeviceStatus(device);
        }
        else {
            LoadChartBox(sensors["ACVOLTAGE"], "ACVOLTAGE", "acv", 6, 4, 0, 140, 140, 250, 241, 241, device.dLocalDateTime, 4, 2);
            LoadChartBox(sensors["ACAMPERE"], "ACAMPERE", "aca", 8, 4, 0, 20, 20, 750, 750, 250, device.dLocalDateTime, 4, 2);
            LoadChartBox(sensors["COSQ"], "COSQ", "cosq", 3, 1, 0, 0, 0, 1, 1, 1, device.dLocalDateTime, 1, 2);

            LoadSwitchBox(sensors["RELAY"], "relay", TextRelay, 4, 8, device.dModel, editRelays);
            LoadSwitchBox(sensors["DIGITALINPUT"], "digital-in", TextInput, 4, 8, device.dModel);
            LoadTemHum(sensors["HUMIDITY"], "HUMIDITY", "hum", 2, "%");
            LoadTemHum(sensors["TEMPERATURE"], "TEMPERATURE", "tem", 2, "℃");
            LoadDeviceStatus(device);
            LoadDeviceStatus2(device);
        }
    }
    else {
        $("#device-errors", 0, 0, false, false).text("هیچ اطلاعات جدیدی از دستگاه نرسیده است");
    }
    deviceModel = device.dModel;
    if (device.dModel === "SECTIONNER") {
        LoadDeviceStatus(device);
    }
    else {
        LoadDeviceStatus(device);
        LoadDeviceStatus2(device);
    }
}

/**
 * @return {Array}
 */
function GenerateRangeArray(MinValue, MaxValue, RangeNumbers) {
    var rangeArray = [];
    var rangeValue = MaxValue - MinValue;
    var rangeNumbers = (rangeValue) / RangeNumbers;
    for (var i = 0; i < rangeNumbers; i++) {
        rangeArray.push({
            startValue: Math.floor(rangeValue * i + MinValue),
            endValue: Math.floor(Math.min(rangeValue * (i + 1) + MinValue, MaxValue)),
            style: {fill: '#4bb648', stroke: '#4bb648'},
            endWidth: 5,
            startWidth: 1
        });
    }

    return rangeArray;
}

function ReplaceClass(Item, NewClassList) {
    var oldClass = Item.attr('class');
    if (oldClass !== NewClassList) {
        Item.removeClass();
        Item.addClass(NewClassList);
    }
}

function RandomFloat(MinParam, MaxParam) {
    return Math.floor(Math.random() * (MaxParam - MinParam + 1) + MinParam);
}

function printFloatWithLeadingZeros(num, leadingZeros = 4, precision = 2) {
    var decimalSeperator = ".";
    var adjustedLeadingZeros = leadingZeros + decimalSeperator.length + precision;
    num = parseFloat(num).toFixed(precision);
    var numStr = "" + num + "";
    while (numStr.length < adjustedLeadingZeros) {
        numStr = "0" + numStr;
    }
    // pattern = "%0{"+adjustedLeadingZeros+"}{"+decimalSeperator+"}{"+precision+"}f";
    return numStr;
}

function CreateDigitalNumber(NumberValue, Prefix, index, numberIndex, numberColorStyle) {
    var numberDiv = $("#" + Prefix + "-" + index + "-" + numberIndex);
    var numberTop = $("#" + Prefix + "-" + index + "-" + numberIndex + "-top");
    var numberTopRight = $("#" + Prefix + "-" + index + "-" + numberIndex + "-top-right");
    var numberTopLeft = $("#" + Prefix + "-" + index + "-" + numberIndex + "-top-left");
    var numberMiddle = $("#" + Prefix + "-" + index + "-" + numberIndex + "-middle");
    var numberButtonRight = $("#" + Prefix + "-" + index + "-" + numberIndex + "-bottom-right");
    var numberButtonLeft = $("#" + Prefix + "-" + index + "-" + numberIndex + "-bottom-left");
    var numberButton = $("#" + Prefix + "-" + index + "-" + numberIndex + "-bottom");

    ReplaceClass(numberDiv, "number " + NumberValue);
    ReplaceClass(numberTop, "section top top-" + numberColorStyle);
    ReplaceClass(numberTopRight, "section top-right top-right-" + numberColorStyle);
    ReplaceClass(numberTopLeft, "section top-left top-left-" + numberColorStyle);
    ReplaceClass(numberMiddle, "middle middle-" + numberColorStyle);
    ReplaceClass(numberButtonRight, "section bottom-right bottom-right-" + numberColorStyle);
    ReplaceClass(numberButtonLeft, "section bottom-left bottom-left-" + numberColorStyle);
    ReplaceClass(numberButton, "section bottom bottom-" + numberColorStyle);
}

function AddErrorRow(LocalTime, ErrorText) {
    $("#device-errors-list").append('<div id="device-errors-row" class="Row"><div id="error-date-time" class="Cell">' + LocalTime + '</div><div id="error-description" class="Cell">' + ErrorText + '</div></div>');
}

/**
 * @param sensors
 * @param SensorType
 * @param Prefix
 * @param Rows
 * @param Cols
 * @param Minimum
 * @param Minimum1
 * @param Minimum2
 * @param Maximum
 * @param Maximum1
 * @param Maximum2
 *
 * @param LocalTime
 * @param LeadingZeros
 * @param Precision
 */
function LoadChartBox(sensors, SensorType, Prefix, Rows, Cols, Minimum, Minimum1, Minimum2, Maximum, Maximum1, Maximum2, LocalTime, LeadingZeros = 4, Precision = 2) {
    var sensorsCount = 0;
    if ($.isArray(sensors)) {
        sensorsCount = sensors.length;
    }
    if (sensorsCount > 0) {
        const LabelsVoltage = ["VR", "VS", "VT", "VR1", "VS1", "VT1", "VR2", "VS2", "VT2", "VR3", "VS3", "VT3", "VR4", "VS4", "VT4", "VR5", "VS5", "VT5", "VR6", "VS6", "VT6", "VRL", "VSL", "VTL", "VR11", "VS11", "VT11", "VR22", "VS22", "VT22", "VR33", "VS33", "VT33"];
        const LabelsAmpere = ["IR", "IS", "IT", "IN", "IR1", "IS1", "IT1", "IN1", "IR2", "IS2", "IT2", "IN2", "IR3", "IS3", "IT3", "IN3", "IR4", "IS4", "IT4", "IN4", "IR5", "IS5", "IT5", "IN5", "IR6", "IS6", "IT6", "IN6", "IRL", "ISL", "ITL", "INL"];
        const LabelsCosq = ["CosR", "CosS", "CosT"];
        const LabelsFuse = ["fuR", "fuS", "fuT", "fuR1", "fuS1", "fuT1", "fuR2", "fuS2", "fuT2", "fuR3", "fuS3", "fuT3", "fuR4", "fuS4", "fuT4", "fuR5", "fuS5", "fuT5", "fuR6", "fuS6", "fuT6", "fuRL", "fuSL", "fuTL", "fuN", "fuN1", "fuN2", "fuN3", "fuN4", "fuN5", "fuN6", "fuNL"];

        var NumbersName = ["zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];

        var numberColorStyle = "gray";
        var fuseColorStyle = "gray";
        var sensorValue = printFloatWithLeadingZeros(0, LeadingZeros, Precision);
        var sensorValueInt = 0;
        var sensorsValue = [0, 0, 0];

        var index = 0;
        var index2 = 0;
        for (var i = 0; i < Cols; i++) {
            // Add new data to data set
            sensorChart['' + Prefix + i + ''].data.labels.push(LocalTime);

            for (var j = 0; j < Rows; j++) {
                index = ((i * Rows) + (j + 1));
                index2 = index - 1;
                numberColorStyle = "gray";
                fuseColorStyle = "gray";
                sensorValue = printFloatWithLeadingZeros(0, LeadingZeros, Precision);
                sensorValueInt = 0;
                if (sensorsCount >= index) {
                    numberColorStyle = "green";
                    if (sensors[index2] < Minimum) {
                        sensors[index2] = 0;
                        numberColorStyle = "green";
                    }
                    else {
                        if (SensorType === "ACVOLTAGE") {
                            fuseColorStyle = "lightgreen";
                            if (sensors[index2] < Minimum1) {
                                numberColorStyle = "red";
                                var index3 = index2 % 3;
                                if (deviceModel === "MANAGER") {
                                    if (index2 < 3) {
                                        fuseColorStyle = "indianred";
                                        AddErrorRow(LocalTime, 'Fuse OFF (' + LabelsFuse[index2] + ')');
                                    }
                                    else if (sensors[index3] > Minimum1) {
                                        fuseColorStyle = "indianred";
                                        AddErrorRow(LocalTime, 'Fuse OFF (' + LabelsFuse[index2] + ')');
                                    }
                                }
                                sensors[index2] = 0;
                                AddErrorRow(LocalTime, 'Low voltage (' + LabelsVoltage[index2] + ')');
                            }
                            if (sensors[index2] > Maximum1) {
                                sensors[index2] = Maximum1;
                            }
                        }
                        else if (SensorType === "ACAMPERE") {
                            var highAmpere = (index2 < 3) ? Maximum1 : Maximum2;
                            if (sensors[index2] > highAmpere) {
                                numberColorStyle = "red";
                                AddErrorRow(LocalTime, 'Over Current (' + LabelsAmpere[index2] + ')');
                            }
                        }
                        else if (SensorType === "COSQ") {
                            if (sensors[index2] <= 0) {
                                sensors[index2] = CosQBack[index2];
                            }
                            else {
                                CosQBack[index2] = sensors[index2];
                            }
                        }
                    }
                    sensorValue = printFloatWithLeadingZeros(sensors[index2], LeadingZeros, Precision);
                    sensorValueInt = parseFloat(sensors[index2]).toFixed(2);
                    sensorsValue[index % 3] = sensorValueInt;
                }
                if (SensorType === "ACVOLTAGE") {
                    $('#' + LabelsFuse[index2]).css('background-color', fuseColorStyle);
                }
                if (sensorsCount >= index && SensorType === "ACVOLTAGE" && deviceModel === "MANAGER" && index > 3 && index % 3 === 0) {
                    if ((sensors[0] > Minimum1 && sensors[1] > Minimum1 && sensors[2] > Minimum1) && (sensors[index - 1] < Minimum1 && sensors[index - 2] < Minimum1 && sensors[index - 3] < Minimum1)) {

                        // alert(index);

                        sensorValue = printFloatWithLeadingZeros(0, LeadingZeros, Precision);
                        sensorValueInt = parseFloat(0).toFixed(2);
                        numberColorStyle = "yellow";
                        fuseColorStyle = "yellow";
                        numberIndex = 1;
                        for (k = 0; k < LeadingZeros; k++) {
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index, numberIndex, numberColorStyle);
                            numberIndex++;
                        }
                        ReplaceClass($("#" + Prefix + "-" + index + "-" + "dot"), "number dots dots-" + numberColorStyle);
                        for (k = 0; k < Precision; k++) {
                            numberIndex++;
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index, numberIndex, numberColorStyle);
                        }
                        $('#' + LabelsFuse[index - 1]).css('background-color', fuseColorStyle);

                        numberIndex = 1;
                        for (k = 0; k < LeadingZeros; k++) {
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index - 1, numberIndex, numberColorStyle);
                            numberIndex++;
                        }
                        ReplaceClass($("#" + Prefix + "-" + (index - 1) + "-" + "dot"), "number dots dots-" + numberColorStyle);
                        for (k = 0; k < Precision; k++) {
                            numberIndex++;
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index - 1, numberIndex, numberColorStyle);
                        }
                        $('#' + LabelsFuse[index - 2]).css('background-color', fuseColorStyle);

                        numberIndex = 1;
                        for (k = 0; k < LeadingZeros; k++) {
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index - 2, numberIndex, numberColorStyle);
                            numberIndex++;
                        }
                        ReplaceClass($("#" + Prefix + "-" + (index - 2) + "-" + "dot"), "number dots dots-" + numberColorStyle);
                        for (k = 0; k < Precision; k++) {
                            numberIndex++;
                            CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index - 2, numberIndex, numberColorStyle);
                        }
                        $('#' + LabelsFuse[index - 3]).css('background-color', fuseColorStyle);
                    }
                }
                else {
                    var numberIndex = 1;
                    for (var k = 0; k < LeadingZeros; k++) {
                        CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index, numberIndex, numberColorStyle);
                        numberIndex++;
                    }
                    ReplaceClass($("#" + Prefix + "-" + index + "-" + "dot"), "number dots dots-" + numberColorStyle);
                    for (k = 0; k < Precision; k++) {
                        numberIndex++;
                        CreateDigitalNumber(NumbersName[parseInt(sensorValue.charAt(numberIndex - 1))], Prefix, index, numberIndex, numberColorStyle);
                    }
                }

                sensorChart['' + Prefix + i + ''].data.datasets[j].data.push(sensorValueInt);
                if (sensorChart['' + Prefix + i + ''].data.labels.length > 60) {
                    sensorChart['' + Prefix + i + ''].data.labels.splice(-(sensorChart['' + Prefix + i + ''].data.labels.length), 1); // remove the label first
                    sensorChart['' + Prefix + i + ''].data.datasets.forEach(function (dataset, datasetIndex) {
                        dataset.data.splice(0, 1);
                    });
                }
                window.sensorChart['' + Prefix + i + ''].update();
            }
        }
    }
}

/**
 * @param sensors
 * @param Prefix
 * @param TextList
 * @param Rows
 * @param Cols
 * @param DeviceModel
 * @param IsInEdit
 */
function LoadSwitchBox(sensors, Prefix, TextList, Rows, Cols, DeviceModel, IsInEdit = false) {
    if (IsInEdit === false) {
        var sensorsCount = 0;
        if ($.isArray(sensors)) {
            sensorsCount = sensors.length;
        }
        if (sensorsCount > 0) {
            var numberColorStyle = "-gray";
            var sensorValue = false;

            for (var i = 0; i < Cols; i++) {

                for (var j = 0; j < Rows; j++) {
                    var index = ((j * Cols) + (i + 1));

                    numberColorStyle = "-gray";
                    sensorValue = "";
                    if (sensorsCount >= index) {
                        sensorValue = sensors[index - 1] > 0;
                        //if(DeviceModel == "SECTIONNER")
                        {
                            numberColorStyle = "-" + TextList[index - 1];
                        }
                    }
                    $("#" + Prefix + "-" + index).prop("checked", sensorValue);

                    SetRelayStyle(Prefix + "-" + index, numberColorStyle);
                }
            }
        }
    }
}

function SetRelayStyle(RelayName, NumberColorStyle) {
    var oldClass = $("#onoffswitch-" + RelayName).attr('class');
    if (oldClass != "onoffswitch" + NumberColorStyle) {
        ReplaceClass($("#onoffswitch-" + RelayName), "onoffswitch" + NumberColorStyle);
        ReplaceClass($("#" + RelayName), "onoffswitch-checkbox" + NumberColorStyle);
        ReplaceClass($("#onoffswitch-label-" + RelayName), "onoffswitch-label" + NumberColorStyle);
        ReplaceClass($("#onoffswitch-inner-" + RelayName), "onoffswitch-inner" + NumberColorStyle);
        ReplaceClass($("#onoffswitch-switch-" + RelayName), "onoffswitch-switch" + NumberColorStyle);
    }
}


function CheckRelayStatus() {
    sectionnerState = digitalInputGauge['device-' + Prefix + '-01'].jqxGauge('value');
    gasOK = digitalInputGauge['device-' + Prefix + '-02'].jqxGauge('value');
    lockState = digitalInputGauge['device-' + Prefix + '-03'].jqxGauge('value');

    var sensorValue = false;

    for (var i = 0; i < Cols; i++) {

        for (var j = 0; j < Rows; j++) {
            var index = ((j * Cols) + (i + 1));

            numberColorStyle = "-gray";
            sensorValue = "";
            if (sensorsCount >= index) {
                sensorValue = sensors[index - 1] > 0;
                //if(DeviceModel == "SECTIONNER")
                {
                    numberColorStyle = "-" + TextList[index - 1];
                }
            }
            $("#" + Prefix + "-" + index).prop("checked", sensorValue);

            var oldClass = $("#onoffswitch-" + Prefix + "-" + index).attr('class');
            if (oldClass != "onoffswitch" + numberColorStyle) {
                ReplaceClass($("#onoffswitch-" + Prefix + "-" + index), "onoffswitch" + numberColorStyle);
                ReplaceClass($("#" + Prefix + "-" + index), "onoffswitch-checkbox" + numberColorStyle);
                ReplaceClass($("#onoffswitch-label-" + Prefix + "-" + index), "onoffswitch-label" + numberColorStyle);
                ReplaceClass($("#onoffswitch-inner-" + Prefix + "-" + index), "onoffswitch-inner" + numberColorStyle);
                ReplaceClass($("#onoffswitch-switch-" + Prefix + "-" + index), "onoffswitch-switch" + numberColorStyle);
            }
        }
    }
}

/**
 * @param sensors
 * @param Prefix
 * @param TextList
 * @param Rows
 * @param Cols
 * @param DeviceModel
 * @param IsInEdit
 */
function LoadDigitalState(sensors, Prefix, TextList, Rows, Cols, DeviceModel, IsInEdit = false) {
    var sensorsCount = 0;
    if ($.isArray(sensors)) {
        sensorsCount = sensors.length;
    }
    if (sensorsCount > 0) {
        sectionnerState = 1; // Un normal
        if (sensorsCount > 0) {
            if (sensors[0] === 1) {
                sectionnerState = 2;
            }
            if (sensorsCount > 1) {
                if (sensors[1] === sensors[0]) {
                    sectionnerState = 1;
                }
                else if (sensors[1] > sensors[0]) {
                    sectionnerState = 0;
                }
            }
        }
        digitalInputGauge['device-' + Prefix + '-01'].jqxGauge('value', sectionnerState);

        gasOK = 0; // Un normal
        if (sensorsCount > 2) {
            if (sensors[2] === 1) {
                gasOK = 0;
            }
            else {
                gasOK = 100;
            }
        }
        digitalInputGauge['device-' + Prefix + '-02'].jqxGauge('value', gasOK);

        lockState = 1; // Un normal
        if (sensorsCount > 3) {
            if (sensors[3] === 1) {
                lockState = 2;
            }
            else {
                lockState = 0;
            }
        }
        digitalInputGauge['device-' + Prefix + '-03'].jqxGauge('value', lockState);

        door1State = 1; // Un normal
        if (sensorsCount > 4) {
            if (sensors[4] === 1) {
                door1State = 0;
            }
            else {
                door1State = 2;
            }
        }
        digitalInputGauge['device-' + Prefix + '-04'].jqxGauge('value', door1State);

        /*door2State = 1; // Un normal
         if (sensorsCount > 5) {
         if (sensors[5] == 1) {
         door2State = 0;
         }
         else {
         door2State = 2;
         }
         }
         digitalInputGauge['device-' + Prefix + '-05'].jqxGauge('value', door2State);*/
    }
}

/**
 * @param device
 *
 */
function LoadDeviceStatus(device) {
    $("#device-image").attr('src', 'images/device/' + device._dImage + '?x=' + Math.random());
    $("#device-status").text(device.dErr.eType);
    $("#device-serial-number").text(device.dSerialNumber);
    $("#device-model").text(device.dModel);
    $("#device-nike-name").text(device.dNikeName);
    $("#device-date-time").text(device.dLocalDateTime);
    $("#device-location").text(device.dLocation);
    $("#device-city").text(device.dCity);
    $("#device-ip").text(device.dIP.ip1 + "." + device.dIP.ip2 + "." + device.dIP.ip3 + "." + device.dIP.ip4 + ":" + device.dPort);
    $("#device-sampling").text(device.dSamplingTime);
    $("#device-sms").text(device.dSmsTerm);
    deviceLatLng = {lat: device.dGPS.gX, lng: device.dGPS.gY};
    device_marker.setPosition(deviceLatLng);
    map_device.setCenter(deviceLatLng);
    google.maps.event.trigger(map_device, 'resize');
}

/**
 * @param device
 *
 */
function LoadDeviceStatus2(device) {
    $("#device-camera-ip").text(device.dCamera.cIP.ip1 + "." + device.dCamera.cIP.ip2 + "." + device.dCamera.cIP.ip3 + "." + device.dCamera.cIP.ip4 + ":" + device.dCamera.cPort);
    $("#device-pok").text(device.dPOK);
    if (device.dPOK < device.dPTotal) {
        $("#device-ptotal-box").css("background-color", "red");
    }
    else {
        $("#device-ptotal-box").css("background-color", "transparent");
    }
    $("#device-ptotal").text(parseFloat(device.dPTotal).toFixed(2));
    $("#device-power").text(parseFloat(device.dTransPower).toFixed(2));
    $("#device-capacity").val(parseFloat(device.dTableCapacity));
    $("#device-pr").text(parseFloat(device.dPR).toFixed(2));
    $("#device-ps").text(parseFloat(device.dPS).toFixed(2));
    $("#device-pt").text(parseFloat(device.dPT).toFixed(2));
    $("#device-reactive").text(parseFloat(device.dQR + device.dQS + device.dQT).toFixed(2));
    $("#device-qr").text(parseFloat(device.dQR).toFixed(2));
    $("#device-qs").text(parseFloat(device.dQS).toFixed(2));
    $("#device-qt").text(parseFloat(device.dQT).toFixed(2));
}

/**
 * @param sensors
 * @param SensorType
 * @param Prefix
 * @param Rows
 * @param Symbol
 */
function LoadTemHum(sensors, SensorType, Prefix, Rows, Symbol) {
    var sensorsCount = 0;
    if ($.isArray(sensors)) {
        sensorsCount = sensors.length;
    }
    for (var i = 0; i < Rows; i++) {
        var sensorValue = 0;
        if (sensorsCount > i) {
            sensorValue = sensors[i];
        }
        if (SensorType === "HUMIDITY") {
            humidity['device-' + Prefix + '-' + i].jqxGauge('value', sensorValue);
        }
        else {
            temperatures['device-' + Prefix + '-' + i].jqxLinearGauge('value', sensorValue);
        }
        $('#device-' + Prefix + '-value' + i).text(sensorValue + Symbol);
    }
}

function GetDevicePictureParts(Result) {
    if (Result.pictureSize > 0) {
        UpdateProgressStatus(0, "دریافت بخشهای تصویر ...");
        var partsNumber = Result.pSize / Result.pPartSize;
        partsNumber = Math.ceil(partsNumber);
        partsNumber = Math.round(partsNumber);
        var partIndex = 1;
        var tryCounter = 0;
        if (partIndex <= Result.ppNumbers) {
            var Text = "Part " + partIndex + " of " + partsNumber;
            UpdateProgressStatus((100 * (partIndex) / partsNumber), Text);
            $.when(GetPart(partIndex, Result.ppNumbers, partsNumber, tryCounter)).done(function (result) {
            });
        }
    }
    else {
        ShowAlert("پیام", "خطا در گرفتن عکس بوسیله دستگاه");
        progressStatus.hide();
        progressBarDiv.hide();
        $("#device-load-image").text('بارگذاری تصویر');
        UpdateProgressStatus(0, "");
        loadImage = false;
    }
}

function GetPart(partIndex, picturePartNumbers, partsNumber, tryCounter) {
    return $.ajax({
        type: 'GET',
        url: 'requests.php',
        dataType: 'json',
        data: {
            'req': 'part',
            'ID': $.urlParam('ID'),
            'index': partIndex
        },
        success: function (result) {
            if (result === true) {
                partIndex++;
                tryCounter = 0;
                if (partIndex <= picturePartNumbers) {
                    var Text = "Part " + partIndex + " of " + partsNumber;
                    UpdateProgressStatus((100 * (partIndex) / partsNumber), Text);
                    $("#device-last-image").attr('src', 'images/device/' + $("#device-serial-number").text() + userName + '.gif?x=' + Math.random());
                    return GetPart(partIndex, picturePartNumbers, partsNumber, tryCounter);
                }
                else {
                    $("#device-last-image").attr('src', 'images/device/' + $("#device-serial-number").text() + userName + '.gif?x=' + Math.random());
                    ShowAlert("پیام", "تصویر جدید دستگاه با موفقیت دریافت شد");
                    progressStatus.hide();
                    progressBarDiv.hide();
                    $("#device-load-image").text('بارگذاری تصویر');
                    loadImage = false;
                }
            }
            else if (tryCounter < 5) {
                tryCounter++;
                return GetPart(partIndex, picturePartNumbers, partsNumber, tryCounter);
            }
            else {
                ShowAlert("پیام", "خطا در دریافت بخش های تصویر");
                progressStatus.hide();
                progressBarDiv.hide();
                $("#device-load-image").text('بارگذاری تصویر');
                $("#device-last-image").attr('src', 'images/device/' + $("#device-serial-number").text() + userName + '.gif?x=' + Math.random());
                UpdateProgressStatus(0, "");
                loadImage = false;

                return false;
            }
        },
        error: function (result) {
            ShowAlert("پیام", "خطا در دریافت بخش های تصویر");
            progressStatus.hide();
            progressBarDiv.hide();
            $("#device-load-image").text('بارگذاری تصویر');
            $("#device-last-image").attr('src', 'images/device/' + $("#device-serial-number").text() + userName + '.gif?x=' + Math.random());
            UpdateProgressStatus(0, "");
            loadImage = false;
            return false;
        },
        timeout: 60000
    });
}

function UpdateProgressStatus(Value, Text) {
    progressBar.jqxProgressBar({
        value: Value
    });
    progressText.text(Text);
}