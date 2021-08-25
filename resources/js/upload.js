let chunkSize = 1 * 1024 * 1024; // Split 1M
let size = 0;
let count = 0;
let postForm = null;
let splitData = null;
let file = null;

/**
 * POST SUBMIT
 */
$('#submit').on('click', async (e) => {

    file = $('input[name="file-name"]').prop('files')[0];
    let teamname = $('[name=team]').val()

    if (file && teamname) {
        $('#now-loading').css("display", "block");
        $('#no').css("display", "none");
        $('#submit').css("display", "none");
        size = file.size;

        $('#sending').html("Sending ( 0 / " + size + " byte )");

        const name = `${(new Date()).getTime()}-${file.name}`;
        count = Math.ceil(size / chunkSize);

        for (let k = 0; k < count; k++) { 
            splitData = file.slice(k * chunkSize, (k + 1) * chunkSize);

            postForm = new FormData();
            postForm.append('file', splitData);
            postForm.append('name', name);

            let result = await fetch('/api/video-combine', {
                body: postForm,
                method: 'POST',
                headers: { Accept: 'application/json'}
            }).then(res => res);

            if(result.statusText != "OK") {
                k--;
                // wait 30sec
                await new Promise(res => setTimeout(() => {
                    res();
                }, 30000));
            }

            await new Promise(res => setTimeout(() => {
                res();
            }, 100));

            $('#sending').html("Sending ( " + ((k+1) * chunkSize) + " / " + size + " byte )");
        }
        
        let team = $('[name=team]').val()
        let view_mode = $('[name=view]').val()

        $('#sending').html("Checking data.");

        var fd = new FormData();
        fd.append('name', name);
        fd.append('team', team);
        fd.append('view_mode', view_mode);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        setTimeout(function(){
            location.reload();
        },100);

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
                $('#sending').html("Faild. Uploaded videos should be played on Windows Media Player. This won't be Public.");
            }
        });

    } else {
        return alert('Some not entered.');
    }
});


/**
 * POST VALIDATIONS
 */
$('#post_check').click(function(){
    var err = false;

    var team = $('[name=team]').val()
    if(team == "") {
        err = true;
    }

    var upfile = $('input[name="file-name"]').prop('files')[0];
    if(!upfile) {
        err = true;
    }

    if(!err) {
        $('#post_confirm').modal('show');
    } else {
        $('#post_denied').modal('show');
    }
});

/**
 * POST CONFIRM MODAL
 */
$('#post_confirm').on('show.bs.modal', function (event) {

    var modal = $(this);
    modal.find('#teamname').text($('[name=team]').val());
    modal.find('#show').text($("#view option:selected").text());
    let upfile = $('input[name="file-name"]').prop('files')[0].name;
    modal.find('#douga').text(upfile);
});


