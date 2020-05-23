@extends('dashboard.home')

@section('title', $head_text)

@section('content_header')
    <div class="content-header-inner">
        <h1>{!! $head_text !!}</h1>

    </div>
@stop

@section('content')

    <table class="is-dataTable table-striped table-bordered mt-3" width="100%">
        <thead>
        <tr>
            <th>{{__('dashboard/plan.Student')}}</th>

            <th>{{__('dashboard/plan.Obecny')}}</th>
        </tr>
        </thead>

        <tbody>
        @foreach($presences as $presence)
            <td>
                <p>
                <ul>
                    {{$presence->student->meta->name.' '.$presence->student->meta->surname}}
{{--                    {{str_pad($term->start_hour, 2, "0", STR_PAD_LEFT ).':'.str_pad($term->start_minute, 2, "0", STR_PAD_LEFT ).' - '.$term->end_hour.':'.str_pad($term->end_minute, 2, "0", STR_PAD_LEFT )}}--}}


                </ul>
                </p>
            </td>

            <td>
                <p>
                <ul>
                    <select required name="status" class=" @if( $errors->has('status') ) input-error @endif custom-select"  id="status">
                        <option value="0" @if ($presence->presence == 0) selected @endif>Nieobecny</option>
                        <option value="1" @if ($presence->presence == 1) selected @endif>Obecny</option>
                        <option value="2" @if ($presence->presence == 2) selected @endif>Obecny (spóźniony)</option>
                        <option value="3" @if ($presence->presence == 3) selected @endif>Nieobecny (usprawiedliwiony)</option>
                        <option value="4" @if ($presence->presence == 4) selected @endif>Zwolniony</option>
                    </select>

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
