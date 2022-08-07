<script>
    $(document).ready(function(){

        var categories = $('#categories').DataTable({
            responsive: true,
            processing: false,
            serverSide: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    extend: 'pdf', 
                    text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;Pdf', 
                    title: 'QuadQue'
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print',
                    customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                },
                {extend: 'csv',  title: 'QuadQue'}
            ],

            order: [[2, 'asc']]
        });
    });

</script>
