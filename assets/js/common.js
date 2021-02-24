/*
 * Главный JavaScript файл предназначеный для работы сайта
 * Date: 09.02.2017
 * Version: 0.1
 */

/*
 * Tooltips
 */
$('body').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
});


/*
 * Popover
 */
if ($('[data-toggle="popover"]')[0]) {
    $('[data-toggle="popover"]').popover();
}

function fly_p(name, text){
    var fly_id = Math.floor(Math.random() * (111111111));
    $("#notifier-box").append('<div class="alert alert-'+ name +'" id="fly_'+ fly_id +'">'+ text +'</div>');
    $("#fly_"+fly_id).fadeIn("slow");
    setTimeout(function(){fly_r(fly_id)},3000);
}
function fly_r(id){
    $("#fly_"+id).fadeOut("slow");
}

function resizeContent()
{
    if(($(".page-content").height()) > $(".sidebar").height()) {

        $(".sidebar").height($(".page-content").height()  + $(".page-head").height() + 30);
        if($(".page-wrapper").height() < $(".page-content").height())
        {
            $(".page-wrapper").height($(".sidebar").height());
        }
    } else {
        if($(".page-content").height() < 691) {
            $(".sidebar").height(691);
        } else {
            $(".sidebar").height($(".page-content").height() + $(".page-head").height() + 30);
        }

        $(".page-wrapper").height($(".sidebar").height());
    }
}

resizeContent();

