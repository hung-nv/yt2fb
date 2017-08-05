<?php $current = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>
<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"> 
    <head>
        <?php if (isset($murl) && $murl!=''): ?>
            <script type="text/javascript">
                if (screen.width <= 699) {
                    window.location = "<?php echo $murl; ?>";
                }
            </script>
        <?php endif; ?>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <script src="https://www.youtube.com/iframe_api"></script>
        <link type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/video.css" rel="stylesheet" />
        <link href="<?php echo $current; ?>" rel="canonical" />
        
        <title>Watch "<?php echo $youtube->fb_headline; ?>" HD in VIDEO+</title>
        <meta name="description" content="<?php echo $youtube->fb_description; ?>" />
        <meta itemprop="name" content="<?php echo $youtube->fb_headline; ?>" />
        <meta itemprop="description" content="<?php echo $youtube->fb_description; ?>" />
        <meta itemprop="image" content="<?php echo $youtube->fb_thumbnail; ?>" />

        <meta property="og:title" content="<?php echo $youtube->fb_headline; ?>" />
        <meta property="og:description" content="<?php echo $youtube->fb_description; ?>" />
        <meta property="og:image" content="<?php echo $youtube->fb_thumbnail; ?>" />


        <meta property="og:video" content="http://www.youtube.com/v/<?php echo $youtube->youtube_id; ?>?version=3" />
        <meta content="360" property="og:video:height" />
        <meta content="application/x-shockwave-flash" property="og:video:type" />
        <meta content="640" property="og:video:width" />
        <meta content="video" property="og:type" />

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function($) {
                var width = $(window).width();
                var height = width / 1.78;
                $('iframe').height(height);
            });
        </script>

    </head>

    <body>
        <div class="container">
            <div class="inner">
                <div rel="" id="show_video">
                    <div class="video">
                        <iframe frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen id="video" title="YouTube video player" src="https://www.youtube.com/embed/<?php echo $youtube->youtube_id; ?>"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>