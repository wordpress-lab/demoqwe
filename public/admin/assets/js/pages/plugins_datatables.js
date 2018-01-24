$(function() {
    // datatables
    altair_datatables.dt_individual_search();

});

altair_datatables = {
    dt_individual_search: function() {
        var $dt_individual_search = $('#data_table');
        $dt_buttons = $dt_individual_search.prev('.dt_colVis_buttons');

        if($dt_individual_search.length) {

            // Setup - add a text input to each footer cell
            $dt_individual_search.find('tfoot th').each( function() {
                var title = $dt_individual_search.find('tfoot th').eq( $(this).index() ).text();
                $(this).html('<input type="text" class="md-input" placeholder="' + title + '" />');
            } );

            // reinitialize md inputs
            altair_md.inputs();

            // DataTable
            var individual_search_table = $dt_individual_search.DataTable({
                "pageLength": 50,

                buttons: [
                    {
                        extend:    'copyHtml5',
                        text:      '<i class="uk-icon-files-o"></i> Copy',
                        titleAttr: 'Copy'
                    },
                    {
                        extend:    'print',
                        text:      '<i class="uk-icon-print"></i> Print',
                        titleAttr: 'Print'
                    },
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="uk-icon-file-excel-o"></i> XLSX',
                        titleAttr: ''
                    },
                    {
                        extend:    'csvHtml5',
                        text:      '<i class="uk-icon-file-text-o"></i> CSV',
                        titleAttr: 'CSV'
                    },
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="uk-icon-file-pdf-o"></i> PDF',
                        titleAttr: 'PDF'
                    }
                ]
            });

            individual_search_table.on( 'search.dt', function (e) {
                //  console.log($('input[type=search]').val());
            } );
            individual_search_table.buttons().container().appendTo( $dt_buttons );

            // Apply the search
            individual_search_table.columns().every(function() {
                var that = this;

                $('input', this.footer()).on('keyup change', function() {
                    that
                        .search( this.value )
                        .draw();
                } );
            });

        }
    }


};



