<?php
	/**
	 * Created by PhpStorm.
	 * User: mohammad
	 * Date: 1/2/2015
	 * Time: 3:50 PM
	 */

?>
<div id = "cssmenu" >
	<div id = "menu-button" ><?php echo _('menu') ?></div >
	<ul >
        <li >
            <a href = "index.php" ><?php echo _('همه دستگاه ها') ?></a >
        </li >
		<li class = "active has-sub" >
			<span class = "submenu-button" >

			</span >
			<a href = "#" ><?php echo _('مدیر ارشد') ?></a >
			<ul >
				<li  >
					<span class = "submenu-button" >

					</span >
					<a href = "index.php?Req=settings" ><?php echo _('تنظیمات') ?></a >
				</li >
				<li >
					<span class = "submenu-button" >

					</span >
					<a href = "index.php?Req=users" ><?php echo _('کاربران') ?></a >
				</li >
				<li >
					<span class = "submenu-button" >

					</span >
					<a href = "index.php?Req=calibration" ><?php echo _('کالیبره کردن') ?></a >
				</li >
			</ul >
		</li >
		<li >
			<a href = "index.php?Req=report" ><?php echo _('گزارش ها') ?></a >
		</li >
		<li >
			<a href = "#" ><?php echo _('تماس با ما')?></a >
		</li >
		<li class = "has-sub">
			<a href = "#" ><?php echo _('راهنمایی') ?></a >
			<ul >
				<li >
					<span class = "submenu-button" >
					</span >
					<a href = "#" ><?php echo _('معرفی') ?></a >
				</li >
				<li >
					<span class = "submenu-button" >

					</span >
					<a href = "#" ><?php echo _('درباره') ?></a >
				</li >
			</ul >
		</li >
        <li >
            <a href = "index.php?Req=logout" ><?php echo _('خروج')?></a >
        </li >
	</ul >
</div >