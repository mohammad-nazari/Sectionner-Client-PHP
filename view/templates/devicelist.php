<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 30/01/2016
	 * Time: 01:37 PM
	 */
?>
<div id = "content" class = "main_container" >
	<section class = "demo" >
		<div class = "gridster ready" >
			<ul style = "height: 480px; width: 960px; position: relative;" >
						<li data-row = "2" data-col = "1" data-sizex = "1" data-sizey = "1" class = "gs-w"
						    style = "word-wrap: break-word;-webkit-border-radius: 30px;-moz-border-radius: 30px;border-radius: 30px;position: absolute; min-width: 140px; min-height: 140px;padding: 1em;" >
							<div style = "display: block;height: 40%;" >
								<div style = "display: block;width: 50%;float: left;height: 40%;" >
									<img class = "deviece_picture" src = "images/device/rack1.png" />
									<!--										<img src = "Images/device/rack1.jpg" />-->
								</div >
								<div style = "display: block;width: 50%;float: left;" >
									<label >
										وضعیت دستگاه :<?php echo $device->sta ?>
									</label >
								</div >
							</div >
							<div style = "display: block;height: 15%;" >
								<label >
									نام دستگاه :<?php echo base64_decode($device->dNikeName) . "(" . $device->dSerialNumber .
									                       ")" ?>
								</label >
							</div >
							<div style = "display: block;height: 15%;" >
								<label >
									شهر :<?php echo base64_decode($device->dCity) ?>
								</label >
							</div >
							<div style = "display: block;height: 15%;" >
								<label >
									ایستگاه : <?php echo base64_decode($device->dLocation) ?>
								</label >
							</div >
							<div style = "display: block;height: 15%;" >
								<label >
									<a href = "<?php echo DEVICEPAGE . "&ID=" . $device->dSerialNumber ?>" target = "_blank" >
										جزئیات
									</a >
								</label >
							</div >
								<span class = "gs-resize-handle gs-resize-handle-both" >
								</span >
						</li >
			</ul >
		</div >

	</section >
</div >
