<?php $member = Member::model()->findByPk(Yii::app()->user->id); ?>
<header>
    <div class="container-fluid">
        <div class="row">
            <div class="inner">
                
                <?php $this->renderPartial('_user', array('member' => $member)); ?>
                
                <div class="col-sm-12 col-xs-12" id="topsearch">
                    <h1>YouTube Videos on Facebook Suck!</h1>
                    <h2>Biến video Youtube của bạn giống như video được up lên Facebook</h2>

                    <form method="post">
                        <div class="col-md-8 col-md-offset-2 col-xs-12 col-xs-offset-0" style="margin-top: 40px;">
                            <div class="input-group">
                                <input type="text" class="form-control input-link" placeholder="Paste a Youtube link to convert" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-private" type="button" data-toggle="collapse" data-target="#getvideo" aria-expanded="false" aria-controls="getvideo">Convert</button>
                                </span>
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </form>
                </div>

                <div class="col-sm-12 col-xs-12">
                    <?php $this->renderPartial('_getvideo', array('member' => $member, 'youtube' => $youtube)); ?>
                </div>

            </div>
        </div>
    </div>
</header>

<div class="container-fluid">
    <div id="before-after">
        <div class="inner">
            <h4>Tự động play video trên Facebook<br>giống như chúng thực sự được tải lên Facebook</h4>
            <div class="row">
                <div class="col-sm-5 col-xs-12">
                    <img src="http://19rra12pc32y3gvmfh3apf04.wpengine.netdna-cdn.com/wp-content/themes/yt2fb/before.jpg" />
                </div>
                <div class="col-sm-2 col-xs-12 vs-center">
                    vs
                </div>
                <!-- Add the extra clearfix for only the required viewport -->
                <div class="clearfix visible-xs-block visible-sm-block"></div>

                <div class="col-sm-5 col-xs-12">
                    <video width="550" height="450" id="demo">
                        <source type="video/mp4" src="http://19rra12pc32y3gvmfh3apf04.wpengine.netdna-cdn.com/wp-content/themes/yt2fb/play.mp4"></source>
                        Your browser does not support the video tag.
                    </video>
                    <script type="text/javascript">
                        var vid = document.getElementById("demo");
                        vid.playbackRate = 0.7
                        setTimeout(function() {
                            show_vid();
                        }, 3000);

                        jQuery('#demo').bind('ended', function() {
                            this.currentTime = 0;
                        })

                        function show_vid() {
                            vid.play();
                            window.setTimeout(function() {
                                show_vid()
                            }, 12000)
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>