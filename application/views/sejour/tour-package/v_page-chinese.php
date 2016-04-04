<?php $this->load->view('sejour/header');?>

    <!--
      -- Body
      -->
<div id="body">

    <div class="blog-hotel">

        <!--Form Booking Popup-->
        <?php $this->load->view('sejour/tour-package/v_booking');?>

    <div class="sidebar-left">&nbsp;</div>
        <div class="blog-page-menu">
            <?php $this->load->view('sejour/main-menu');?>
        </div>
    <div class="clear"></div>

    <div class="col-md-12">
        <div class="bodyContent">

            <div class="col-xs-3">
                <!--<div class="sidebar-left">-->
                <?php $this->load->view('sejour/sidebar/sidebar-left');?>
                <!--</div>-->
            </div>

            <div class="col-xs-9">
                <div class="row">
                    <div id="blog-content" class="blog-content">

                        <div class="title-description"><p>We provide tickets and tour packages for all residents to destinations like Europe, USA and Asia. We have strong partnership</p></div>
                        <div id="blog-content" class="blog-content">

                            <!--Article one-->
                            <article class="blog-article-item-chinese">
                                <section>
                                    <h2>吴哥之旅(2 天/ 1 晚)</h2>
                                    <p class="descriptions">
                                        <b>第一天 – 抵达暹粒 - 不包括餐饮</b><br />
                                        抵达暹粒机场后，专业导游迎接各位贵宾参观吴哥古城（12世纪），能看到南门（乳液翻腾的巨型雕像）、巴戎寺（54座独特宝塔，装饰有200多张观音菩萨面带微笑的脸）、皇家围场、空中宫殿、斗象台和癞王台。<br /><br />
                                        下午，参观吴哥平原上最著名的庙宇：吴哥窟。
                                    </p>
                                    <div class="download-chinese-pdf"><a href="<?= base_url().'public/files/rtr-1-day-tour.pdf' ?>" target="_blank">下载</a></div>
                                </section>
                            </article>

                            <!--Article two-->
                            <article class="blog-article-item-chinese">
                                <section>
                                    <h2>金边–暹粒(3天/2晚) 旅行代码: CA 033</h2>
                                    <p class="descriptions">
                                        <b>第一天：抵达金边 - 不包括餐饮</b><br />
                                        当抵达金边机场专业导游迎接各位贵宾。参观胜利纪念碑和国家博物馆、皇家宫殿（1866年由法国于旧镇遗址兴建）以及位于皇宫内的金银阁寺。  然后，参观以金边命名的金塔山寺（Wat Phnom Temple），日落时您可以欣赏伫立于城市街道两旁的树木，结束您的旅行。
                                    </p>
                                    <div class="download-chinese-pdf"><a href="<?= base_url().'public/files/rtr-1-1-day-tour.pdf' ?>" target="_blank">下载</a></div>
                                </section>
                            </article>

                            <!--Article three-->
                            <article class="blog-article-item-chinese">
                                <section>
                                    <h2>吴哥之旅(3 天/ 2 晚)</h2>
                                    <p class="descriptions">
                                        <b>第一天：抵达暹粒 - 不包括餐饮</b><br />
                                        抵达暹粒机场后，专业导游迎接各位贵宾。 参观吴哥古城（12世纪），能看到南门（乳液翻腾的巨型雕像）、巴戎寺（54座独特宝塔，装饰有200多张观音菩萨的笑脸）、皇家围场、空中宫殿、斗象台和癞王台。  下午，参观吴哥平原上最著名的庙宇：吴哥窟。
                                    </p>
                                    <div class="download-chinese-pdf"><a href="<?= base_url().'public/files/rtr-2-day-tour.pdf' ?>" target="_blank">下载</a></div>
                                </section>
                            </article>

                            <!--Article four-->
                            <article class="blog-article-item-chinese">
                                <section>
                                    <h2>金边–暹粒(4天/ 3 晚)</h2>
                                    <p class="descriptions">
                                        <b>第一天：抵达金边 - 不包括餐饮</b><br />
                                        当抵达金边机场专业导游迎接各位贵宾。参观胜利纪念碑和国家博物馆、皇家宫殿（1866年由法国于旧镇遗址兴建）以及位于皇宫内的金银阁寺。  然后，参观以金边命名的金塔山寺（Wat Phnom Temple），日落时您可以欣赏伫立于城市街道两旁的树木，结束您的旅行。晚餐后入住酒店
                                    </p>
                                    <div class="download-chinese-pdf"><a href="<?= base_url().'public/files/rtr-2-1-day-tour.pdf' ?>" target="_blank">下载</a></div>
                                </section>
                            </article>

                            <!--Article five-->
                            <article class="blog-article-item-chinese">
                                <section>
                                    <h2>吴哥之旅(4 天/ 3 晚)</h2>
                                    <p class="descriptions">
                                        <b>第一天 – 抵达暹粒 - 不包括餐饮</b><br />
                                        抵达暹粒机场后，专业导游迎接各位贵宾。 参观吴哥古城（12世纪），能看到南门（乳液翻腾的巨型雕像）、巴戎寺（54座独特宝塔，装饰有200多张观音菩萨面带微笑的脸）、皇家围场、空中宫殿、斗象台和癞王台。
                                        下午，参观吴哥平原上最著名的庙宇：吴哥窟。
                                    </p>
                                    <div class="download-chinese-pdf"><a href="<?= base_url().'public/files/rtr-3-day-tour.pdf' ?>" target="_blank">下载</a></div>
                                </section>
                            </article>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- .bodyContent -->
        <div class="clear"></div>

    </div>

    </div> <!-- .bodyContent -->
</div>

<?php $this->load->view('sejour/footer');?>