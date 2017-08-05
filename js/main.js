jQuery(document).ready(function($) {

    jQuery('.home_pro h4').click(function() {
        jQuery(this).siblings('.details').fadeIn();
        jQuery('html, body').animate({
            scrollTop: jQuery(".home_pro").offset().top
        }, 400);
    })

    var url = window.location.href;

    // if (url.indexOf("paid=") >= 0) {

    // 	ajaxurl = '/wp-admin/admin-ajax.php';

    // 	var arr = url.split('paid=');
    //         	console.log(arr[1]);

    // 	jQuery.ajax({
    //         url: ajaxurl,
    //         data: {
    //             'action':'add_paid_view', 'pid':arr[1]
    //         },
    //         success:function(data) {
    //         	console.log(data);
    //         }
    //     });

    // }

    if (jQuery('#show_video').length > 0) {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            start_youtube();
            setTimeout(function() {
                var delaytime = 600;
                jQuery('.rel_title').fadeIn();
                jQuery('.rel_video').each(function() {
                    jQuery(this).delay(delaytime).animate({width: "90%"}, 1000);
                    delaytime += 600;
                });
            }, 15000);
            setTimeout(function() {
                jQuery('.ads').css('opacity', 1);

                if (window.innerHeight < window.innerWidth) {
                    jQuery('.video').insertAfter('#text-2');
                }
            }, 4000);
        } else {

            start_youtube();
            setTimeout(function() {
                jQuery('.ads').css('opacity', 1);
            }, 5000);
            setTimeout(function() {
                var delaytime = 600;
                jQuery('.rel_title').fadeIn();
                jQuery('.rel_video').each(function() {
                    jQuery(this).delay(delaytime).animate({width: "18%"}, 1000);
                    delaytime += 600;
                });
            }, 3000);
        }
        setTimeout(function() {
            ajaxurl = '/wp-admin/admin-ajax.php';
            jQuery.ajax({
                url: ajaxurl,
                data: {
                    'action': 'add_count', 'id': jQuery('#clickme').attr('rel')
                },
                success: function(data) {
                    // console.log(data);
                    if (data > 100) {
                        jQuery('.ads').css('opacity', 1);
                        // jQuery('.ads').css('opacity',1).animate({height:300},500);
                        // console.log('tttt');
                    }
                }
            });
        }, 5000);

        // setTimeout(function(){
        // 	// var url      = window.location.href;
        // 	// console.log(url);
        // 	ajaxurl = '/wp-admin/admin-ajax.php';
        // 	jQuery.ajax({
        //         url: ajaxurl,
        //         data: {
        //             'action':'check_paid_related'
        //         },
        //         success:function(data) {
        //         	if (data) {
        //         		jQuery('.next_video').remove();
        //         		jQuery('.rel_title').after(data);
        //         		console.log('test');
        //         		// console.log(data);
        //         	}
        //         }
        //     });
        // }, 1000);

        jQuery('a.social').click(function() {
            ajaxurl = '/wp-admin/admin-ajax.php';
            jQuery.ajax({
                url: ajaxurl,
                data: {
                    'action': 'add_share_count', 'id': jQuery('#clickme').attr('rel')
                },
                success: function(data) {
                }
            });

        })
    }

    jQuery('.search').focus();

    jQuery('.copy_to_clipboard').click(function() {
        copyToClipboard('.results');
        jQuery(this).val('Copied');
    })

    jQuery("[type='submit']").click(function() {
        jQuery('.subput').val('Converting. Wait. ');
    })

    if (jQuery('.playnow').length > 0) {
        url = jQuery('.openyoutube').attr('href');
        window.location.href = url;
    }

    if (jQuery('.counter').length > 0) {
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        } else {
            url = jQuery('.openyoutube').attr('href');
            window.location.href = url;
        }
        setTimeout(function() {
            jQuery('.counter').text('2');
        }, 2000);
        setTimeout(function() {
            jQuery('.counter').text('1');
        }, 3000);
        setTimeout(function() {
            url = jQuery('.openyoutube').attr('href');
            window.location.href = url;
        }, 4000);

    }

    jQuery('.related').on('click', '.rel_video', function() {

        id = jQuery(this).attr('rel');
        old_url = window.location.href;

        var new_url = old_url.substring(0, old_url.indexOf('?rel'));

        paid = false;

        if (jQuery(this).hasClass('paid')) {
            paid = "&paid=" + jQuery(this).attr('title');
        }

        if (paid) {
            window.location = new_url + '?rel=' + id + paid;
            // console.log(new_url+'?rel='+id+paid);
        } else {
            window.location = new_url + '?rel=' + id;
            // console.log(new_url+'?rel='+id);
        }
        return false;

    })

    jQuery('.share').click(function() {
        fbShare(jQuery('.results').val());
    })

    jQuery('.results').click(function() {
        jQuery(this).select();
    });

    function copyToClipboard(element) {
        var urlField = document.querySelector(element);
        urlField.select();
        document.execCommand('copy');
    }

    function fbShare(url, title, descr, image, winWidth, winHeight) {
        winWidth = 570;
        winHeight = 600;
        var winTop = (jQuery(window).height() / 2) - (winHeight / 2);
        var winLeft = (jQuery(window).width() / 2) - (winWidth / 2);
        console.log(jQuery(window).height());
        console.log(jQuery(window).width());
        console.log(winTop);
        console.log(winLeft);
        var win = window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + descr + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
        win.moveTo(winLeft, winTop);
    }

    function start_youtube() {

        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        // setTimeout(function(){

        var player;

        window.onYouTubeIframeAPIReady = function() {
            player = new YT.Player('video', {
                height: '390',
                width: '640',
                videoId: jQuery('.video').attr('rel'),
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        };

        // }, 500);


        function onPlayerStateChange(e) {

            if (e.data === 0) {
                // console.log(e.data);
                console.log('finished');
                jQuery('.next_video').click();

            }
        }

        function onPlayerReady(event) {

            if (jQuery('.video').attr('name') > 0) {
                start = jQuery('.video').attr('name');
                event.target.seekTo(start);
            }

            if (jQuery('.video').hasClass('autoplay')) {
                event.target.playVideo();
            }

            if (jQuery('.video').hasClass('paid')) {
                event.target.seekTo(0);
                event.target.stopVideo();
            }

            h = jQuery(window).height() - 90;
            h2 = jQuery('.video img').height();

            if (h2 < 50)
                h2 = 300;

            console.log(h2);

            jQuery('.video img, iframe').css('max-height', h);
            // jQuery( window ).load(function() {
            jQuery('#show_video iframe').css('height', h2);
            jQuery('.video img').remove();
            // if (jQuery('.adsbygoogle').length) {
            //        setTimeout(function(){
            // 		w = jQuery(window).width() - 30;
            // 		units = Math.floor(w/728);
            // 		if (units>3) units=3;
            // 	    adcode = '<div class="ad">'+jQuery('.ad').html()+'</div>';
            // 	    totalads = '';
            // 		for (i = 0; i < units; i++) { 
            // 			totalads += adcode;
            // 		}
            // 		if (units>0) jQuery('.ads').html(totalads);
            // 	}, 2000);
            // }
            // });
        }
    }

});