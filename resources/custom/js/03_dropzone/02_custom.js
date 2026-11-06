if (typeof setDrop !== "undefined") {
    if (setDrop === 'drop') {
        (function () {
            Dropzone.autoDiscover = false;
            $(".dropzone").dropzone({
                url: '/Dropzone/uploadArray',
                margin: 20,
                maxFilesize: 20,
                resizeQuality: 1,
                uploadMultiple: true,
                parallelUploads: 20,
                acceptedFiles: 'image/*,application/jpg,.png,.gif,.tiff,.nef,ai,.psd,.jpeg',
                dictDefaultMessage: 'Drop Deine Bilder zum Upload!',
                dictFallbackMessage: 'Dein Browser unterstützt dieses nicht!',
                dictInvalidFileType: 'Dieser Typ kann nicht benutzt werden!.',
                dictFileTooBig: 'Datei ist zu groß ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.',
                paramName: "files",
                params: {
                    'action': 'save'
                },
                success: function (res) {
                    res.previewElement.classList.add('dz-success');
                    console.log(res);
                    $("#info").html(res.xhr.response);
                }
            });
        }());
    } else {
        (function () {
            Dropzone.autoDiscover = false;
            //Setzen Sie entweder Dropzone.autoDiscover = false;
            // irgendwo in Ihrem JS. Stellen Sie nur sicher,
            // dass es aufgerufen wird, bevor das DOM-Ready-Ereignis gesendet wird.
            $(".dropzone").dropzone({
                url: '/verzeichniserstellung/upload',
                margin: 20,
                maxFilesize: 20,
                resizeQuality: 1,
                /*uploadMultiple:true,
                parallelUploads:20,*/
                acceptedFiles: 'image/*,application/jpg,.png,.gif,.tiff', //.nef,ai,.psd,.jpeg,.pdf',
                dictDefaultMessage: 'Drop Deine Bilder zum Upload!',
                dictFallbackMessage: 'Dein Browser unterstützt dieses nicht!',
                dictInvalidFileType: 'Dieser Typ kann nicht benutzt werden!.',
                dictFileTooBig: 'Datei ist zu groß ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.',
                paramName: "files",
                params: {
                    'action': 'save'
                },
                success: function (res) {
                    res.previewElement.classList.add('dz-success');
                    console.log(res);
                    $("#info").html(res.xhr.response);
                }
            });
        }());
    }
}
