<script>
    ( function ( $ ) {
        $( document ).ready( function () {

            loadPanel($('.ajax-tab.active'));

            $('.ajax-tab').click(function() {
                loadPanel($(this));
            });

            function loadPanel(el) {
                let tab_id = el.attr('aria-controls');
                let element_id = el.closest('nav').data('id');

                $('#' + tab_id).append('<div id="diary-ajax-loader" class="ajax-loader"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
                $.ajax( {
                    url: '{{route('students.panel')}}' + '?_token=' + '{{ csrf_token() }}',
                    type: 'POST',
                    data: {
                        id: element_id,
                        tab_id: tab_id
                    },
                    success: function (html) {
                        $('#' + tab_id).html(html);
                        $('#' + tab_id).find('#diary-ajax-loader').remove();
                    },
                    error: function ( data ) {
                        addError( _this, 'Błąd #00987' );
                    },
                } );
            }
        });

    } )( jQuery );
</script>