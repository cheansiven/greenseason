<div class="leftMenu categoryMenu">
    <h2><?=lang("title_categories") ?></h2>

    <ul>
        <?php
        $i = 1;
        foreach( $categories as $value ) : ?>
            <?php //if( $value->id != $category_id) : ?>
                <li<?= $i==1 ? ' class="bt"' : '' ?>>
                    <a href="<?= site_url("gallerie/".$value->id."/".strtolower(url_title($value->url)).".html")?>">
                        <?= $value->name ?>
                    </a>
                </li>
            <?php
            //endif; ?>
            <?php
            $i++;
        endforeach; ?>
    </ul>
</div>