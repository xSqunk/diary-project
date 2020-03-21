@forelse($errors->getMessages() as $field => $error)
	@php
	if ($pos = strpos($field, '.')) {
		$num = substr($field, $pos + 1);
		$name = substr($field, 0, $pos) . '[]';
		$eq = ".eq($num)";
	} else {
		$name = $field;
		$eq = '';
	}
	@endphp
	$(document).ready(function() {
		$('[name="{{$name}}"]'){{$eq}}.addClass('input-error');
	});
@empty
@endforelse

$('.input-error').change(function () {
	$(this).removeClass('input-error');
});