
<div class="adsBox">
    <div class="price_info">

            <div class="textInfo">
                <img src="<?= base_url() ?>public/images/icon-currency-01.png" align="left" /> <?= lang("label_price_info") ?>
            </div>
            <ul>
                <?php
                foreach ($this->currency as $key => $value) :
                    if( $key == $this->session->userdata('currency') ) :
                        echo '<li class="cicle-actived">'.$value['description'].'</li>';
                    else :
                        ?>
                        <li class="currency cicle" rel="<?= $key ?>">
                            <?= $value['description'] ?>
                        </li>

                    <?php
                    endif;
                endforeach ?>
            </ul>
    </div>
</div>