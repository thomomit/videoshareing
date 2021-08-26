/**
 * POST SUBMIT
 */
$('#submit').on('click', async (e) => {

    // get the video file data
    let file = $('input[name="file_name"]').prop('files')[0];

    $('#now-loading').css("display", "block");
    $('#no').css("display", "none");
    $('#submit').css("display", "none");

    // get the video file size
    let size = file.size;

    // create the video file name
    const file_name = `${(new Date()).getTime()}-${file.name}`;

    // set HTML "Sending 0 / XXXXXXXXX byte"
    $('#sending').html("Sending ( 0 / " + size + " byte )");

    // Split 1M
    let chunkSize = 1 * 1024 * 1024;

    // the number of files created by dividing the video by 1M
    let count = Math.ceil(size / chunkSize);

    // loop through each file and call the Combine API
    for (let k = 0; k < count; k++) {

        // slice the vieo file every 1M from the beginning
        let splitData = file.slice(k * chunkSize, (k + 1) * chunkSize);

        // prepare the upload form
        var postForm = new FormData();

        // add the sliced file
        postForm.append('file', splitData);

        // add the video file name
        postForm.append('file_name', file_name);

        // call the video-combine API
        let result = await fetch('/api/video-combine', {
            body: postForm,
            method: 'POST',
            headers: { Accept: 'application/json'}
        }).then(res => res);

        if(result.statusText != "OK") {
            k--;
            await new Promise(res => setTimeout(() => {
                res();
            }, 30000));
        }

        await new Promise(res => setTimeout(() => {
            res();
        }, 100));

        // set HTML "Sending XXXXXX / XXXXXXXXX byte"
        $('#sending').html("Sending ( " + ((k+1) * chunkSize) + " / " + size + " byte )");
    }

    // get the video title
    const video_title = $('[name=video_title]').val()
    
    // get the view mode
    const view_mode = $('[name=view_mode]').val()

    // set HTML "Checking data...."
    $('#sending').html("Checking data....");

    // prepare the upload form
    var fd = new FormData();

    // add the video file name
    fd.append('file_name', file_name);

    // add the video title 
    fd.append('video_title', video_title);

    // add the view_mode
    fd.append('view_mode', view_mode);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    setTimeout(function(){
        location.reload();
    },100);

    // call the video-save API
    $.ajax({
        url:'/video-save',
        type:'post',
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
    })
    .done(function(data) {
        if(data !== "OK") {
            // set the ERROR MESSAGE
            $('#sending').html("Faild. Videos should be the one that can be played on Windows Media Player. This won't be Public.");
        }
    });
});


/**
 * POST VALIDATIONS
 */
$('#post_check').click(function(){
    var err = false;

    // check title
    var videotitle = $('[name=video_title]').val()
    if(videotitle == "") {
        err = true;
    }

    // check video
    var upfile = $('input[name="file_name"]').prop('files')[0];
    if(!upfile) {
        err = true;
    }

    if(!err) {
        // open COMFIRM MODAL
        $('#post_confirm').modal('show');
    } else {
        // open VALIDATION ERROR MODAL
        $('#post_denied').modal('show');
    }
});

/**
 * POST COMFIRM MODAL
 */
$('#post_confirm').on('show.bs.modal', function (event) {

    var modal = $(this);
    modal.find('#modal_video_title').text($('[name=video_title]').val());
    modal.find('#modal_view_mode').text($("#view_mode option:selected").text());
    let upfile = $('input[name="file_name"]').prop('files')[0].name;
    modal.find('#douga').text(upfile);
});


