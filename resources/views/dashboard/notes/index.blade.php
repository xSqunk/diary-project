@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>
		<a href="{{ route('notes.create') }}" class="page-title-action">
			<button class="btn btn-info btn-sm"><i class="fa fa-plus "></i> {{__('dashboard/note.Utwórz')}}</button>
		</a>
	</div>
@stop

@section('content')

	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/note.Nauczyciel')}}</th>
				<th>{{__('dashboard/note.Student')}}</th>
				<th>{{__('dashboard/note.Przedmiot')}}</th>
				<th>{{__('dashboard/note.Treść')}}</th>
				<th>{{__('dashboard/note.Typ uwagi')}}</th>
                <th>{{__('dashboard/note.Czas utworzenia')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($notes as $note)
			<tr data-hash_id="{{$note->hashId}}" data-name="{{$note->student_id}}">
				<td>
                    {{$note->teacher->meta->name . ' ' . $note->teacher->meta->surname}}
				</td>
				<td>
					{{$note->student->meta->name . ' ' . $note->student->meta->surname}}
                </td>
				<td>
{{--                    {{$note->subjects->meta->name}}--}}
                        {{$note->subject_id}}
				</td>
				<td>
					{{$note->text}}
				</td>
				<td>
                    {{$note->getStatusNameAttribute()}}
{{--                    @if($note->getStatusNameAttribute()==1)--}}
{{--                        <p style="color: green">POZYTWNA</p>--}}
{{--                    @else--}}
{{--                        <p style="color: red">NEGATYWNA</p>--}}
{{--                    @endif--}}
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
