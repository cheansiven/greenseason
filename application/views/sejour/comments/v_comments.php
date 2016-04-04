<?php $this->load->view('sejour/header');?>

    <link href="<?php echo base_url();?>public/css/star-rating.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>public/js/star-rating.js"></script>

    <script type="text/javascript" src="<?php echo base_url();?>public/js/tinymce/tinymce.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $(".rating-kv").rating();

            tinymce.init({
                selector: "textarea",
                menubar : false,
                toolbar: false,
                statusbar : false
            });

            $('#commentForm').submit(function(){

                if(validateForm() /*&& validateEmail()&& validateComment()*/ )
                    return true
                else
                    return false;
            });

            function validateForm(){

                var errorName = 0;
                var errorEmail = 0;
                var errorComment = 0;
                var errorActive = 0;

                if($('#name').val() == "VOTRE NOM" || $('#name').val() == ""){
                    $('#name').addClass("error");
                    errorName++;
                }
                if($('#email').val() == "VOTRE EMAIL" || $('#email').val() == ""){
                    $('#email').addClass("error");
                    errorEmail++;
                }
                if( $('#comment').val() == ""){
                    $('#comment').addClass("error");
                    errorComment++;
                }
                if( !$('#active').is(':checked')){
                    $('#active').addClass("error");
                    errorActive++;
                }

                //if it's valid
                if( errorName == 0)
                    $('#name').removeClass("error");
                if( errorEmail == 0)
                    $('#email').removeClass("error");
                if( errorComment == 0)
                    $('#comment').removeClass("error");
                if( errorActive == 0)
                    $('#active').removeClass("error");

                if ( errorName > 0 || errorEmail > 0 || errorComment > 0 || errorActive > 0)
                {
                    $('#msgError').toggle();
                    $('#msgError').show();
                    return false;
                }
                else
                {
                    $('#msgError').toggle();
                    $('#msgError').hide();
                    return true;
                }
            }
        });

    </script>

    <!--
      -- Body
      -->
    <div id="body">

        <?php $this->load->view('sejour/main-menu');?>

        <div class="bodyContent">

            <div class="content">

                <div class="mainTitle">
                    <h2><?= lang("title_write_us") ?></h2>
                </div>

                <div class="mainText">
                    <?php echo form_open('c_comments/saveComment', 'id="commentForm" name="commentForm"'); ?>

                        <p>
                            <?= form_input('name','VOTRE NOM', 'id="name" class="input-text mr10" autofocus'); ?>

                            <?= form_input('email','VOTRE EMAIL', 'id="email" class="input-text" autofocus'); ?>

                            <input id="input-21e" name="rate" value="0" type="number" class="rating" min=0 max=5 step=1 data-size="xs" >

                        </p>
                        <p><?= form_textarea('comment','', 'id="comment" class="textarea" autofocus'); ?></p>

                        <p>
                            <?= form_checkbox('active','1', false, 'id="active"'); ?> <span>J'ACCÉPTE DE RECEVOIR VOS PROMOTIONS ET LETTRES D'INFORMATIONS</span>
                        </p>

                        <span id="msgError">
                            <div>Veuillez saisir votre nom! </div>
                            <div>Veuillez saisir votre email! </div>
                            <div>Veuillez saisir votre commentaire! </div>
                        </span>

                        <?= form_submit('save', 'ENVOYER', 'class="fright EF8B30 button"'); ?>
                        <div class="clear"></div>
                    <?= form_close() ?>
                </div>
            </div>

            <div class="bodyContentLeft">

                <?php $this->load->view('sejour/v_extra-contents'); ?>
                <?php $this->load->view('sejour/v_tour_categories');?>
                <?php $this->load->view('sejour/ads/v_ads2'); ?>

            </div>

            <div id="masonry" class="bodyContentRight">

                <?php
                if( sizeof($results)>0 )
                {
                    foreach( $results as $value ) :
                ?>
                    <div class="subBoxContent">
                        <div class="day h22"></div>
                        <div class="mainTitle">
                            <h2><?= $value->name ?></h2>
                        </div>

                        <h3 class="fleft"><?= date('d M Y', strtotime($value->create_date)) ?></h3>

                        <?php
                        if( $value->rate >0 )
                        {
                            $stars = "";
                            for( $i=0; $i<$value->rate; $i++ )
                                $stars .= "★";

                            echo '<span class="fright stars">'.$stars.'</span>';
                        }
                        ?>
                        <div class="clear"></div>

                        <div class="mainText contact">
                            <div class="descriptions">
                                <?= $value->comment ?>
                            </div>
                        </div>
                    </div>
n
                <?php
                    endforeach;
                }
                ?>
            </div>
            <div class="clear"></div>

        </div><!-- .bodyContent -->
    </div>

<?php $this->load->view('sejour/footer');?>