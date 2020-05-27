<script>
    $(document).ready(function() {
        $('.status').change(function() {
            console.log('111');
            let student_id = $(this).closest('tr').data('student_id');
            let lesson_id = $(this).closest('tr').data('lesson_id');
            let status = $(this).val();
            $.ajax( {
                url: '{{route('presents.save')}}' + '?_token=' + '{{ csrf_token() }}',
                type: 'POST',
                data: {
                    student_id: student_id,
                    status: status,
                    lesson_id: lesson_id,
                },
                success: function ( data ) {
                    swal.fire( {
                            toast: true,
                            position: 'bottom-end',
                            showConfirmButton: false,
                            timerProgressBar: false,
                            type: 'success',
                            icon: 'success',
                            title: 'Zapisano status obecności!',
                            timer: 3000
                        }
                    );
                },
                error: function ( data ) {
                    addError( _this, 'Błąd #00987' );
                },
            } );
        });
    });
</script>