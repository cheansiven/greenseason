<?php
if (isset($_POST['submit'])) {
    $to = "info@rtr-tours.com, engineer@lox-design.com";
    /*$to = "pheakdey.kong123@gmail.com";*/
    $subject = "New Hotel Booking";

    $message = '
    Dear RTR, <br><br>
    The following contact has submitted a hotel booking request with below info:<br><br>
		<p>Book for Hotel: <strong>'.$_POST['input-title']. '</strong></p>
		<p>Name: '.$_POST['title']. '. ' .$_POST['lname'].' '.$_POST['fname'].'</p>
		<p>Email: '.$_POST['email']. '</p>
		<p>Telephone: '.$_POST['phone'].'</p>
		<p>Checkin: '.$_POST['checkin']. ', Checkout: '.$_POST['checkout']. '</p>
		<p>Number of adults: '.$_POST['num-adult']. ', Number of Children: '.$_POST['num-child']. ', Number of infant: '.$_POST['num-infant']. '</p>
		<p>Room type: '.$_POST['room-type'].'</p>
		<p>Number of room: '.$_POST['num-room'].'</p>
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
    $this->load->view('sejour/hotel/v_booking_success');
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
                            <input type="text" class="form-control" id="lname" name="lname" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="fname">First Name</label><br />
                            <input type="text" class="form-control" id="fname" name="fname" placeholder="" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb5">
                    <div class="row">
                        <div class="form-group col-xs-6 pr0">
                            <label for="email">Email</label><br />
                            <input type="text" class="form-control" id="email" name="email" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="phone">Telephone</label><br />
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 pb15">
                    <div class="row">
                        <div class="form-group col-xs-6 pr0">
                            <label for="checkin">Arrival Date(Check in)</label><br />
                            <input type="text" class="form-control datepicker" name="checkin" id="checkin" placeholder="" required>
                        </div>
                        <div class="form-group col-xs-6 pr0">
                            <label for="checkout">Departure Date(Check out)</label><br />
                            <input type="text" class="form-control datepicker" name="checkout" id="checkout" placeholder="" required>
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

                <div class="form-group col-md-12 pb15 btn-radio pl0">
                    <label for="single" class="radio-inline">
                        <input type="radio" id="single" name="room-type" value="Single" required> Single
                    </label>
                    <label for="double" class="radio-inline">
                        <input type="radio" id="double" name="room-type" value="Double"> Double
                    </label>
                    <label for="twin" class="radio-inline">
                        <input type="radio" id="twin" name="room-type" value="Twin"> Twin
                    </label>
                    <label for="room-type" class="error"></label>
                </div>
                <div class="col-md-12 pb15">
                    <label for="children">Number of Rooms</label>
                    <select name="num-room" class="SlectBox dropdown">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            <input type="submit" class="pull-right btn btn-danger" name="submit" value="SEND" /><br />
            <div class="clear"></div>
            <div class="pull-right btn-booking-bottom">
                <input type="button" value="CANCEL" class="close-reveal-modal" />
                <input type="reset" value="RESET" class="" />
            </div>
            </form>

        </div>
    </div>
</div>