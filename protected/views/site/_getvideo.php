<div class="collapse" id="getvideo">
    <div class="row">
        <div class="col-xs-12">
            <p class="titlefound">Không tìm thấy video nào</p>
            <a class="open_toolbox" data-toggle="collapse" href="#change-description" aria-expanded="false" aria-controls="change-description">
                PRO Toolbox<span></span>
            </a>
            <div class="row collapse" id="change-description">
                <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'toolbox',
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array('style' => 'margin-top:50px', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data')
                    ));
                    ?>
                    <input type="hidden" name="userid" value="<?php if (!Yii::app()->user->isGuest) echo Yii::app()->user->id; ?>" />
                    <input type="hidden" name="save-yid" value="" />
                    <input type="hidden" name="save-title" value="" />
                    <input type="hidden" name="save-description" value="" />
                    <input type="hidden" name="save-image" value="" />
                    <div id='has-login'>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">
                                Change Headline
                                <span class="tl-large" data-toggle="tooltip" data-placement="top" title="Tiêu đề video khi post lên Facebook. Mặc định sẽ lấy tiêu đề của video Youtube">?</span>
                            </label>
                            <div class="col-sm-8">
                                <input name="YoutubeLink[fb_headline]" id="toolbox-headline" type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDescription" class="col-sm-4 control-label">
                                Change Description
                                <span class="tl-large" data-toggle="tooltip" data-placement="top" title="Mô tả video khi post lên Facebook. Mặc định sẽ lấy mô tả của video Youtube">?</span>
                            </label>
                            <div class="col-sm-8">
                                <input name="YoutubeLink[fb_description]" id="toolbox-description" type="text" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">
                                Change Thumbnail:
                                <span class="tl-large" data-toggle="tooltip" data-placement="top" title="Ảnh đại diện của video. Mặc định sẽ chọn ảnh của Youtube">?</span>
                            </label>
                            <div class="col-sm-8">
                                <?php echo $form->fileField($youtube, 'fb_thumbnail', array('class' => 'inputfile')); ?>
                            </div>
                        </div>
                        
<!--                        <div class="form-group">
                            <label for="inputpcredirect" class="col-sm-4 control-label">
                                PC Redirect
                                <span class="tl-large" data-toggle="tooltip" data-placement="top" title="Link Redirect khi click trên PC. Nếu không nhập thì mặc định sẽ play trên Facebook">?</span>
                            </label>
                            <div class="col-sm-8 <?php if (isset($member) && $member && $member->vip_status == 0): ?>has-error<?php endif; ?>">
                                <div class="checkbox text-left checkboxpc">
                                    <label>
                                        <?php if (isset($member) && $member && $member->vip_status == 1 && (strtotime($member->vip_end) > strtotime(date('Y-m-d H:i:s')) && $member->point > 5)): ?>
                                            <input type="checkbox" class="is-pc-redirect" value="checked">
                                        <?php else: ?>
                                            <input type="checkbox" class="is-pc-redirect" value="checked" disabled>Thành viên <a style="color: #fff;text-decoration: none;" href="#">VIP</a> mới được sử dụng chức năng này
                                        <?php endif; ?>
                                    </label>
                                </div>
                                <input type="text" name="YoutubeLink[purl_redirect]" class="form-control hidden pc-redirect">
                            </div>
                        </div>-->

                        <div class="form-group">
                            <label for="inputmredirect" class="col-sm-4 control-label">
                                Mobile Redirect
                                <span class="tl-large" data-toggle="tooltip" data-placement="top" title="Link redirect khi click trên Mobile. Mặc định sẽ vào link cả YT2FB">?</span>
                            </label>
                            <div class="col-sm-8 <?php if (isset($member) && $member && $member->vip_status == 0): ?>has-error<?php endif; ?>">
                                <div class="checkbox text-left">
                                    <label>
                                        <?php if (isset($member) && $member && $member->vip_status == 1 && (strtotime($member->vip_end) > strtotime(date('Y-m-d H:i:s')) && $member->point > 5)): ?>
                                            <input type="checkbox" class="is-m-redirect" value="checked">
                                        <?php else: ?>
                                            <input type="checkbox" class="is-m-redirect" value="checked" disabled>Thành viên <a style="color: #fff;text-decoration: none;" href="#">VIP</a> mới được sử dụng chức năng này
                                        <?php endif; ?>
                                    </label>
                                </div>
                                <input type="text" name="YoutubeLink[murl_redirect]" class="form-control hidden m-redirect">
                            </div>
                        </div>

                    </div>

                    <div id="not-login" class='form-group'>
                        Vui lòng <a style='color: red;' href='<?php echo Yii::app()->createUrl('site/login'); ?>'>Đăng nhập</a> để sử dụng chức năng này.
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-warning">Create Link</button>
                        <button type="button" class="btn btn-warning">Restart</button>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <h3 class="h3before">Trước</h3>
            <div class="before_box showbox" style="display: block;">
                <div style="background-image: url(&quot;https://i.ytimg.com/vi/4xTXKskbm38/maxresdefault.jpg&quot;); display: block;" class="thumb"></div>
                <div class="play"></div>
                <div class="data">
                    <div class="title">Title</div>
                    <div class="description">
                        Description
                    </div>
                    <div class="youtube">YOUTUBE.COM</div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xs-12">
            <h3 class="h3before">Sau</h3>
            <div class="after_box showbox" style="display: block;">
                <div style="background-image: url(&quot;https://i.ytimg.com/vi/zsqlxq85SXw/maxresdefault.jpg&quot;); display: block;" class="thumb"></div>
                <div class="play"></div>
                <iframe width="640" height="390" frameborder="0" rel="" id="video" allowfullscreen="1" title="YouTube video player" src=""></iframe>
                <div class="data data_big">
                    <div class="title" style="color: #fff;font-weight: bold; font-size: 15px; text-align: justify;">Title</div>
                    <div class="description">hidden</div>
                    <div class="youtube">FBADSPRO.NET</div>                                                
                </div>
            </div>
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