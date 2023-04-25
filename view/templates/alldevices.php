<?php
	/**
	 * Created by JetBrains PhpStorm.
	 * User: Mohammad
	 * Date: 8/15/13
	 * Time: 5:02 PM
	 * To change this template use File | Settings | File Templates.
	 */
	
	require_once('control/DeviceClass.php');
	
	if($result->udErr->eMsg)
	{
		?>
        <h2><?php echo _('Error:') ?> </h2>
        <pre><?php echo $result->udErr->eMsg ?></pre>
		<?php
	}
	else
	{
		if($result->udErr->eMsg)
		{
			?>
            <h2><?php echo _('Fault (Expect - The request contains an invalid SOAP body)') ?></h2>
			<?php
		}
		else
		{
			if($result->udErr->eMsg)
			{
				?>
                <h2><?php echo _('Error:') ?></h2>
                <pre><?php echo $result->udErr->eMsg ?></pre>
                <br>
				<?php
			}
			else
			{
				?>
                <style>
                    .sectionCSS {
                        display: none;
                        padding: 20px 0 0;
                        border-top: 1px solid #ddd;
                        direction: rtl;
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
                    #tab5:checked ~ #content5 {
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
                <script src="scripts/getalldevicestatus.js" type="text/javascript"></script>
                <div id="content" class="main_container">
                    <section class="demo">
                        <input class="inputCSS" id="tab1" type="radio" name="tabs">
                        <label class="labelCSS" for="tab1"><?php echo _("دستگاه های سکسیونر") ?></label>
                        <input class="inputCSS" id="tab2" type="radio" name="tabs">
                        <label class="labelCSS" for="tab2"><?php echo _("دستگاه های مدیریت بار") ?></label>
                        <div class="sectionCSS" id="content1">
                            <!--                            <div>-->
                            <!--                                <div class="Table">-->
                            <!--                                    <!-- Device Information -->-->
                            <!--                                    <div class="Heading">-->
                            <!--                                        <div class="Cell" style="background-color: inherit">-->
                            <!--					                        --><?php //echo _("تعداد کل سکسیونرهای نصب شده:")
							?>
                            <!--                                            <label id="secAll">--><?php // echo(is_object($result->udDevs) > 0?1:count($result->udDevs))
							?><!--</label>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="Cell" style="background-color: inherit">-->
                            <!--					                        --><?php //echo _("تعداد سکسیونرهای روشن: ")
							?>
                            <!--                                            <label id="secAll">--><?php // echo(is_object($result->udDevs) > 0?1:count($result->udDevs))
							?><!--</label>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="Cell" style="background-color: gray">-->
                            <!--		                                    --><?php //echo _("تعداد سکسیونر های خاموش: ")
							?>
                            <!--                                            <label id="secAll">--><?php // echo(is_object($result->udDevs) > 0?1:count($result->udDevs))
							?><!--</label>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="Cell" style="background-color: green">-->
                            <!--					                        --><?php //echo _("تعداد سکسیونر های نرمال: ")
							?>
                            <!--                                            <label id="secAll">--><?php // echo(is_object($result->udDevs) > 0?1:count($result->udDevs))
							?><!--</label>-->
                            <!--                                        </div>-->
                            <!--                                        <div class="Cell" style="background-color: red">-->
                            <!--					                        --><?php //echo _("تعداد سکسیونر های دارای خطا: ")
							?>
                            <!--                                            <label id="secAll">--><?php // echo(is_object($result->udDevs) > 0?1:count($result->udDevs))
							?><!--</label>-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                            <!--                            </div>-->
                            <div>
	                            <?php
		                            $count = 0;
		                            $countOn = 0;
		                            foreach($result->udDevs as $deviceObject)
		                            {
			                            if($deviceObject->dSerialNumber > 0 and $deviceObject->dModel != \webservice\DeviceModel::ALARM)
			                            {
				                            if($deviceObject->dModel == webservice\DeviceModel::SECTIONNER and $deviceObject->dSerialNumber > 0)
				                            {
					                            $count++;
					                            if($deviceObject->dErr->eType != \webservice\SettingLevel::Disable)
					                            {
						                            $countOn++;
					                            }
				                            }
			                            }
		                            }
	                            ?>
                                <div class="Table">
                                    <!-- Device Information -->
                                    <div class="Heading">
                                        <div class="Cell" style="background-color: inherit">
											<?php echo _("تعداد کل سکسیونرهای نصب شده:") ?>
                                            <label id="secAll"><?php echo($count) ?></label>
                                        </div>
                                        <div class="Cell" style="background-color: green">
		                                    <?php echo _("تعداد دستگاه های روشن:") ?>
                                            <label id="secOn"><?php echo($countOn) ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gridster ready">
                                <ul style="height: 480px; width: 960px; position: relative;">
									<?php
										//                                    $result = DefaultObjectsClass::GetAllDeviceStatus();
										if(is_array($result->udDevs) or is_object($result->udDevs) > 0)
										{
											?>
											<?php
											foreach($result->udDevs as $deviceObject)
											{
												if($deviceObject->dSerialNumber > 0 and $deviceObject->dModel != \webservice\DeviceModel::ALARM)
												{
													if($deviceObject->dModel == webservice\DeviceModel::SECTIONNER and $deviceObject->dSerialNumber > 0)
													{
														$device = new  DeviceClass();
														$device = ToolsClass::LoadFromParentObj($deviceObject, $device);
														$device->InitializeDevice();
														$device->DeleteSensorsList();
														?>
                                                        <li id="device_<?php echo $device->dSerialNumber ?>" data-row="1" data-col="1" data-sizex="2"
                                                            data-sizey="1" class="gs-w"
                                                            style="word-wrap: break-word;-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;position: absolute; min-width: 140px; min-height: 140px;padding: 1em;color: <?php echo $device->_dLevelColor ?>;">
                                                            <div style="display: block;height: 40%;">
                                                                <div style="display: block;width: 50%;float: left;height: 40%;">
                                                                    <img id="device-image_<?php echo $device->dSerialNumber ?>" class="device_picture"
                                                                         src="images/device/<?php echo $device->_dImage ?>"/>
                                                                </div>
                                                                <div id="device-serialnumber_<?php echo $device->dSerialNumber ?>"
                                                                     class="Cell">
																	<?php echo $device->dSerialNumber ?>
                                                                </div>
                                                                <div id="device-status_<?php echo $device->dSerialNumber ?>"
                                                                     style="font-size: 2em;padding: 10px 0 10px 90px;font-style: oblique; display: block;">
																	<?php echo $device->dErr->eType ?>
                                                                </div>
                                                            </div>
                                                            <div class="Table">
                                                                <!-- Device Information -->
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('نام دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-name_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dNikeName ?>
                                                                    </div>
                                                                </div>
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('شهر دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-city_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dCity ?>
                                                                    </div>
                                                                </div>
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('مکان دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-station_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dLocation ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="device-errors_<?php echo $device->dSerialNumber ?>"
                                                                 style="overflow-y: scroll; display: block;height: 20%;">
																<?php echo $device->dErr->eMsg ?>
                                                            </div>
                                                            <div id="device-details_<?php echo $device->dSerialNumber ?>"
                                                                 style="display: block;height: 10%;">
                                                                <a href="<?php echo DEVICEPAGE . "&ID=" . $device->dSerialNumber ?>"
                                                                   target="_blank">
																	<?php echo _('جزئیات') ?>
                                                                </a>
                                                            </div>
                                                        </li>
														<?php
													}
												}
											}
										}
									?>
                                </ul>
                            </div>
                        </div>
                        <div class="sectionCSS" id="content2">
                            <div>
                                <?php
		                            $count = 0;
		                            $countOn = 0;
		                            foreach($result->udDevs as $deviceObject)
		                            {
			                            if($deviceObject->dSerialNumber > 0 and $deviceObject->dModel != \webservice\DeviceModel::ALARM)
			                            {
				                            if($deviceObject->dModel == webservice\DeviceModel::MANAGER and $deviceObject->dSerialNumber > 0)
				                            {
					                            $count++;
					                            if($deviceObject->dErr->eType != \webservice\SettingLevel::Disable)
					                            {
						                            $countOn++;
					                            }
				                            }
			                            }
		                            }
	                            ?>
                                <div class="Table">
                                    <!-- Device Information -->
                                    <div class="Heading">
                                        <div class="Cell" style="background-color: inherit">
					                        <?php echo _("تعداد کل مدیریت بار نصب شده:") ?>
                                            <label id="manAll"><?php echo($count) ?></label>
                                        </div>
                                        <div class="Cell" style="background-color: green">
					                        <?php echo _("تعداد دستگاه های روشن:") ?>
                                            <label id="manOn"><?php echo($countOn) ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="gridster ready">
                                <ul style="height: 480px; width: 960px; position: relative;">
									<?php
										//                                    $result = DefaultObjectsClass::GetAllDeviceStatus();
										if(is_array($result->udDevs) or is_object($result->udDevs) > 0)
										{
											foreach($result->udDevs as $deviceObject)
											{
												if($deviceObject->dSerialNumber > 0 and $deviceObject->dModel != \webservice\DeviceModel::ALARM)
												{
													if($deviceObject->dModel == webservice\DeviceModel::MANAGER and $deviceObject->dSerialNumber > 0)
													{
														$device = new  DeviceClass();
														$device = ToolsClass::LoadFromParentObj($deviceObject, $device);
														$device->InitializeDevice();
														$device->DeleteSensorsList();
														?>
                                                        <li id="device_<?php echo $device->dSerialNumber ?>" data-row="1" data-col="1" data-sizex="2"
                                                            data-sizey="1" class="gs-w"
                                                            style="word-wrap: break-word;-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;position: absolute; min-width: 140px; min-height: 140px;padding: 1em;color: <?php echo $device->_dLevelColor ?>;">
                                                            <div style="display: block;height: 40%;">
                                                                <div style="display: block;width: 50%;float: left;height: 40%;">
                                                                    <img id="device-image_<?php echo $device->dSerialNumber ?>" class="device_picture"
                                                                    <img id="device-image_<?php echo $device->dSerialNumber ?>" class="device_picture"
                                                                         src="images/device/<?php echo $device->_dImage ?>"/>
                                                                </div>
                                                                <div id="device-serialnumber_<?php echo $device->dSerialNumber ?>"
                                                                     class="Cell">
																	<?php echo $device->dSerialNumber ?>
                                                                </div>
                                                                <div id="device-status_<?php echo $device->dSerialNumber ?>"
                                                                     style="font-size: 2em;padding: 10px 0 10px 90px;font-style: oblique; display: block;">
																	<?php echo $device->dErr->eType ?>
                                                                </div>
                                                            </div>
                                                            <div class="Table">
                                                                <!-- Device Information -->
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('نام دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-name_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dNikeName ?>
                                                                    </div>
                                                                </div>
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('شهر دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-city_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dCity ?>
                                                                    </div>
                                                                </div>
                                                                <div class="Row">
                                                                    <div class="Cell">
																		<?php echo _('مکان دستگاه: ') ?>
                                                                    </div>
                                                                    <div id="device-station_<?php echo $device->dSerialNumber ?>"
                                                                         class="Cell">
																		<?php echo $device->dLocation ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="device-errors_<?php echo $device->dSerialNumber ?>"
                                                                 style="overflow-y: scroll; display: block;height: 20%;">
																<?php echo $device->dErr->eMsg ?>
                                                            </div>
                                                            <div id="device-details_<?php echo $device->dSerialNumber ?>"
                                                                 style="display: block;height: 10%;">
                                                                <a href="<?php echo DEVICEPAGE . "&ID=" . $device->dSerialNumber ?>"
                                                                   target="_blank">
																	<?php echo _('جزئیات') ?>
                                                                </a>
                                                            </div>
                                                        </li>
														<?php
													}
												}
											}
										}
									?>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
				<?php
			}
		}
	}
?>
