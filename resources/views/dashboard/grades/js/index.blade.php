<script>

    $(document).ready(function() {
        $('.delete-grade').click(function() {

            let row = $(this).closest('tr');
            let id = row.data('id');
            let name = row.data('name');
            let surname = row.data('surname');

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz usunąć ocenę uczniowi " + name + " " + surname,
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
                        url: '{{route('grades.delete')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'DELETE',
                        data: {
                            id: id
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
                        html: 'Ocena została usunięta',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie usunięto oceny',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });

        });
    });

</script>