/**
 * Created by Mohammad on 31/01/2016.
 */

/**
 *
 * @param UsersList
 */
function RefreshUserList(UsersList) {
	$("#users-list").html('');
	var usersCount = 0;
	if ($.isArray(UsersList.ulUsers)) {
		usersCount = UsersList.ulUsers.length;
	}
	if (usersCount > 0) {
		var userList = '<div class="Table">' +
			'<!-- Device Information -->' +
			'<div class="Heading">' +
			'<div class="Cell">' +
			'ردیف' +
			'</div>' +
			'<div class="Cell">' +
			'نام ک' +
			'اربری</div>' +
			'<div class="Cell">' +
			'نام' +
			'</div>' +
			'<div class="Cell">' +
			'نام خ' +
			'انوادگی</div>' +
			'<div class="Cell">' +
			'نقش' +
			'</div>' +
			'<div class="Cell">' +
			'تصویر' +
			'</div>' +
			'<div class="Cell">' +
			'عملیات' +
			'</div>' +
			'</div>';
		var newIndex = 1;
		$.each(UsersList.ulUsers, function (index, user) {
				if (user.uName != "admin" && user.uName != "administrator") {
					userList += '<div class="Row" id="user-' + user.uId + '">' +
						'<input type="hidden"  id="user-id-' + user.uId + '" value="' + user.uId + '">' +
						'<div class="Cell">' +
						newIndex + '' +
						'</div>' +
						'<div class="Cell">' +
						user.uName + '' +
						'</div>' +
						'<div class="Cell">' +
						user.uFirstName + '' +
						'</div>' +
						'<div class="Cell">' +
						user.uLastName + '' +
						'</div>' +
						'<div class="Cell">' +
						user.uType + '' +
						'</div>' +
						'<div class="Cell">' +
						'</div>' +
						'<div class="Cell">' +
						'<div data-popup-open-edit-' + user.uId + '="popup-1" id="edit-' + user.uId + '" class="edit_delete">' +
						'<img src="images/edit/edit.png" style="width:20px;height:20px;" alt="ویرایش کاربر ' + user.uName + '"' +
						'title="ویرایش کاربر ' + user.uName + '">' +
						'</div>' +
						'<div id="delete-' + user.uId + '" class="edit_delete">' +
						'<img src="images/edit/delete.png" style="width:20px;height:20px;" alt="حذف کاربر ' + user.uName + '"' +
						'title="حذف کاربر ' + user.uName + '">' +
						'</div>' +
						'</div>' +
						'</div>';
					$('body').on('click', "#edit-" + user.uId, function (e) {
						userID                   = user.uId;
						//----- OPEN
						var targeted_popup_class = jQuery(this).attr("data-popup-open-edit-" + user.uId);
						$("[data-popup='" + targeted_popup_class + "']").fadeIn(350);
						e.preventDefault();
						
						userID = user.uId;
						ShowLoadingImage("popup-loading", e);
						$("#username-text").prop("disabled", true);
						
						$("#username-text").val(user.uName);
						$("#user-first-name-text").val(user.uFirstName);
						$("#user-last-name-text").val(user.uLastName);
						$("#user-password-text").val("");
						$("#user-repassword-text").val("");
						$("#user-type").val(user.uType);
						
						// Send to server
						$.ajax({
							type    : "GET",
							url     : "requests.php",
							dataType: "json",
							data    : {
								"req"     : "getuserdevice",
								"userID"  : user.uId,
								"userName": user.uName
							},
							//Device
							success : function (result) {
								LoadDevicesList(result);
								// Finish loading icon
								HideLoadingImage("popup-loading", e);
							},
							error   : function () {
								ShowAlert("پیام", "خطا درد دربافت فهرست کاربران: \n");
								// Finish loading icon
								HideLoadingImage("popup-loading", e);
							},
							timeout : 45000
						});
					});
					$('body').on('click', "#delete-" + user.uId, function (e) {
						userID = user.uId;
						ShowLoadingImage("popup-loading", e);
						
						// Send to server
						$.ajax({
							type    : 'GET',
							url     : 'requests.php',
							dataType: 'json',
							data    : {
								'req'     : 'deleteuser',
								'userID'  : userID,
								'userName': user.uName
							},
							//Device
							success : function (result) {
								// Send to server
								$.ajax({
									type    : 'GET',
									url     : 'requests.php',
									dataType: 'json',
									data    : {
										'req': 'getusers'
									},
									//Device
									success : function (result) {
										RefreshUserList(result);
										// Finish loading icon
										HideLoadingImage("popup-loading", e);
									},
									error   : function () {
										ShowAlert("پیام", "خطا در دریافت فهرست کاربران: \n");
										// Finish loading icon
										HideLoadingImage("popup-loading", e);
									},
									timeout : 45000
								});
							},
							error   : function () {
								ShowAlert("پیام", "خطا در حذف کاربر: \n");
								// Finish loading icon
								HideLoadingImage("popup-loading", e);
							},
							timeout : 45000
						});
					});
					newIndex++;
				}
			}
		);
		userList += '</div>';
		$("#users-list").append(userList);
	}
	else {
		$("#users-list").append('کاربری یافت نشد');
	}
}

/**
 *
 * @param DevicesList
 */
function LoadDevicesList(DevicesList) {
	$("#devices-list").html('');
	var deviceCount = 0;
	if ($.isArray(DevicesList)) {
		deviceCount = DevicesList.length;
	}
	if (deviceCount > 0) {
		var deviceList = '<div class="Table" id="device-list">' +
			'<!-- Device Information -->' +
			'<div class="Heading">' +
			'<div class="Cell">' +
			'<input type="checkbox" id="select-all" value="0">' +
			'</div>' +
			'<div class="Cell">' +
			'ردیف' +
			'</div>' +
			'<div class="Cell">' +
			'شماره دستگاه' +
			'</div>' +
			'<div class="Cell">' +
			'نام دستگاه' +
			'</div>' +
			'<div class="Cell">' +
			'شهر دستگاه' +
			'</div>' +
			'<div class="Cell">' +
			'مکان دستگاه' +
			'</div>' +
			'</div>';
		var newIndex   = 1;
		$.each(DevicesList, function (index, device) {
			if (device.dSerialNumber > 0) {
				var checked = device.dUser > 0 ? 'checked' : '';
				deviceList += '<div class="Row" id="device-' + device.dSerialNumber + '">' +
					'<input type="hidden"  id="device-id-' + device.dSerialNumber + '" value="' + device.dSerialNumber + '">' +
					'<div class="Cell">' +
					'<input type="checkbox" id="select-' + device.dSerialNumber + '" ' + checked + ' value="' + device.dSerialNumber + '">' +
					'</div>' +
					'<div class="Cell">' +
					newIndex + '' +
					'</div>' +
					'<div class="Cell">' +
					device.dSerialNumber + '' +
					'</div>' +
					'<div class="Cell">' +
					device.dNikeName + '' +
					'</div>' +
					'<div class="Cell">' +
					device.dCity + '' +
					'</div>' +
					'<div class="Cell">' +
					device.dLocation + '' +
					'</div>' +
					'</div>';
				newIndex++;
			}
		});
		deviceList += '</div>';
		$("#devices-list").append(deviceList);
	}
	else {
		$("#devices-list").append('کاربری یافت نشد');
	}
}
