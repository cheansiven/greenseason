<?php $this->load->view('sejour/header');?>

<!--
  -- Body
  -->
<div id="body">

    <?php $this->load->view('sejour/main-menu');?>

    <div class="bodyContent">

        <div class="bodyContentLeft">

            <?php $this->load->view('sejour/v_extra-contents');?>
            <?php $this->load->view('sejour/v_ads2');?>
            <?php $this->load->view('sejour/v_ads-commentaires');?>

        </div>

        <div class="bodyContentRight">

        <?php $num_articles = sizeof($articles);?>
        <?php if( $num_articles > 0 ) : ?>

            <?php
            $i = 1;
            foreach ($articles as $value)
            {
                ?>
                <div class="mainBoxContent">

                    <div class="day h22"></div>
                    <h2 class="mainTitle">
                        <?php
                        if(  $value['website'] != "" )
                            echo '<a href="'.$value['website'].'" target="_blank">'.$value['title'].'</a>';
                        else
                            echo $value['title'];
                        ?>
                    </h2>

                    <div class="descriptions">
                        <h3><?= $value['sub_title'] ?></h3>

                        <?php
                        if ($value['image'] != '')
                        {
                            if(  $value['website'] != "" )
                                echo '<a href="'.$value['website'].'" target="_blank"><img src="'.base_url().'upload/articles/'.$value['image'].'" align="left" /></a>';
                            else
                                echo '<img src="'.base_url().'upload/articles/'.$value['image'].'" align="left" />';
                        }

                        echo $value['description'];
                        ?>
                    </div>

                </div>
                <?php
                $i++;
            } // foreach?>

        <?php endif; ?>
    </div>

    </div><!-- .bodyContent -->
    <div class="clear"></div>

</div>

<?php $this->load->view('sejour/footer');?>