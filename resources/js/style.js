/**
 * No Right Clicks
 */
$(document).on('contextmenu', function(e) {
  return false;
});


/**
 * Modal Open / Close
 */
$(function(){
    let i = $('[name=modalNo]').val()
    $('#Modal' + i).on('click',function(){
        $('#js-modal'+ i).fadeIn();
        return false;
    });
    $('#js-modal-close' + i).on('click',function(){
        $('#js-modal'+ i).fadeOut();
        return false;
    });
    $('#js-modal-close-btn' + i).on('click',function(){
        $('#js-modal'+ i).fadeOut();
        return false;
    });
});

/**
 * Modal Video Start / Stop
 */
$(function(){
    const allvideos = $('.all-videos').data();
    if (allvideos) {
        for (var i=0; i<allvideos.no; i++) {
            const video = document.getElementById('modalV'+i);
            $('#modalV'+i).click(function(){
                if(video.paused){
                    video.play();
                }else{
                    video.pause();
                }
            });
        }
    }
});

/**
 * VIEW COUNT
*/
 $(function () {
    const allvideos = $('.all-videos').data();
    if(allvideos) {
        for (var i=0; i<allvideos.no+1; i++) {
            const video = document.getElementById('modalV'+i);
            if(video) {
                video.addEventListener('play', (e) => {
                    var fd = new FormData();
                    fd.append('video_id', $(e.target).data("id"));
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url:'/view',
                        type:'post',
                        data: fd,
                        processData: false,
                        contentType: false,
                        cache: false,
                    });
                });
            }
        }
    }
});

const { upperFirst } = require("lodash");

$(window).on('load', function(){
  var cookies = document.cookie;

  /**
   * CHECK LIKE BUTTONS STATUS
   */
  let reactions = document.getElementsByClassName('reaction-count');
  if(reactions) {

    for(var i=0; i<reactions.length; i++){
      var val = reactions[i].attributes['video-id'].nodeValue;

      if(cookies.indexOf(val+"=1") != -1) {
        $('.'+val).css('opacity', "0.3");

      } else {
        $('.'+val).css('opacity', "1");
      }
    }
  }
});

/**
 * LIKE BUTTON HANDLER
 */
$('.reaction-count').on('click', function(e){

    var attr = $(this).attr("video-id");
    var cookies = document.cookie;
    
    // if liked
    var osita = 0;

    if ( cookies.indexOf(attr + "=1;") != -1) {
      osita = 1;
    }

    if ( cookies.indexOf(attr + "=0;") != -1) {
      osita = -1;
    }

    var reaction = 0;
    var videoId = -1;

    if( attr.startsWith("iine-")) {
        reaction = 1;
        videoId = attr.replace("iine-", "");

        if(osita == 1) {
        reaction = -1;
        }
    }

    
    // API CALL
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/api/likeIt",
        type: "POST",
        data: {"post_id": videoId, "reaction": 1},
        timeout: 1000,
    }).done(function(data){
        // Cookie SAVE
        if(reaction > 0) {
        document.cookie = attr + "=1";

        if( attr.startsWith("iine-")) {
            $('.iine-'+videoId).css("opacity", "0.3");
        }
        }

        if(reaction < 0) {
        document.cookie = attr + "=0";
        
        if( attr.startsWith("iine-")) {
            $('.iine-'+videoId).css("opacity", "1");
        }
        }
    })
});
