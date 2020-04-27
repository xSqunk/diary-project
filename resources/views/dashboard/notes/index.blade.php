@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		<a href="{{ route('notes.create') }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/notes.Utwórz')}}</button>
		</a>
	</div>
@stop

@section('content')

	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('Nauczyciel')}}</th>
				<th>{{__('dashboard/notes.Student')}}</th>
				<th>{{__('dashboard/notes.Przedmiot')}}</th>
				<th>{{__('dashboard/notes.Tresc')}}</th>
				<th>{{__('dashboard/notes.Typ uwagi')}}</th>
                <th>{{__('dashboard/notes.Czas_utworzenia')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($notes as $note)
			<tr data-hash_id="{{$note->hashId}}" data-name="{{$note->student_id}}">
				<td>

                    {{$note->teacher_id}}
				</td>
				<td>
					{{$note->student_id}}
				</td>
				<td>
					{{$note->subject_id}}
				</td>
				<td>
					{{$note->text}}
				</td>
				<td>
                    @if($note->positv == 1)
                        <p>POZYTWNA</p>
                    @else
                        <p>NEGATYWNA</p>
                    @endif
				</td>
                <td>
                    {{$note->created_at}}


                </td>
			</tr>
		@endforeach
		</tbody>
	</table>


@stop

@section('js')
	<script>
		$(function () {
			$(document).ready(function() {
				$('.dropdown-menu a').click(function (e) {
					$('.active').removeClass('active');
				});
			});

		});
	</script>
	@include('dashboard.notes.js.index')
@stop

@section('css')

@stop