$(document).ready(function () {

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        resizeContent();
    })

    // Media Gallery [Start]

    var file_chooser_id;
    var file_chooser_type;
    var media_modal_opened = false;

    $("body").on("click", ".media-gallery-choose-file", function () {
        file_chooser_id = $(this).attr("data-id");
        file_chooser_type = $(this).attr("data-type");
        updateFilesSize();
        $("#mediaGalleryModal").modal("show");
    });

    $("body").on("click", ".media-gallery-remove-file", function () {
        if($(this).attr("data-type") == 1) {
            $("#" + $(this).attr("data-id") + "_name").html("Изображения нет");
            $("#" + $(this).attr("data-id") + "_input_name").val("Изображения нет");
            $("#" + $(this).attr("data-id") + "_input").val("");
            $("#" + $(this).attr("data-id") + "_bg").css("background-image", "url()");
        } else {
            $("#" + $(this).attr("data-id") + "_name").html("Аудио нет");
            $("#" + $(this).attr("data-id") + "_input_name").val("Аудио нет");
            $("#" + $(this).attr("data-id") + "_input").val("");
        }
    });

    function loadFileListGallery()
    {
        $("#gallery_images").html("");
        $("#gallery_all").html("");
        $("#gallery_audio").html("");
        $.ajax({
            url: "/files/getgallery",
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
                for(var i = 0; i < data.length; i++) {
                    if(data[i].file_type == 1) {
                        $("#gallery_images").append(' <a href="#" class="file-element" data-name="' + data[i].file_name + '" data-type="1" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><img class="media-object btn btn-default" style="width: 70px; height: 70px" src="' + data[i].file_url + '"></a>');
                        $("#gallery_all").append(' <a href="#" class="file-element" data-name="' + data[i].file_name + '" data-type="1" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><img class="media-object btn btn-default" style="width: 70px; height: 70px" src="' + data[i].file_url + '"></a>');
                    } else {
                        $("#gallery_audio").append(' <a href="#" class="file-element btn btn-default" data-name="' + data[i].file_name + '" data-type="2" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><i class="fa fa-music" style="line-height: 59px;font-size:28px;text-align:center;display:block;color:#bdc4c9;width: 44px;height: 56px;"></i></a>');
                        $("#gallery_all").append(' <a href="#" style="margin-top: -62px;" class="file-element btn btn-default" data-name="' + data[i].file_name + '" data-type="2" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><i class="fa fa-music" style="line-height: 59px;font-size:28px;text-align:center;display:block;color:#bdc4c9;width: 44px;height: 56px;"></i></a>');
                    }
                }
            }
        });
    }

    function loadFileListOwn()
    {
        $("#own_images").html("");
        $("#own_all").html("");
        $("#own_audio").html("");
        $.ajax({
            url: "/files/getown",
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
                for(var i = 0; i < data.length; i++) {
                    if(data[i].file_type == 1) {
                        $("#own_images").append(' <a href="#" class="file-element" data-name="' + data[i].file_name + '" data-type="1" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><img class="media-object btn btn-default" style="width: 70px; height: 70px" src="' + data[i].file_url + '"></a>');
                        $("#own_all").append(' <a href="#" class="file-element" data-name="' + data[i].file_name + '" data-type="1" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><img class="media-object btn btn-default" style="width: 70px; height: 70px" src="' + data[i].file_url + '"></a>');
                    } else {
                        $("#own_audio").append(' <a href="#" class="file-element btn btn-default" data-name="' + data[i].file_name + '" data-type="2" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><i class="fa fa-music" style="line-height: 59px;font-size:28px;text-align:center;display:block;color:#bdc4c9;width: 44px;height: 56px;"></i></a>');
                        $("#own_all").append(' <a href="#" style="margin-top: -62px;" class="file-element btn btn-default" data-name="' + data[i].file_name + '" data-type="2" data-url="' + data[i].file_url + '" data-toggle="tooltip" data-placement="top" title="'+ data[i].file_name +'"><i class="fa fa-music" style="line-height: 59px;font-size:28px;text-align:center;display:block;color:#bdc4c9;width: 44px;height: 56px;"></i></a>');
                    }
                }
            }
        });
    }

    function updateFilesSize()
    {
        $.ajax({
            url: "/files/getsize",
            type: "POST",
            success: function (data) {
                data = JSON.parse(data);
                $("#gallery_size").html(data.size + " / 60 MB");
            }
        });
    }

    function hidedropZone() {
        $("#dropzone").css("display", "none");
    }

    var upload = function(files) {
        var formData = new FormData(),
            xhr = new XMLHttpRequest(),
            x;

        formData.append('file', files[0]);

        xhr.onload = function() {
            console.log(this.responseText);
            var data = JSON.parse(this.responseText);
            switch(data.status){
                case "success":
                    fly_p("success", data.success);
                    loadFileListOwn();
                    updateFilesSize();
                    $("#fileUploadBtn").html('<i class="fa fa-check"></i> Файл загружен');
                    setTimeout(function () {
                        $("#fileUploadBtn").html('<i class="fa fa-cloud-upload"></i> Выбрать файл');
                    }, 5000);
                    break;
                case "error":
                    fly_p("danger", data.error);
                    $("#fileUploadBtn").html('<i class="fa fa-remove"></i> ' + data.error);
                    setTimeout(function () {
                        $("#fileUploadBtn").html('<i class="fa fa-cloud-upload"></i> Выбрать файл');
                    }, 5000);
                    break;
            }
        };

        xhr.open('post', '/files/upload');
        xhr.send(formData);
    };

    $('#fileToUpload').change(function(){
        files = this.files;
        upload(files);
    });

    $("#fileToUpload").click();

    $("#fileUploadBtn").click(function () {
        $("#fileToUpload").click();
        return false;
    });

    var dropZone = $('body'),
        maxFileSize  = 209715200;

    dropZone.on('dragover', function(e){
        e.preventDefault();
        $("#dropzone").css("opacity", "1");
        $("#dropzone").css("display", "block");
    });
    dropZone.on('dragleave', function(e){
        e.preventDefault();
        $("#dropzone").css("opacity", "0");
        setTimeout(hidedropZone, 2000);
    });
    dropZone.on('drop', function(e){

        if(media_modal_opened) {
            e.preventDefault();
            $("#dropzone").css("opacity", "0");
            setTimeout(hidedropZone, 2000);
            event.preventDefault();

            var file = event.dataTransfer.files[0];
            upload(event.dataTransfer.files);
        }
    });

    $('#mediaGalleryModal').on('show.bs.modal', function () {
        loadFileListGallery();
        loadFileListOwn();
        updateFilesSize();
        media_modal_opened = true;
    });

    $("#mediaGalleryModal").on("hide.bs.modal", function() {
        media_modal_opened = false;
    });

    $("body").on("click", ".file-element", function () {
        $(this).dblclick(function () {
            if($(this).attr("data-type") == 2){
                $("#" + file_chooser_id + "_name").html($(this).attr("data-name"));
                $("#" + file_chooser_id + "_input_name").val($(this).attr("data-name"));
                $("#" + file_chooser_id + "_input").val($(this).attr("data-url"));
                $("#mediaGalleryModal").modal("hide");
                return 1;
            }
        });

        if($(this).attr("data-type") == 2){
            fly_p("warning", "Для выбора аудио файла, нажмите на него два раза.")
            $("#gallery-audio-player").attr("src", $(this).attr("data-url"));
            document.getElementById("gallery-audio-player").play();
            document.getElementById("gallery-audio-player").volume = 0.40;
        } else {
            $("#" + file_chooser_id + "_name").html($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input_name").val($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input").val($(this).attr("data-url"));
            $("#" + file_chooser_id + "_bg").css("background-image", "url(" + $(this).attr("data-url") + ")");
            $("#mediaGalleryModal").modal("hide");
        }
        return false;
    });

    $("body").on("dbclick", ".file-element", function () {
        if($(this).attr("data-type") == 2){
            $("#" + file_chooser_id + "_name").html($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input_name").val($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input").val($(this).attr("data-url"));
            $("#mediaGalleryModal").modal("hide");
        } else {
            $("#" + file_chooser_id + "_name").html($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input_name").val($(this).attr("data-name"));
            $("#" + file_chooser_id + "_input").val($(this).attr("data-url"));
            $("#" + file_chooser_id + "_bg").css("background-image", $(this).attr("data-url"));
        }
    });

    // Media Gallery [End]
});