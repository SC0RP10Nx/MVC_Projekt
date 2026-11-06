$(function () {

    function getBase64Image(url, callback) {
        const img = new Image();

        img.onload = function () {
            const canvas = document.createElement('canvas');
            canvas.width = img.naturalWidth;
            canvas.height = img.naturalHeight;

            const ctx = canvas.getContext('2d');
            ctx.drawImage(img, 0, 0);

            callback(canvas.toDataURL('image/png'));
        };

        img.onerror = function () {
            console.error('Bild konnte nicht geladen werden:', url);
        };

        img.src = url;
    }

    let logoBase64 = '';

    getBase64Image('/images/icon/fc.png', function (base64) {
        logoBase64 = base64;
    });
    $('#imgDownload').DataTable({
        responsive: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
    $('#datatablesTest').DataTable({
        responsive: true,
        colReorder: true,
        "language": {
            "url": "../plugins/dataTables.german.json"

        },
        "scrollX": true
    });
    $('#mueller').DataTable({
        responsive: {
            details: {
                display: DataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: DataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        pagingType: 'first_last_numbers',
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
    $('#raten').DataTable({
        responsive: true,
        pagingType: 'first_last_numbers',
        "language": {
            "url": "../plugins/dataTables.german.json"
        }, layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
            }, bottomStart: {
                pageLength: {
                    menu: [10, 25, 50, 100]
                }
            }
            //topStart
            // top
            // topEnd
            // bottomStart
            // bottom
            // bottomEnd
        }
    });
    $('#annuitaeten').DataTable({
        responsive: true,
        pagingType: 'first_last_numbers',
        colReorder: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        }, layout: {
            topStart: {
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        title: "Mein PDF",
                        filename: 'mueller',
                        orientation: 'portrait', //portrait   landscape
                        pageSize: 'A4', //A3 , A5 , A6 ,
                        extension: '.pdf',
                        text: 'PDF',
                        exportOptions: {
                            modifier: {
                                //page: 'current'   // einzelne Seiten
                            },
                            columns: ':visible',
                            search: 'applied',
                            order: 'applied'
                        },
                        customize: function (doc) {
                            doc.content.splice(1, 0, {
                                margin: [0, 0, 0, 0],
                                alignment: 'center',
                                image: logoBase64,
                                width: 100,
                            });
                        }
                    }
                ]
            }
        }
    });
    $('#endfaelliges').DataTable({
        responsive: true,
        select: true,
        pagingType: 'first_last_numbers',
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
    $('#example').DataTable({
        responsive: true,
        layout: {
            bottomStart: {
                'info': true,
                buttons: [{
                    extend: 'pdfHtml5',
                    title: "Mein PDF",
                    filename: 'mueller',
                    orientation: 'landscape', //portrait
                    pageSize: 'A4', //A3 , A5 , A6 ,
                    extension: '.pdf',
                    text: 'PDF',
                    exportOptions: {
                        modifier: {
                            //page: 'current'   // einzelne Seiten
                        },
                        columns: ':visible',
                        search: 'applied',
                        order: 'applied'
                    }
                }, 'copy', 'csv', 'excel', 'pdf', 'print']
            }
        },
        lengthMenu: [10, 25, 50, 75, {label: 'All', value: -1}],
        // paging: true,
        // info: true,
        // lengthChange: true,
        pagingType: 'first_last_numbers',  //first_last_numbers   simple_numbers  full_numbers full numbers simple
        "oLanguage": {
            "oPaginate": {
                "sFirst": "«",
                "sLast": "»",
                "sNext": "›",
                "sPrevious": "‹",
            }
        },

        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
});