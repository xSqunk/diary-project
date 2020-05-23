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
                                <option value="{{$year}}" @if(isset($request->month)) selected @endif >{{$year}}</option>
                            @endforeach
					</select>
                    <select required name="month" class="form-control" id="month">
                            @foreach( $months as $key=>$month)
                                <option value="{{$key + 1}}" @if(isset($_GET['month']) && $_GET['month'] === $key) selected @endif >{{$month}}</option>
                            @endforeach
                    </select>
				</div>
				<button class="btn btn-primary" type="submit" value="{{ request('request') }}" >Filtruj</button>
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
			<tr data-hash_id="{{$lesson_day[0]->hashId}}">
				<td>
					<p>
                        <ul>
                        <a href="{{ route( "plan.day.index", [ 'date' => $lesson_day[0]->lesson_date, 'class_id' => Request()->class_id]) }}"> {{$lesson_day[1]}} </a>
                        </ul>
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
