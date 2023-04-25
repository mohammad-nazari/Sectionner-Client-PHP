/**
 * Created by Mohammad on 31/01/2016.
 */
setInterval(function () {
    $.ajax({
        type: 'GET',
        url: 'requests.php',
        dataType: 'json',
        data: {'req': 'all'},
        success: function (result) {
            AddUpdateDeleteDevice(result);
        },
        error: function () {
            $("#device-errors").text("خطا در دریافت وضعیت دستگاه")
        },
        timeout: 10000
    });
}, 60000);


/// <summary>
/// Get device id from new device list
/// and search it in device thread list
/// and add to list and generate its thread
/// </summary>
/// <returns></returns>
function AddUpdateDeleteDevice(result) {
    AddUpdateDevice(result);
    RemoveDevice(result);
}

/// <summary>
/// Get device id from new device list
/// and search it in device thread list
/// and add to list and generate its thread
/// </summary>
/// <returns></returns>
function AddUpdateDevice(result) {
    if (isRealValue(result)) {
        let countSec = 0;
        let countSecOn = 0;
        let countMan = 0;
        let countManOn = 0;
        $.each(result, function (index, device) {
            if (isRealValue(device) && isRealValue(device.dSerialNumber)) {
                if (device.dModel == "SECTIONNER") {
                    countSec++;
                    if (device.dErr.eType != "Disable") {
                        countSecOn++;
                    }
                }
                else if (device.dModel == "MANAGER") {
                    countMan++;
                    if (device.dErr.eType != "Disable") {
                        countManOn++;
                    }
                }
                if ($("#device_" + device.dSerialNumber).length === 0) {
                    //it doesn't exist
                    // add device details to user explorer
                    tagData = '<li id = "device_' + device.dSerialNumber + '" data-row = "1" data-col = "1" data-sizex = "2" data-sizey = "1" class = "gs-w" style = "word-wrap: break-word;-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;position: absolute; min-width: 140px; min-height: 140px;padding: 1em;color:' + device._dLevelColor + ';" ><div style = "display: block;height: 40%;" ><div style = "display: block;width: 50%;float: left;height: 40%;" ><img id = "device-image_' + device.dSerialNumber + '" class = "device_picture" src = "images/device/' + device._dImage + '" /></div ><div id="device-serialnumber_' + device.dSerialNumber + '" class="Cell">' + device.dSerialNumber + '</div><div id = "device-status_' + device.dSerialNumber + '"	style = "font-size: 2em;padding: 10px 0 10px 90px;font-style: oblique; display: block;" >' + device.dErr.eType + '</div ></div ><div class="Table"><div class="Row" ><div class="Cell" >نام دستگاه: </div> <div id = "device-name_' + device.dSerialNumber + '" class="Cell" > ' + device.dNikeName + '</div> </div> <div class="Row" > <div class="Cell" > شهر دستگاه: </div >	<div id = "device-city_' + device.dSerialNumber + '" class="Cell" >' + device.dCity + '</div ></div ><div class="Row" ><div class="Cell">مکان دستگاه: </div><div id = "device-station_' + device.dSerialNumber + '" class="Cell" >' + device.dLocation + '</div></div></div><div id = "device-errors_' + device.dSerialNumber + '" style = "overflow-y: scroll; display: block;height: 20%;" > ' + device.dErr.eMsg + '</div><div id = "device-details_' + device.dSerialNumber + '" style = "display: block;height: 10%;"><a href = "index.php?Req=device&ID=' + device.dSerialNumber + '"	target = "_blank" > جزئیات </a></div></li>';
                    section = device.dModel === "SECTIONNER" ? "content1" : "content1";
                    AddDeviceGrid(tagData, section);
                }
                else {
                    //alert(device.dSerialNumber + " :: " + device._dImage);
                    // Update current information
                    if ($('#device-image_' + device.dSerialNumber).attr('src') !== 'images/device/' + device._dImage) {
                        $('#device-image_' + device.dSerialNumber).attr('src', 'images/device/' + device._dImage);
                    }
                    $('#device_' + device.dSerialNumber).css('color', device._dLevelColor);
                    $('#device-status_' + device.dSerialNumber).text(device.dErr.eType);
                    $('#device-name_' + device.dSerialNumber).text(device.dNikeName);
                    $('#device-city_' + device.dSerialNumber).text(device.dCity);
                    $('#device-station_' + device.dSerialNumber).text(device.dLocation);
                    $('#device-errors_' + device.dSerialNumber).text(device.dErr.eMsg);
                }
            }
        });
        $('#secAll').text(countSec);
        $('#secOn').text(countSecOn);
        $('#manAll').text(countMan);
        $('#manOn').text(countManOn);
    }
}

/// <summary>
/// Get device id from thread list
/// and search it in new devices list
/// and remove device if it not exist more
/// </summary>
/// <returns></returns>
function RemoveDevice(result) {
    var itExist = false;
    var deviceID = 0;
    var deviceIDList = '';
    // Check if device not exist in new list
    // Remove objects in GUI
    $("li[id^='device_']").each(function () {
        deviceID = this.id;
        deviceIDList += this.id;
        $.each(result, function (index, device) {
            // alert(deviceID + " ::: " + "device_" + device.dSerialNumber);
            if (deviceID == 'device_' + device.dSerialNumber) {
                itExist = true;
                return 1;
            }
        });
        if (itExist == false) {
            // Remove GUI for this Device
            RemoveDeviceGrid(deviceID);
        }
    });
}

function isRealValue(obj) {
    return obj && obj !== "null" && obj !== "undefined";
}