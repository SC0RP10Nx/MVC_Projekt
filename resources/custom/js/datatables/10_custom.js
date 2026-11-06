$(function (){
    $('#meineTabelle').DataTable({
        responsive:true,
        "language":{
            "url":"/plugins/datatables/dataTables.german.json"
        },
        //cardView: {
         //   mode: 'cards',
            //template: DataTable.CardView.templates.miniTable
        //    template: DataTable.CardView.templates.dlList
       //}
        cardView: true,
        layout: {
            topStart: [
                {
                    buttons: ['cardViewToggle']
                },
                'pageLength'
            ]
        }

    })
    $('#meineTabelleBt').DataTable({
        responsive:true,
        "language":{
            "url":"/plugins/datatables/dataTables.german.json"
        },
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        }
    })
})