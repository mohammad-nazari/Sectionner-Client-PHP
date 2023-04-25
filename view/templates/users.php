<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 26/07/2016
	 * Time: 11:22 AM
	 */
	
	require_once('control/definitions.php');
	require_once('control/persian_date/PCalendar.Class.php');
	require_once("control/DigitalClock.php");
	require_once('control/TempLoader.php');
	
	require_once('control/DeviceClass.php');
	
	//    $tempLoader->LoadUserButton();
?>
<div id="content" class="main_container">
	<?php
		//        $usersList = array(DefaultObjectsClass::NewUser("",""));
		//                var_dump($usersList);
	?>
    <div>
        <div id="refresh-users" style="float: right;padding: 20px 0 0 20px;align-items: center"><span
                    id="refresh-users-list" class="btn"><?php echo _("بازسازی فهرست کاربران") ?></span></div>
        <script>
            $(document).ready(function () {
                $("#refresh-users").click(function (e) {
                    ShowLoadingImage("popup-loading", e);

                    // Send to server
                    $.ajax({
                        type: 'GET',
                        url: 'requests.php',
                        dataType: 'json',
                        data: {
                            'req': 'getusers'
                        },
                        //Device
                        success: function (result) {
                            RefreshUserList(result);
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);
                        },
                        error: function () {
                            alert("Error in get users list: \n");
                            // Finish loading icon
                            HideLoadingImage("popup-loading", e);
                        },
                        timeout: 45000
                    });
                });
            });
        </script>

        <div data-popup-open-new="popup-1" id="add-user" style="float: right;padding: 20px 0 0 20px;align-items: center">
            <span id="add-new-user" class="btn"><?php echo _("ایجاد کاربر جدید") ?></span>
        </div>
    </div>
    <div id="users-list" style="width: 48%;margin: 60px 0 0 0;">
        <div class="Table">
            <!-- User Information -->
            <div class="Heading">
                <div class="Cell">
					<?php echo _("ردیف") ?>
                </div>
                <div class="Cell">
					<?php echo _("نام کاربری") ?>
                </div>
                <div class="Cell">
					<?php echo _("نام") ?>
                </div>
                <div class="Cell">
					<?php echo _("نام خانوادگی") ?>
                </div>
                <div class="Cell">
					<?php echo _("نقش") ?>
                </div>
                <div class="Cell">
					<?php echo _("تصویر") ?>
                </div>
                <div class="Cell">
					<?php echo _("عملیات") ?>
                </div>
            </div>
			<?php
				$newIndex = 1;
				foreach($usersList->ulUsers as $index => $user)
				{
					if($user->uName != "admin" and $user->uName != "administrator")
					{
						?>
                        <div class="Row" id="user-<?php echo $user->uId ?>">
                            <input type="hidden" id="user-id-<?php echo $user->uId ?>" value="<?php echo $user->uId ?>">
                            <div class="Cell">
								<?php echo $newIndex ?>
                            </div>
                            <div class="Cell">
								<?php echo $user->uName ?>
                            </div>
                            <div class="Cell">
								<?php echo $user->uFirstName ?>
                            </div>
                            <div class="Cell">
								<?php echo $user->uLastName ?>
                            </div>
                            <div class="Cell">
								<?php echo $user->uType ?>
                            </div>
                            <div class="Cell">
                            </div>
                            <div class="Cell">
                                <div data-popup-open-edit-<?php echo $user->uId ?>="popup-1"
                                     id="edit-<?php echo $user->uId ?>" class="edit_delete">
                                    <img src="images/edit/edit.png" style="width:20px;height:20px;"
                                         alt="<?php echo _('ویرایش کاربر') . ' ' . $user->uName ?>"
                                         title="<?php echo _('ویرایش کابر') . ' ' . $user->uName ?>">
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $("#edit-<?php echo $user->uId ?>").click(function (e) {
                                            userID = <?php echo $user->uId ?>;
                                            //----- OPEN
                                            var targeted_popup_class = jQuery(this).attr('data-popup-open-edit-<?php echo $user->uId ?>');
                                            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
                                            e.preventDefault();

                                            userID = <?php echo $user->uId ?>;
                                            ShowLoadingImage("popup-loading", e);
                                            $("#username-text").prop('disabled', true);

                                            $("#username-text").val('<?php echo $user->uName ?>');
                                            $("#user-first-name-text").val('<?php echo $user->uFirstName ?>');
                                            $("#user-last-name-text").val('<?php echo $user->uLastName ?>');
                                            $("#user-password-text").val('');
                                            $("#user-repassword-text").val('');
                                            $("#user-type").val('<?php echo $user->uType ?>');

                                            // Send to server
                                            $.ajax({
                                                type: 'GET',
                                                url: 'requests.php',
                                                dataType: 'json',
                                                data: {
                                                    'req': 'getuserdevice',
                                                    'userID': '<?php echo $user->uId ?>',
                                                    'userName': '<?php echo $user->uName ?>'
                                                },
                                                //Device
                                                success: function (result) {
                                                    LoadDevicesList(result);
                                                    // Finish loading icon
                                                    HideLoadingImage("popup-loading", e);
                                                },
                                                error: function () {
                                                    alert("Error in get users list: \n");
                                                    // Finish loading icon
                                                    HideLoadingImage("popup-loading", e);
                                                },
                                                timeout: 45000
                                            });
                                        });
                                    });
                                </script>
                                <div id="delete-<?php echo $user->uId ?>" class="edit_delete">
                                    <img src="images/edit/delete.png" style="width:20px;height:20px;"
                                         alt="<?php echo _('حذف کاربر') . ' ' . $user->uName ?>"
                                         title="<?php echo _('حذف کاربر') . ' ' . $user->uName ?>">
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $("#delete-<?php echo $user->uId ?>").click(function (e) {
                                            userID = <?php echo $user->uId ?>;
                                            ShowLoadingImage("popup-loading", e);

                                            // Send to server
                                            $.ajax({
                                                type: 'GET',
                                                url: 'requests.php',
                                                dataType: 'json',
                                                data: {
                                                    'req': 'deleteuser',
                                                    'userID': userID,
                                                    'userName': '<?php echo $user->uName ?>'
                                                },
                                                //Device
                                                success: function (result) {
                                                    // Send to server
                                                    $.ajax({
                                                        type: 'GET',
                                                        url: 'requests.php',
                                                        dataType: 'json',
                                                        data: {
                                                            'req': 'getusers'
                                                        },
                                                        //Device
                                                        success: function (result) {
                                                            RefreshUserList(result);
                                                            // Finish loading icon
                                                            HideLoadingImage("popup-loading", e);
                                                        },
                                                        error: function () {
                                                            alert("Error in get users list: \n");
                                                            // Finish loading icon
                                                            HideLoadingImage("popup-loading", e);
                                                        },
                                                        timeout: 45000
                                                    });
                                                },
                                                error: function () {
                                                    alert("Error in delete users: \n");
                                                    // Finish loading icon
                                                    HideLoadingImage("popup-loading", e);
                                                },
                                                timeout: 45000
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
						<?php
						$newIndex++;
					}
				}
			?>
        </div>
    </div>
</div>

<div class="popup" data-popup="popup-1">
    <div class="popup-inner">
        <div class="panel_div">
            <div class="Table">
                <!-- User Information -->
                <div class="Heading">
                    <div class="Cell">
						<?php echo _("ویژگی") ?>
                    </div>
                    <div class="Cell">
						<?php echo _("مقدار") ?>
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("نام کاربری") ?>
                    </div>
                    <div class="Cell">
                        <input type="text" id="username-text" value="">
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("پسورد") ?>
                    </div>
                    <div class="Cell">
                        <input type="password" id="user-password-text" value="">
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("پسورد مجدد") ?>
                    </div>
                    <div class="Cell">
                        <input type="password" id="user-repassword-text" value="">
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("نام") ?>
                    </div>
                    <div class="Cell">
                        <input type="text" id="user-first-name-text" value="">
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("نام خانوادگی") ?>
                    </div>
                    <div class="Cell">
                        <input type="text" id="user-last-name-text" value="">
                    </div>
                </div>
                <div class="Row">
                    <div class="Cell">
						<?php echo _("نقش") ?>
                    </div>
                    <div class="Cell">
                        <select id="user-type">
                            <option id="user-admin" value="<?php echo \webservice\UserType::Admin ?>"
                                    selected><?php echo \webservice\UserType::Admin ?></option>
                            <option id="user-control"
                                    value="<?php echo \webservice\UserType::Monitor ?>"><?php echo \webservice\UserType::Monitor ?></option>
                            <option id="user-monitor"
                                    value="<?php echo \webservice\UserType::Control ?>"><?php echo \webservice\UserType::Control ?></option>
                        </select>
                        <p>
                            <b>Admin</b>:
                            دسترسی به همه دستگاه ها و تغییر تنظیمات آنها
                        </p>
                        <p>
                            تعریف و تغییر و حذف کاربران
                        </p>
                        <p>
                            گزارش گیری
                        </p>
                        <p>
                            <b>Control</b>:
                            دسترسی به دستگاه های تعیین شده و تغییر تنظیمات آنها
                        </p>
                        <p>
                            گزارشگیری
                        </p>
                        <p>
                            <b>Monitor</b>:
                            دسترسی به دستگاه های تعیین شده بدون دسترسی به تغییر تنظیمات آنها
                        </p>
                    </div>
                </div>
            </div>
            <div id="devices-list" class="panel_div"></div>
            <div id="user-settings-submit" style="text-align: center;padding: inherit;"><span id="user-settings"
                                                                                              class="btn"><?php echo _("ثبت") ?></span>
            </div>
        </div>
        <p><a data-popup-close="popup-1" href="#"><?php echo _("بستن") ?></a></p>
        <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        //----- OPEN
        $('[data-popup-open-new]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-open-new');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
            e.preventDefault();

            userID = 0;
            ShowLoadingImage("popup-loading", e);
            $("#username-text").prop('disabled', false);

            $("#username-text").val('');
            $("#user-first-name-text").val('');
            $("#user-last-name-text").val('');
            $("#user-password-text").val('');
            $("#user-repassword-text").val('');
            $("#user-type").val('<?php echo \webservice\UserType::Admin?>');

            // Send to server
            $.ajax({
                type: 'GET',
                url: 'requests.php',
                dataType: 'json',
                data: {
                    'req': 'getuserdevice',
                    'userID': userID,
                    'userName': ''
                },
                //Device
                success: function (result) {
                    LoadDevicesList(result);
                    // Finish loading icon
                    HideLoadingImage("popup-loading", e);
                },
                error: function () {
                    alert("Error in get users list: \n");
                    // Finish loading icon
                    HideLoadingImage("popup-loading", e);
                },
                timeout: 45000
            });

        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
            e.preventDefault();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $("#user-settings-submit").click(function (e) {
            // Show loading icon
            ShowLoadingImage("popup-loading", e);

            var selectedDevices = [];
            $('#device-list input:checked').each(function () {
                if ($(this).attr("id") != "select-all") {
                    selectedDevices.push($(this).val());
                }
            });

            // Send to server
            $.ajax({
                type: 'GET',
                url: 'requests.php',
                dataType: 'json',
                data: {
                    'req': 'addedituser',
                    'userID': userID,
                    'username': $("#username-text").val(),
                    'user-password': $("#user-password-text").val(),
                    'user-repassword': $("#user-repassword-text").val(),
                    'user-first-name': $("#user-first-name-text").val(),
                    'user-last-name': $("#user-last-name-text").val(),
                    'user-type': $("#user-type").val(),
                    'device-list': selectedDevices
                },
                //Device
                success: function (result) {
                    if (ShowMessage(result, userID > 0 ? "مشخصات کاربر با موفقیت ویرایش گردید." : "کاربر جدیدبا موفقیت اضافه گردید.") == true) {
                    }
                    // Finish loading icon
                    HideLoadingImage("popup-loading", e);
                },
                error: function () {
                    alert("Error in editing/adding user: \n");
                    // Finish loading icon
                    HideLoadingImage("popup-loading", e);
                },
                timeout: 45000
            });
        });
    });
</script>
		