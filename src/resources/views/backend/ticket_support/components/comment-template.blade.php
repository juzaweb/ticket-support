<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="small">{{ __('By') }}: {{ $createdBy }}</div>
                    <div class="text-right float-right">
                        <div class="small">{{ $createdAt }}</div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{ $comment ?? '' }}
            </div>
        </div>
    </div>
</div>
