$(document).ready(function() {
    $('#process-file-button').on('click', function (e) {
        let files = new FormData();
        files.append('fileName', $('#file')[0].files[0]);

        $.ajax({
            type: 'post',
            url: "{{ path('api_file_upload') }}",
            processData: false,
            contentType: false,
            data: files,
            success: function () {
                location.reload();
            },
            error: function (err) {
                alert(JSON.parse(err.responseText).error);
                location.reload();
            }
        });
    });
});