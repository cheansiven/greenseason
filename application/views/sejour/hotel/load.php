<div>
    <?php foreach($hotels as $row) { ?>
        <article class="blog-article-item loaded">
            <header>
                <?php if (!$row->logo == "") { ?><img src="<?= base_url().'upload/hotels/'.$row->logo ?>" class="hotels-photo" /><?php } else { ?><img src="<?= base_url().'public/images/bgCategory.png' ?>" class="hotels-photo" /><?php } ?>
            </header>
            <section>
                <h2>
                    <a href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>" class="btn-booking"><?= $row->name; ?></a>
                </h2>
                <div class="descriptions"><?php echo character_limiter(strip_tags($row->description),150); ?></div>
            </section>
            <div class="mobile-menu-item text-uppercase">
                <a class="hotel-read-more" href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>">read more</a>
                <a class="hotel-booking" href="<?php echo base_url().'hotel/'.$row->id.'/'.strtolower(url_title($row->name)).'.html'; ?>">book now</a>
            </div>
        </article>
    <?php } ?>
</div>