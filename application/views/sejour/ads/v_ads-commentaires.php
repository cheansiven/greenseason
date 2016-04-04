<?php
/*$this->load->model('article_category');
$getCommentURL = $this->article_category->getCategoryByID(12, 1);*/

?>
<div class="adsBox">
    <div class="comment">
        <a href="<?= site_url("les-derniers-commentaires-de-nos-clients.html") ?>">
            <img src="<?= base_url() ?>upload/ads/ads-commentaires.png" />
            <h2 class="adsText">
                <?= lang("label_read_latest_comments") ?>
            </h2>
        </a>
    </div>
</div>