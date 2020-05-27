@extends('dashboard.home')

@section('title', 'Plan lekcji')

@section('content_header')
	<div class="content-header-inner">
		<h1>{!! $head_text !!}</h1>

		<a href="{{route('classes.index')}}">
			<button class="btn btn-info btn-sm"><i class="fa fa-undo"></i> Klasy</button>
		</a>

	</div>
@stop

@section('content')
	<div class="filter-container">
		<h3 class="mb-4">{{__('dashboard/user.Filtrowanie')}}</h3>

		<div class="form-row">
				<form action="{{ route( 'plan.month.index', ['class_id' => $class_id] ) }}" id="form-user-filter" method="GET" novalidate enctype="multipart/form-data">
				<div class="form-group filter-group">
					<label class="control-label" for="type">{{__('dashboard/plan.Plan')}}</label>
					<select required name="year" class="form-control mr-3" id="year">
                            @foreach( $years as $year)
                                <option value="{{$year}}" @if((int) $this_year === $year) selected @endif >{{$year}}</option>
                            @endforeach
					</select>
                    <select required name="month" class="form-control month_select" id="month">
                            @foreach( $months as $key=>$month)
                                <option value="{{$key + 1}}" @if((int) $this_month === $key + 1) selected @endif >{{$month}}</option>
                            @endforeach
                    </select>
				</div>
				<button class="btn btn-primary" type="submit" value="{{ request('request') }}" >Filtruj</button>
			</form>
		</div>
	</div>

	<table class=" table-striped table-bordered mt-3" width="100%">
		<thead>
			<tr>
				<th class="text-center">{{__('dashboard/plan.Data')}}</th>
				<th class="text-center">{{__('dashboard/plan.Dzień tygodnia')}}</th>
				<th class="text-center">{{__('global.Akcje')}}</th>
			</tr>
		</thead>

		<tbody>
		@foreach($dates as $date)

			@if(in_array($date->dayOfWeek, [6, 0], true))
				@continue
			@endif
			<tr class="pt-2 pb-2">
				<td class="text-center">{{$date->isoFormat('D MMMM YYYY')}}</td>
				<td class="text-center">{{$date->isoFormat('dddd')}}</td>
				<td class="text-center">
					<a href="{{ route( "plan.day.index", [ 'class_id'  => $class_id, 'year' => $date->year, 'month' => $date->month, 'day' => $date->day]) }}">
						<button class="btn btn-info diary-edit-btn" title="{{__('dashboard/plan.Pokaż godziny')}}">
							<i class="fas fa-clock"></i>
						</button>
					</a>
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
