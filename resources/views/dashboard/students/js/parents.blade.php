<script>

    $(document).ready(function() {
        $('.add-parent').click(function() {
            $(this).hide();
            $('.add-parent-accordion').fadeIn(300);
        });

        $('.add-parent-button').click(function() {
            let select = $(this).parent().find('#parent');
            let parent_id = select.val();
            let student_id = select.data('student_id');
            let name = select.find('option:selected').text();

            if(!parent_id) {
                swal.fire( {
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timerProgressBar: false,
                    type: 'error',
                    icon: 'error',
                    title: 'Wybierz rodzica z listy!',
                    timer: 3000
                    }
                );
                return;
            }

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz dodać rodzica " + name,
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
                        url: '{{route('students.parents.add')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'PUT',
                        data: {
                            parent_id: parent_id,
                            student_id: student_id
                        },
                        success: function ( data ) {
                            console.log(data);
                        },
                        error: function ( data ) {
                            addError( _this, 'Błąd #00987' );
                        },
                    } );

                    swal.fire({
                        title: 'Dodano!',
                        html: 'Rodzic został dodany',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie dodano rodzica',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });
        });

        $('.delete-parent').click(function() {

            let row = $(this).closest('tr');
            let name = row.data('name');
            let surname = row.data('surname');
            let parent_id = $(this).data('parent_id');
            let student_id = $(this).data('student_id');

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz usunąć rodzica " + name + " " + surname,
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
                        url: '{{route('students.parents.delete')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'DELETE',
                        data: {
                            parent_id: parent_id,
                            student_id: student_id,
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
                        html: 'Rodzic został usunięty',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie usunięto rodzica',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });

        });
    });

</script>