$(document).ready(function() {
   $( '.diary-input-error' ).change( function () {
      $( this ).removeClass( 'diary-input-error' );
   } );

   $( document ).ready( function () {
      $( '.input-select2' ).select2();
   } );

   $('.is-dataTable').DataTable({
      "bFilter": true,
      "bPaginate": true,
      "bLengthChange": true,
      "bInfo": true,
      "bAutoWidth": false,
      "pageLength": 25,
      "columnDefs": [
         { "orderable": false, "targets": 0 }
      ],
      "language": {
         "paginate": {
            "previous": "Poprzednia",
            "next": "Następna",
         },
         "lengthMenu": "<span>Wyświetl</span> _MENU_ <span>wyników na stronie</span>",
         "zeroRecords": "Nie znaleziono wyników",
         "info": "Strona _PAGE_ z _PAGES_",
         "previous": "Poprzednia",
         "next": "Następna",
         "infoEmpty": "Brak wyników",
         "infoFiltered": "(filtrowanie z _MAX_ wyników)",
         "search": ""
      }
   });

   if($('.dataTables_length').length > 0) {
      $('.dataTables_length select').addClass('form-control');
   }

   if($('.dataTables_filter').length > 0) {
      $('.dataTables_filter input').addClass('form-control');

      $('.dataTables_filter input').attr('placeholder', 'Szukaj..');
   }
});