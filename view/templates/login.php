<?php
	/**
	 * Created by PhpStorm.
	 * User: Mohammad
	 * Date: 28/01/2016
	 * Time: 03:46 PM
	 */
?>

<div class="main_container">
    <div style="position:absolute;left:30%;background: #FFF;-moz-animation-name: bounceIn;-moz-animation-fill-mode: both;-moz-animation-duration: 1s;-moz-animation-iteration-count: 1;-moz-animation-timing-function: linear;animation-name: bounceIn;animation-fill-mode: both;animation-duration: 1s;animation-iteration-count: 1;animation-timing-function: linear;">
        <img src="images/main/logo_site.png">
    </div>
    <div style="direction: ltr">
        <div style="position: absolute;top: 50%;margin-top: -140px;background: #FFF;-moz-animation-name: bounceIn;-moz-animation-fill-mode: both;-moz-animation-duration: 1s;-moz-animation-iteration-count: 1;-moz-animation-timing-function: linear;animation-name: bounceIn;animation-fill-mode: both;animation-duration: 1s;animation-iteration-count: 1;animation-timing-function: linear;">
            <img src="images/main/logo_bargh.png">
        </div>
        <div style="z-index: 999;direction: rtl;padding: 10px;" id="container">
            <form action="<?php echo LOGINPAGE ?>" method="post" name="login">
                <p style="color:red ;"><?php echo $errorMessage; ?></p>
                <label for="username"><?php echo _('نام کاربری:') ?></label>

                <input id="username" name="username" type="name" required>

                <label for="password"><?php echo _('گذرواژه:') ?></label>

                <input id="password" name="password" type="password" required>

                <div id="lower">

                    <input type="submit" value="ورود">

                </div>

            </form>

        </div>
        <div style="position:absolute;right:1%;top: 50%;margin-top: -140px;background: #FFF;-moz-animation-name: bounceIn;-moz-animation-fill-mode: both;-moz-animation-duration: 1s;-moz-animation-iteration-count: 1;-moz-animation-timing-function: linear;animation-name: bounceIn;animation-fill-mode: both;animation-duration: 1s;animation-iteration-count: 1;animation-timing-function: linear;">
            <img src="images/main/logo_bargh.png">
        </div>
    </div>
</div>
