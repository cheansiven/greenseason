    <?php $this->load->view('sejour/header');?>

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery.datepick.css">
    <script src="<?php echo base_url();?>public/js/jquery.datepick.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>public/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">

        /*$(function() {
            $( "#_tabs" ).tabs();
        });*/

        $(document).ready(function(){

            var guestSessionTime = "<?= strtotime(date("Y-m-d H:s:i")) ?>";
            var form = $("#newForm");

            var tap1 = $("#tabs-1");
            var tap2 = $("#tabs-2");
            var tap3 = $("#tabs-3");

            var nextStep2 = $("#nextStep2");
            var nextStep3 = $("#nextStep3");

            var backStep1 = $("#backStep1");
            var backStep2 = $("#backStep2");

            var gender =  $("#gender");

            var name = $("#name");
            var name_info = $("#name_info");

            var lname = $("#lname");

            var email = $("#email");
            var email_info = $("#email_info");

            var nationality = $("#nationality");

            var contact = $("#contact");
            var telephone = $("#telephone");

            var adults = $("#adults");
            var adults_info_ = $("#adults_info_");

            var date_arrival = $("#date_arrival");
            var date_arrival_info = $("#date_arrival_info");

            var date_return = $("#date_return");

            var arriving_from = $("#arriving_from");
            var budget = $("#budget");
            var budget_info = $("#budget_info");


            /* Value */
            var name_val = "NOM";
            var lname_val = "PRÉNOM";
            var email_val = "EMAIL";
            var date_arrival_val = "DATE D\'ARRIVÉE";
            var budget_val = "VOTRE BUDGET PAR PERSONNE";

            /*
             * Hide
             */
            tap2.hide();
            tap3.hide();

            name_info.hide();
            email_info.hide();
            adults_info_.hide();
            date_arrival_info.hide();
            budget_info.hide();

            /*
             * Focus
             */
            /*on name*/
            name.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            name.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            <!--on last name-->
            lname.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            lname.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            <!--on email-->
            email.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            email.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            <!--on nationality-->
            nationality.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            nationality.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            <!--on telephone-->
            $('#contact').click(function () {

                if( $('#contact').is(':checked'))
                {
                    $( "#telephone" ).prop( "disabled", false );
                    $( "#time" ).prop( "disabled", false );
                }
                else
                {
                    $( "#telephone" ).prop( "disabled", true );
                    $( "#time" ).prop( "disabled", true );
                }
            });

            telephone.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            telephone.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            /*on date arrival*/
            $('#date_arrival').datepick({
                minDate: 0
            });
            date_arrival.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            date_arrival.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            /* on return */
            $('#date_return').datepick({
                minDate: 0
            });
            date_return.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            date_return.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            })

            /* on From */
            arriving_from.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            arriving_from.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            /* on Budget */
            budget.focus(function() {
                if($(this).val() == $(this).data('default_val') || !$(this).data('default_val')) {
                    $(this).data('default_val', $(this).val());
                    $(this).val('');
                    $(this).removeClass("error");
                }
            });
            budget.blur(function() {
                if($(this).val() == "") $(this).val($(this).data('default_val'));
            });

            /*
             * Focus Validate
             */
            name.blur(validateName);
            email.blur(validateEmail);
            adults.blur(validateAdults);
            date_arrival.blur(validateDateArrival);
            budget.blur(validateBudget);

            nextStep2.click(validateStep1);
            nextStep3.click(validateStep2);

            backStep1.click(function() {

                tap2.slideUp("slow")
                tap1.slideDown( "slow" );

                $("#num2").removeClass("current");
                $("#num2").addClass("active")

                $("#num1").removeClass("active");
                $("#num1").addClass("current");
            });
            backStep2.click(function() {
                tap3.slideUp("slow")
                tap2.slideDown( "slow" );

                $("#num3").removeClass("current");
                $("#num3").addClass("active")

                $("#num2").removeClass("active");
                $("#num2").addClass("current");

            });


            /*
             * Validate Function
             */

            function validateStep1(){
                if( validateName() & validateEmail() )
                {
                    // store in db
                    $.ajax({
                        url: "c_activities/saveEmail",
                        data: {
                            name: gender.val() + " " + name.val(),
                            email: email.val(),
                            module: "VOYAGER SUR MESURE",
                            guestID: guestSessionTime
                        },
                        type: "post"
                    });


                    tap1.slideUp("slow")
                    tap2.slideDown( "slow" );

                    $("#name_show").text( gender.val() + " " + name.val());
                    $("#name_show2").text( gender.val() + " " + name.val());

                    $("#num1").removeClass("current");
                    $("#num1").addClass("active");

                    $("#num2").removeClass("active");
                    $("#num2").addClass("current");

                    return true;
                }
                else
                    return false;
            }

            function validateStep2(){
                if( validateAdults() & validateDateArrival() )
                {
                    tap2.slideUp("slow")
                    tap3.slideDown( "slow" );

                    $("#num2").removeClass("current");
                    $("#num2").addClass("active");

                    $("#num3").removeClass("active");
                    $("#num3").addClass("current");

                    return true;
                }
                else
                    return false;
            }

            function validateName(){
                //if it's NOT valid
                if(name.val() == name_val || name.val() == ""){
                    name.addClass("error");
                    name_info.toggle();
                    name_info.show();
                    name.val(name_val);
                    return false;
                }
                //if it's valid
                else{
                    name.removeClass("error");
                    name_info.toggle();
                    name_info.hide();
                    return true;
                }
            }

            function validateEmail(){
                //testing regular expression
                var a = email.val();
                var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})$/;
                //if it's valid email
                if(filter.test(a)){
                    email.removeClass("error");
                    email_info.toggle();
                    email_info.hide();
                    return true;
                }
                //if it's NOT valid
                else{
                    email.addClass("error");
                    email_info.toggle();
                    email_info.show();
                    if(email.val() == email_val || email.val() == "")
                        email.val(email_val);
                    else email_info.text('Email is incorrect!');
                    return false;
                }
            }

            function validateAdults(){
                //if it's NOT valid
                if(adults.val() == "" ||adults.val() == 0){
                    adults.addClass("error");
                    adults_info_.toggle();
                    adults_info_.show();
                    adults_info_.val();
                    return false;
                }
                //if it's valid
                else{
                    adults.removeClass("error");
                    adults_info_.toggle();
                    adults_info_.hide();
                    return true;
                }
            }

            function validateDateArrival(){
                //if it's NOT valid
                if(date_arrival.val() == date_arrival_val || date_arrival.val() == ""){
                    date_arrival.addClass("error");
                    date_arrival_info.toggle();
                    date_arrival_info.show();
                    date_arrival_info.val(date_arrival_val);
                    return false;
                }
                //if it's valid
                else{
                    date_arrival.removeClass("error");
                    date_arrival_info.toggle();
                    date_arrival_info.hide();
                    return true;
                }
            }

            function validateHotel(){

                if( $('input[name=hotel_category_id]:checked', form).val() )
                {
                    hotel_category_id_info.toggle();
                    hotel_category_id_info.hide();
                    return true;
                }
                else
                {
                    hotel_category_id_info.toggle();
                    hotel_category_id_info.show();
                    return false;
                }
            }
            /*function validateTour(){

                if( $('input[name=hotel_category_id]:checked', form).val() )
                {
                    hotel_category_id_info.toggle();
                    hotel_category_id_info.hide();
                    return true;
                }
                else
                {
                    hotel_category_id_info.toggle();
                    hotel_category_id_info.show();
                    return false;
                }
            }*/

            function validateBudget(){
                //if it's NOT valid
                if(budget.val() == budget_val || budget.val() == ""){
                    budget.addClass("error");
                    budget_info.toggle();
                    budget_info.show();
                    budget_info.val();
                    return false;
                }
                //if it's valid
                else{
                    budget.removeClass("error");
                    budget_info.toggle();
                    budget_info.hide();
                    return true;
                }
            }

            /*checking validation submit form booking*/
            form.submit(function(){
                if( validateName() & validateEmail() & validateAdults() & validateDateArrival() & validateBudget() )
                {
                    // update status db
                    $.ajax({
                        url: "c_activities/updateEmail",
                        data: {
                            name: gender.val() + " " + name.val(),
                            email: email.val(),
                            module: "VOYAGER SUR MESURE",
                            guestID: guestSessionTime
                        },
                        type: "post"
                    });

                    return true;
                }
                else
                    return false;
            });

            //Enter number only
            jQuery('.numbersOnly').keyup(function () {
                this.value = this.value.replace(/[^0-9\.]/g,'');
            });

            tinymce.init({
                selector: "textarea",
                menubar : false,
                toolbar: false,
                statusbar : false
            });

        });

    </script>

    <!--
      -- Body
      -->
    <div id="body">

        <?php $this->load->view('sejour/main-menu');?>

        <div class="bodyContent">

            <?php if( isset($error) ) :?>
                <div class="content">

                    <div class="mainText">

                        <?php
                        if ($error == 0)
                            echo "<h3>Merci! Votre demande a été soumise avec succès.</h3>";
							
                        else
                            echo "<h3>Désolé! Votre demande n'a pas été soumise correctement, veuillez ré-essayer.</h3>";
                        ?>
						
                    </div>
                </div>
            <?php endif; ?>

            <div class="content">

                <div class="mainTitle">
                    <h2><?= lang("title_vacation_packages") ?></h2>
                </div>

                <div class="mainText">

                    <h3>AVEC EXTENSION POSSIBLE AUX PAYS LIMITROPHES</h3>

                    <?php echo form_open('sejour/saveVacationPackages', 'id="newForm" name="newForm"'); ?>

                    <div id="_tabs">
                        <div>
                            <div class="no current" id="num1"><h3>1</h3></div>
                            <div class="no" id="num2"><h3>2</h3></div>
                            <div class="no" id="num3"><h3>3</h3></div>
                            <div class="clear"></div>
                        </div>

                        <div id="tabs-1">
                            <!-- row 1--><!--Gender -->
                            <dl>
                                <?= form_radio('gender', 'Monsieur', TRUE, 'id="gender"') ?><span>Monsieur</span>
                                <?= form_radio('gender', 'Madame', FALSE, 'id="gender"') ?><span>Madame</span>
                                <?= form_radio('gender', 'Mademoiselle', FALSE, 'id="gender"') ?><span>Mademoiselle</span>
                            </dl>

                            <!-- row 2-->
                            <div class="fleft w49p">
                                <!--Name -->
                                <dl>
                                    <?= form_input('name','NOM', 'id="name" class="input-text"'); ?>
                                    <div id="name_info" class="msgInfo">Veuillez saisir votre nom!</div>
                                </dl>
                            </div>
                            <div class="fright w49p rightForm">
                                <!--Last Name -->
                                <dl>
                                    <?= form_input('lname','PRÉNOM', 'id="lname" class="input-text" '); ?>
                                </dl>
                            </div>
                            <div class="clear"></div>

                            <!-- row 3-->
                            <div class="fleft w49p">
                                <!--Email -->
                                <dl>
                                    <?= form_input('email','EMAIL', 'id="email" class="input-text"'); ?>
                                    <div id="email_info" class="msgInfo">Veuillez saisir votre email!</div>
                                </dl>
                            </div>
                            <div class="fright w49p rightForm">
                                <!--Nationality -->
                                <dl>
                                    <?= form_input('nationality','NATIONALITÉ', 'id="nationality" class="input-text"'); ?>
                                </dl>

                            </div>
                            <div class="clear"></div>

                            <!-- row 4-->
                            <div class="frame">
                                <!--Phone -->
                                <dl>
                                    <?= form_checkbox('contact','1', false, 'id="contact"'); ?> <span>JE SOUHAITE ÊTRE CONTACTÉ PAR TÉLÉPHONE</span>
                                </dl>
                                <div id="timeDisplay">
                                    <dl>
                                        <?= form_input('telephone','TÉLÉPHONE', 'id="telephone" class="input-text w47p" disabled'); ?>
                                        <div class="f10">Merci d'indiquer le téléphone avec l'indicatif +3367779999</div>
                                    </dl>
                                    <dl>
                                        <span>SI OUI, QUELLE EST LA MEILLEURE HEURE LOCALE POUR VOUS APPELER?</span>
                                        <?php
                                        $option_type = array(
                                            '' => "",
                                            '8' => "8h00",
                                            '9' => "9h00",
                                            '10' => "10h00",
                                            '11' => "11h00"
                                        );

                                        echo form_dropdown('time', $option_type, "", 'id="time" class="input-text w15p" disabled');
                                        ?>
                                    </dl>
                                </div>
                            </div>

                            <div class="fright">
                                <?= form_button('nextStep2', 'SUIVANT', 'id="nextStep2" class="EF8B30 button"'); ?>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div id="tabs-2">

                            <dl>
                                Cher <strong><span id="name_show"></span>,</strong>
                            </dl>

                            <!-- row 1 -->
                            <div class="fleft w33p">
                                <dl>
                                    <span>NOMBRE D'ADULTES</span>
                                    <?= form_input('adults','', 'id="adults" class="input-text w35p numbersOnly"'); ?>
                                    <div id="adults_info_" class="msgInfo">Veuillez saisir le nombre d'adultes!</div>
                                </dl>
                            </div>
                            <div class="fleft w33p">
                                <dl>
                                    <span>ENFANTS 6 À 12 ANS</span>
                                    <?= form_input('infants','', 'id="infants" class="input-text w35p numbersOnly"'); ?>
                                </dl>
                            </div>
                            <div class="fleft w33p">
                                <dl>
                                    <span>ENFANTS <6 ANS</span>
                                    <?= form_input('under','', 'id="under" class="input-text w35p numbersOnly"'); ?>
                                </dl>
                            </div>
                            <div class="clear"></div>

                            <!-- row 2 -->
                            <dl>
                                <?= form_radio('ticket', 'OUI', TRUE) ?><span>Nous avons déjà nos billets d'avion</span>
                                <?= form_radio('ticket', 'NO', FALSE) ?><span>Nous n'avons pas encore pris nos billets, ceci une estimation</span>
                            </dl>

                            <!-- row 3 -->
                            <div class="fleft w49p">
                                <!-- Arrival  -->
                                <dl>
                                    <?= form_input('date_arrival','DATE D\'ARRIVÉE', 'id="date_arrival" class="input-text" readonly="readonly"'); ?>
                                    <div id="date_arrival_info" class="msgInfo">Veuillez saisir la date!</div>
                                </dl>
                            </div>
                            <div class="fright w49p">
                                <!-- Return -->
                                <dl>
                                    <?= form_input('date_return','DATE DU RETOUR', 'id="date_return" class="input-text" readonly="readonly"'); ?>
                                </dl>
                            </div>
                            <div class="clear"></div>

                            <!-- row 5 -->
                            <div class="fleft w49p">
                                <!-- Arriving from  -->
                                <dl>
                                    <?= form_input('arriving_from','EN PROVENANCE DE', 'id="arriving_from" class="input-text"'); ?>
                                </dl>
                            </div>
                            <div class="clear"></div>

                            <div class="fright">
                                <?= form_button('backStep1', 'RETOUR', 'id="backStep1" class="B808080 button"'); ?>
                                <?= form_button('nextStep3', 'SUIVANT', 'id="nextStep3" class="EF8B30 button"'); ?>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div id="tabs-3">

                            <dl>
                                Cher <strong><span id="name_show2"></span>,</strong> cochez le type de séjour que vous recherchez
                            </dl>

                            <div class="fleft w30p">
                                <dl>
                                    <?php
                                    if( sizeof($hotel_categories)>0 )
                                    {
                                        foreach( $hotel_categories as $value )
                                            echo form_checkbox('hotel_category_id[]', $value['id'], '', 'id="hotel_category_id"')."<span>".$value['name']."</span><br />";
                                    }
                                    ?>
                                </dl>
                            </div>
                            <div class="fleft w30p">
                                <dl>
                                    <?php
                                    if( sizeof($tour_categories)>0 )
                                    {
                                        foreach( $tour_categories as $value )
                                            echo form_checkbox('tour_category_id[]', $value['id'])."<span>".$value['name']."</span><br />";
                                    }
                                    ?>
                                </dl>
                            </div>
                            <div class="fleft w30p">
                                <dl>
                                    <?= form_radio('meal', 'DEMI PENSION') ?><span>DEMI PENSION</span><br />
                                    <?= form_radio('meal', 'PENSION COMPLÈTE') ?><span>PENSION COMPLÈTE</span><br />
                                    <?= form_radio('meal', 'Nous vous faisons confiance et nous vous demandons de laisser les repas libres chaque fois que c’est possible (Lorsqu’il n’est pas possible de se restaurer dans tel ou tel lieu de visite WAM propose des paniers pique-nique).') ?>
                                    <div class="f10 ml22 mt22-">Nous vous faisons confiance et nous vous demandons de laisser les repas libres chaque fois que c’est possible (Lorsqu’il n’est pas possible de se restaurer dans tel ou tel lieu de visite WAM propose des paniers pique-nique).</div>
                                </dl>
                            </div>
                            <div class="clear"></div>

                            <div class="fleft w49p">
                                <dl>
                                    <span>COMMENTAIRE</span>
                                    <?= form_textarea('comment','', 'id="comment" class="textarea w100p h120" autofocus'); ?>
                                </dl>
                            </div>
                            <div class="fright w49p">
                                <dl>
                                    <div>&nbsp;</div>
                                    <?= form_input('budget','VOTRE BUDGET PAR PERSONNE', 'id="budget" class="input-text w50p"'); ?>
                                    <div id="budget_info" class="msgInfo">Veuillez saisir la budget!</div>
                                </dl>
                                <dl>
                                    <?php
                                    if( sizeof($this->currency)>0 )
                                    {
                                        foreach( $this->currency as $key => $value )
                                            echo form_radio('currency', $value['symbol'], $key == 1 ? true : false, 'id="currency"')."<span>EN ".$value['description']."</span><br />";
                                    }
                                    ?>
                                </dl>

                                <div class="fright">
                                    <?= form_button('backStep2', 'RETOUR', 'id="backStep2" class="B808080 button"'); ?>
                                    <?= form_submit('save', 'VALIDER', 'class="EF8B30 button"'); ?>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>

                        </div>
                        <div class="clear"></div>
                    </div>


                    <?= form_close() ?>

                </div><!-- .mainText -->

            </div><!-- .content -->
            <div class="clear"></div>

        </div><!-- .bodyContent -->
    </div>

<?php $this->load->view('sejour/footer');?>