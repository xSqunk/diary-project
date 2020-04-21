<script>

    $(document).ready(function() {
        $('.delete-class').click(function() {

            let row = $(this).closest('tr');
            let hash_id = row.data('hash_id');
            let name = row.data('name');

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz usunąć klasę " + name,
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tak',
                cancelButtonText: 'Anuluj',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false
            }).then((result) => {
                if (result.value) {
                    $.ajax( {
                        url: '{{route('classes.delete')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'DELETE',
                        data: {
                            hashId: hash_id
                        },
                        success: function ( data ) {
                            console.log(data);
                        },
                        error: function ( data ) {
                            addError( _this, 'Błąd #00987' );
                        },
                    } );

                    swal.fire({
                        title: 'Usunięto!',
                        html: 'Klasa została usunięta',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie usunięto klasy',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });

        });
    });

</script>