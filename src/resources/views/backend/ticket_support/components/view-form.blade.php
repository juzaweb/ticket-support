<div class="row mt-3 mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{ __('Ticket') }}: {{ $title }}</h5>
                            <div class="small">{{ __('Submit By') }}: {{ $model->createdBy?->name }}</div>
                            <div class="small mt-1">{{ __('Ticket Type') }}: {{ $model->type->name }}</div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-right float-right">
                                <small>{{ jw_date_format($model->created_at) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                {{ $model->content }}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 comments" id="comments">
        @foreach($comments as $comment)
            @component('jwts::backend.ticket_support.components.comment-template', [
                'title' => $title,
                 'comment' => $comment->content,
                 'createdBy' => $comment->createdBy?->name,
                 'createdAt' => jw_date_format($comment->created_at),
            ])

            @endcomponent
        @endforeach
    </div>
</div>

<form
    action="{{ route('admin.ticket-supports.comment', [$model->id]) }}"
    method="post"
    class="form-ajax"
    id="form-reply"
    data-success="reply_success_handle"
    data-notify="true"
>
    <h3>{{ __('Reply') }}</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{ Field::textarea(__('Content'), 'content', ['rows' => 5]) }}
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="btn btn-success">{{ __('Send') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/html" id="comment-template">
    @component('jwts::backend.ticket_support.components.comment-template', [
            'title' => $title,
            'comment' => '{comment}',
            'createdBy' => '{createdBy}',
            'createdAt' => '{createdAt}',
        ]
    )

    @endcomponent
</script>

<script type="text/javascript">
    function reply_success_handle(form, response) {
        let temp = document.getElementById('comment-template').innerHTML;
        $('#comments').append(replace_template(temp, {
            'comment': response.data.comment.content,
            'createdBy': response.data.comment.created_by.name,
            'createdAt': response.data.comment.created_date,
        }));
        form.find('textarea').val(null);
    }
</script>
