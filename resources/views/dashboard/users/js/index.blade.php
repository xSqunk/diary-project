<script>

    $(document).ready(function() {

        $('.class-signout').click(function() {

            let student_id = $(this).data('student_id');
            let name = $(this).data('student_name');

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz wypisać ucznia " + name + " z tej klasy?",
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
                        url: '{{route('class.student.remove')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'DELETE',
                        data: {
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
                        title: 'Wypisano!',
                        html: 'Uczeń został wypisany',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie wypisano ucznia',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });
        });

        $('.add-student').click(function() {
            $(this).hide();
            $('.add-student-accordion').fadeIn(300);
        });

        $('.add-student-button').click(function() {
            let select = $(this).parent().find('#student');
            let student_id = select.val();
            let class_id = select.data('class_id');
            let name = select.find('option:selected').text();

            if(!student_id) {
                swal.fire( {
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timerProgressBar: false,
                        type: 'error',
                        icon: 'error',
                        title: 'Wybierz ucznia z listy!',
                        timer: 3000
                    }
                );
                return;
            }

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz dodać ucznia " + name + " do tej klasy?",
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
                        url: '{{route('class.student.add')}}' + '?_token=' + '{{ csrf_token() }}',
                        type: 'PUT',
                        data: {
                            class_id: class_id,
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
                        html: 'Uczeń został dodany',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie dodano ucznia',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });
        });


        $('.delete-user').click(function() {

            let row = $(this).closest('tr');
            let hash_id = row.data('hash_id');
            let name = row.data('name');
            let surname = row.data('surname');

            swal.fire({
                title: 'Jesteś pewny?',
                text: "Czy napewno chcesz usunąć użytkownika " + name + " " + surname,
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
                        url: '{{route('users.delete')}}' + '?_token=' + '{{ csrf_token() }}',
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
                        html: 'Użytkownik został usunięty',
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Anulowano',
                        html: 'Nie usunięto użytkownika',
                        type: 'error',
                        icon: 'error'
                    })
                }
            });

        });
    });

</script>