$(document).ready(function() {
   $( '.diary-input-error' ).change( function () {
      $( this ).removeClass( 'diary-input-error' );
   } );

   $( document ).ready( function () {
      $( '.input-select2' ).select2();
   } );
});