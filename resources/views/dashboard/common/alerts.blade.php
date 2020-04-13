@if(session()->has('alert') && session()->get('alert'))
	@php
		$alert = session()->get('alert');
	@endphp

	<script>
		swal.fire( {
					type: '{{ $alert['type'] ?? '' }}',
					icon: '{{ $alert['type'] ?? '' }}',
					title: '{{ $alert['title'] ?? '' }}',
					html: '{{ $alert['text'] ?? '' }}',
					footer: '{{ $alert['footer'] ?? '' }}',
					timer: '{{ $alert['timer'] ?? 0 }}'
				}
		)
	</script>
@endif