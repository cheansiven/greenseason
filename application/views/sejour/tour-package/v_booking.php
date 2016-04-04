<?php
if (isset($_POST['submit'])) {
    $to = "info@rtr-tours.com, engineer@lox-design.com";
    $subject = "New Tour Booking";

    $message = '
    Dear RTR, <br/><br/>
    The following contact has submitted a Tour booking request with below info:<br><br>
		<p>Tour Package: <strong>'.$_POST['input-title']. '</strong></p>
		<p>Name: '.$_POST['title']. '. ' .$_POST['lname'].' '.$_POST['fname'].'</p>
		<p>E-mail: '.$_POST['email'].'</p>
		<p>Telephone: '.$_POST['phone'].'</p>
		<p>Arrival Date: '.$_POST['arrival_date']. ', Departure Date: '.$_POST['departure_date']. '</p>
		<p>Number of adults: '.$_POST['num-adult']. ', Number of Children: '.$_POST['num-child']. ', Number of infant: '.$_POST['num-infant']. '</p>
		<br>
		Hotel Booking Form, RTR Tours Website.
    ';

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <rtr-tours.com>' . "\r\n";
    /*$headers .= 'Cc: myboss@example.com' . "\r\n";*/

    // send email
    mail($to,$subject,$message,$headers);
    header('Location: /tour-and-packages-to-cambodia.html');
}
?>

<div id="myModal" class="reveal-modal">
    <div class="col-md-12">
        <div class="col-xs-3">
            <div class="row">
                <h3 class="booking-title"></h3>
                <img class="get-photo" src="" width="100%" />
            </div>
        </div>
        <div class="col-xs-9">
            <div class="row pt20 pb10">
                <?php echo form_open('', array('class' => 'form-inline', 'id' => 'from-booking')); ?>

                <input id="hotel-title" type="hidden" name="input-title" />


                <div class="form-group col-md-12 pb10 btn-radio pl0">
                    <label for="mr" class="radio-inline">
                        <input id="mr" type="radio" name="title" value="Mr" required checked> Mr
                    </label>
                    <label for="mrs" class="radio-inline">
                        <input id="mrs" type="radio" name="title" value="Mrs"> Mrs
                    </label>
                    <label for="ms" class="radio-inline">
                        <input id="ms" type="radio" name="title" value="Ms"> Ms
                    </label>
                </div>

                <div class="col-md-12 mb5">
                    <div class="row">
                        <div class="form-group col-xs-6 pr0">
                            <label for="lname">Last Name</label><br />
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="" required="true">
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="fname">First Name</label><br />
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="" required="true">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb5">
                    <div class="row">
                        <div class="form-group col-xs-6 pr0">
                            <label for="email">Your email</label><br />
                            <input type="email" class="form-control" id="email" name="email" placeholder="" required="true">
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="phone">Telephone</label><br />
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required="true">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pb15">
                    <div class="row">
                        <div class="form-group col-xs-6 pr0">
                            <label for="arrival_date">Arrival Date</label><br />
                            <input type="text" class="form-control datepicker" name="arrival_date" id="arrival_date" placeholder="" required="true">
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="departure_date">Departure Date</label><br />
                            <input type="text" class="form-control datepicker" name="departure_date" id="departure_date" placeholder="" required="true">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pb15">
                    <div class="row">
                        <div class="form-group col-xs-4 pr0">
                            <label for="adults">Number of adults</label>
                            <select id="adults" name="num-adult" class="SlectBox dropdown">
                                <option selected value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4 pr0 pl5">
                            <label for="children">Number of Children</label>
                            <select name="num-child" id="children" class="SlectBox dropdown">
                                <option value="">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group col-xs-4 pr0">
                            <label for="infant">Number of infant</label>
                            <select name="num-infant" id="infant" class="SlectBox dropdown">
                                <option value="">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="submit" class="pull-right btn btn-danger mt10" name="submit" value="SEND" /><br />
                <div class="clear"></div>
                <div class="pull-right btn-booking-bottom">
                    <input type="button" value="CANCEL" class="close-reveal-modal" />
                    <input type="reset" value="RESET" class="" />
                </div>
                </form>
            </div>
        </div>
    </div>
</div>