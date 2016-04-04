    <?php $this->load->view('sejour/header');?>

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

                    <?php
                    if ($error == 0)
                        echo "<h3>Merci! Votre commentaire a été soumis avec succès.</h3>";
                    else
                        echo "<h3>Désolé! Votre commentaire n'a pas été soumis correctement.</h3>";
                    ?>

                </div>
            </div>

            <div class="bodyContentLeft">

                <?php $this->load->view('sejour/v_extra-contents'); ?>
                <?php $this->load->view('sejour/v_tour_categories');?>

                <?php $this->load->view('sejour/ads/v_ads2'); ?>
                <?php $this->load->view('sejour/ads/v_ads-commentaires');?>

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