<script>
	$( document ).ready( function () {
		function addError( item, msg = '', title = '' ) {
			errorDiv = '<div class="input-with-error"></div>';
			errorSpanMsg = '<span class="input-error" title="' + title + '">' + msg + '</span>';
			if ( item.parent().hasClass( 'input-with-error' ) ) {
				return;
			}
			item.wrap( errorDiv );
			item.before( errorSpanMsg );
		}
		
		function removeError( item ) {
			parent = item.parents( '.diary-form-row' );
			errorDiv = item.parents( '.input-with-error' );
			item.parents( '.input-with-error' ).find( 'input' ).detach().appendTo( parent );
			errorDiv.remove();
		}
		
		function hasError( item, msg = "" ) {
			errorDiv = item.parent( '.input-with-error' );
			if ( msg === "" ) {
				return errorDiv.length !== 0;
			} else {
				errorSpanMsg = item.parent().find( '.input-error' );
				return errorSpanMsg.text() === msg;
			}
		}
		
		function isEmail( email ) {
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test( email );
		}
		
		function isPasswordStrengthOk( password ) {
			var validLength = /.{8}/.test( password );
			var hasCaps = /[A-Z]/.test( password );
			var hasNums = /\d/.test( password );
			var hasSpecials = /[~!,@#%&_\$\^\*\?\-]/.test( password );
			
			return validLength && hasCaps && hasNums && hasSpecials;
		}
		
		function randomPassword( length ) {
			var chars = "abcdefghijklmnopqrstuvwxyz!@#$%&*ABCDEFGHIJKLMNOP1234567890";
			do {
				var pass = '';
				for ( var x = 0; x < length; x++ ) {
					var i = Math.floor( Math.random() * chars.length );
					pass += chars.charAt( i );
				}
			} while ( !isPasswordStrengthOk( pass ) );
			
			return pass;
		}
		
		$( document ).on( 'click', '.random-password-btn', function () {
			$( this ).parents('form').find( '#password' ).val( (randomPassword( 12 )) ).change();
		} );
		
		$( document ).on( 'change', '#email', function () {
			_this = $( this );
			
			if ( !isEmail( _this.val() ) ) {
				addError( _this, 'Błędny adres E-mail' );
				return;
			} else {
				removeError( _this );
			}
			
			$.ajax( {
				url: '{{route('users.checkEmail')}}' + '?_token=' + '{{ csrf_token() }}',
				type: 'POST',
				data: {
					email: _this.val(),
				},
				success: function ( data ) {
					if ( data.count == 1 ) {
						addError( _this, 'Wybrany adres E-mail jest już zajęty' );
					} else {
						removeError( _this );
					}
				},
				error: function ( data ) {
					addError( _this, 'Błąd #00987' );
				},
			} );
			
		} );
		$( document ).on( 'change', '#password', function () {
			if ( !isPasswordStrengthOk( $( this ).val() ) ) {
				addError( $( this ), 'Hasło powinno zawierać minimum 8 znaków, w tym przynajmniej 1 cyfrę oraz 1 znak specjalny', '( 8 znaków, 1 znak specialny, 1 cyfra )' );
			} else {
				removeError( $( this ) );
			}
		} );
		
		function readURL( input ) {
			if ( input.files && input.files[ 0 ] ) {
				var reader = new FileReader();
				reader.onload = function ( e ) {
					$( '#avatarPrev' ).attr( 'src', e.target.result );
				};
				reader.readAsDataURL( input.files[ 0 ] );
			}
		}
		
		$( '#avatar' ).change( function () {
			readURL( this );
		} );
		
		$( '.diary-input-error' ).change( function () {
			$( this ).removeClass( 'diary-input-error' );
		} );
		
	} );
</script>