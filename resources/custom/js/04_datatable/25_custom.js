$(function () {
    $('#mueller1').DataTable({
        responsive: true,
        layout: {
            topStart: {
                buttons: [{
                    extend: 'collection',
                    text: 'Export',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
                }]
            }
        },
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
    $('#raten1').DataTable({
        responsive: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        }
    });
    $('#annuitaeten1').DataTable({
        responsive: true,
        colReorder: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        }
    });
    $('#endfaelliges1').DataTable({
        responsive: true,
        select: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });


//Editor
    const editor1 = new DataTable.Editor({
        ajax: '/ajax/test.json',
        fields: [
            {
                label: 'First name:',
                name: 'first_name'
            },
            {
                label: 'Last name:',
                name: 'last_name'
            },
            {
                label: 'Position:',
                name: 'position'
            },
            {
                label: 'Office:',
                name: 'office'
            },
            {
                label: 'Extension:',
                name: 'extn'
            },
            {
                label: 'Start date:',
                name: 'start_date',
                type: 'datetime'
            },
            {
                label: 'Salary:',
                name: 'salary'
            }
        ],
        table: '#editor1'
    });

    $('#editor1').DataTable({
        ajax: '/ajax/test.json',
        columns: [
            {
                data: null,
                render: (data) => data.first_name + ' ' + data.last_name
            },
            {data: 'position'},
            {data: 'office'},
            {data: 'extn'},
            {data: 'start_date'},
            {data: 'salary', render: DataTable.render.number(null, null, 0, '$')}
        ],
        layout: {
            topStart: {
                buttons: [
                    {extend: 'create', editor: editor1},
                    {extend: 'edit', editor: editor1},
                    {extend: 'remove', editor: editor1}
                ]
            }
        },
        responsive: true,
        select: true,
        "language": {
            "url": "../plugins/dataTables.german.json"
        },
    });
    const editor2 = new DataTable.Editor({
        ajax: '/ajax/test.json',
        fields: [
            {
                label: 'First name:',
                name: 'first_name'
            },
            {
                label: 'Last name:',
                name: 'last_name'
            },
            {
                label: 'Position:',
                name: 'position'
            },
            {
                label: 'Office:',
                name: 'office'
            },
            {
                label: 'Extension:',
                name: 'extn'
            },
            {
                label: 'Start date:',
                name: 'start_date',
                type: 'datetime'
            },
            {
                label: 'Salary:',
                name: 'salary'
            }
        ],
        table: '#editor2'
    });

    const table = new DataTable('#editor2', {
        ajax: '/ajax/test.json',
        columns: [
            {
                data: null,
                orderable: false,
                render: DataTable.render.select()
            },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'position' },
            { data: 'office' },
            { data: 'start_date' },
            { data: 'salary', render: DataTable.render.number(null, null, 0, '$') },
            {
                data: null,
                defaultContent:
                    '<div class="action-buttons">' +
                    '<span class="edit"><i class="bi bi-pencil-fill"></i></span> ' +
                    '<span class="remove"><i class="bi bi-trash-fill"></i></span> ' +
                    '<span class="cancel"></span>' +
                    '</div>',
                className: 'row-edit dt-center',
                orderable: false
            }
        ],
        layout: {
            topStart: {
                buttons: [
                    { extend: 'create', editor: editor2 },
                    { extend: 'edit', editor: editor2 },
                    { extend: 'remove', editor: editor2 }
                ]
            }
        },
        order: [[1, 'asc']],
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });

// Activate an inline edit on click of a table cell
    table.on('click', 'tbody span.edit', function (e) {
        editor2.inline(table.cells(this.closest('tr'), '*').nodes(), {
            cancelHtml: '<i class="bi bi-x-square-fill"></i>',
            cancelTrigger: 'span.cancel',
            submitHtml: '<i class="bi bi-floppy-fill"></i>',
            submitTrigger: 'span.edit'
        });
    });

// Delete row
    table.on('click', 'tbody span.remove', function (e) {
        editor2.remove(this.closest('tr'), {
            title: 'Delete record',
            message: 'Are you sure you wish to delete this record?',
            buttons: 'Delete'
        });
    });
});