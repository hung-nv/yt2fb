<?php $member = Member::model()->findByPk(Yii::app()->user->id); ?>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="inner">

                <?php $this->renderPartial('_user', array('member' => $member)); ?>

                <div class="col-sm-12 col-xs-12">
                    <form method="post">
                        <div class="col-md-8 col-md-offset-2 col-xs-12" style="margin-top: 40px;">
                            <input class="final_url" value="<?php echo $link; ?>">
                            <div class="copy_final_url" style="opacity: 1;">Copy</div>
                            <!-- <input class="share_final_url" disabled="disabled" value="Share" /> -->
                        </div><!-- /.col-lg-6 -->
                    </form>
                </div>

                <div class="col-md-6 col-xs-12 col-md-offset-3" style="margin-top: 40px;">
                    <div class="after_box showbox" style="display: block;">
                        <div style="background-image: url(&quot;<?php echo $youtube->fb_thumbnail; ?>&quot;); display: block;" class="thumb"></div>
                        <div class="play"></div>
                        <iframe width="640" height="390" frameborder="0" rel="<?php echo $youtube->youtube_id ?>" id="video" allowfullscreen="1" title="YouTube video player" src="<?php echo $iframe; ?>"></iframe>
                        <div class="data data_big">
                            <div class="title" style="color: #fff;font-weight: bold; font-size: 15px; text-align: justify;"><?php echo $youtube->fb_headline; ?></div>
                            <div class="description"><?php echo $youtube->fb_description; ?></div>
                            <div class="youtube">FBADSPRO.NET</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 col-md-offset-2 col-xs-12" style="margin-top: 30px;">
                    <a class="copy_final_url" style="opacity: 1;" href="<?php echo Yii::app()->homeUrl; ?>">Bắt đầu lại</a>
                </div>

                <script type="text/javascript">
                    $('.after_box').on('click', '.play', function() {
                        $('.after_box .play').addClass('hidden');
                        $('.after_box > iframe#video').css('display', 'block');
                        $('.data_big').css('display', 'none');
                        var urlauto = $('.after_box > iframe#video').attr('src') + "?autoplay=1";
                        $('.after_box > iframe#video').attr('src', urlauto);
                        //e.preventDefault();
                    });
                </script>

            </div>
        </div>
    </div>
</header>