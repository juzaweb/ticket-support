@component('cms::components.form_resource', [
        'model' => $model
    ])

    <div class="row">
        <div class="col-md-8">

            {{ Field::text($model, 'title') }}

            {{ Field::textarea($model, 'content', ['rows' => 5]) }}

        </div>

        <div class="col-md-4">
            {{ Field::select($model, 'support_type_id', ['options' => $supportTypes, 'label' => __('Type')]) }}
        </div>
    </div>
@endcomponent
