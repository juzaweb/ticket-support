@extends('cms::layouts.backend')

@section('content')
    <div class="row">
        <div class="col-md-4">
            @component('cms::components.form', [])

                {{ Field::text(trans('cms::app.name'), 'name', ['required' => true, 'validators' => ['required']]) }}

                <button class="btn btn-success">{{ __('Add Type') }}</button>

            @endcomponent
        </div>

        <div class="col-md-8">
            {{ $dataTable->render() }}
        </div>
    </div>
@endsection
