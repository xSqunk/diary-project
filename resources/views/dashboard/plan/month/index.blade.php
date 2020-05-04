@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

	</div>
@stop

@section('content')

	@if($view_type === 'plan')

	<div class="filter-container">
		<h3 class="mb-4">{{__('dashboard/user.Filtrowanie')}}</h3>

		<div class="form-row">
				<form action="{{ route( "$view_type.month.index" ) }}" id="form-user-filter" method="GET" novalidate enctype="multipart/form-data">
				@csrf
				<div class="form-group filter-group">
					<label class="control-label" for="type">{{__('dashboard/plan.Plan')}}</label>
					<select required name="year" class="form-control" id="year">
                            @foreach( $years as $year)
                                <option value="{{$year}}" @if(isset($_GET['chosenYear'])) selected @endif >{{$year}}</option>
                            @endforeach
					</select>
                    <select required name="month" class="form-control" id="month">
                            @foreach( $months as $key=>$month)
                                <option value="{{$key}}" @if(isset($_GET['chosenMonth'])) selected @endif >{{$month}}</option>
                            @endforeach
                    </select>
				</div>
				<button class="btn btn-primary" type="submit" >Filtruj</button>
			</form>
		</div>
	</div>



	@endif

	<table class="is-dataTable table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th>{{__('dashboard/plan.Dzień')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($lesson_days as $lesson_day)
			<tr data-hash_id="{{$lesson_day->hashId}}">

				<td>
					<p>
                        <ul> {{substr($lesson_day->lesson_date, 8)}} </ul>
					</p>
				</td>


			</tr>
		@endforeach
		</tbody>
	</table>


@stop

@section('js')
	@include('dashboard.plan.month.js.index')
@stop

@section('css')


@stop
