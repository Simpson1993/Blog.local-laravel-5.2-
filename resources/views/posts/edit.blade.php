@extends('main')

@section('title', '| Edit Blog Post')

@section('stylesheets')

    {!! Html::style('css/select2.css') !!}

@endsection

@section('content')
    @if ($post->user_id == Auth::user()->id)
    <div class = "row">
        {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
        <div class = "col-md-8">
            {{ Form::label('title', 'Title: ') }}
            {{ Form::text('title', null, ["class" => 'form-control input-lg']) }}

            {{ Form::label('category_id', 'Category: ', ["class" => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

            {{ Form::label('tags', 'Tags:', ["class" => 'form-spacing-top'])}}
            {{ Form::select('category_id', $tags, null, ['class' =>
            'form-control select2-multi', 'multiple' => 'multiple']) }}

            {{ Form::hidden('user_id', $users) }}

            {{ Form::label('slug', 'Slug: ', ["class" => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ["class" => 'form-control']) }}

            {{ Form::label('body', 'Body: ', ["class" => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ["class" => 'form-control']) }}
        </div>

        <div class = "col-md-4">
            <div class = "well">
                <dl class = "dl-horizontal">
                    <dt>Created At: </dt>
                    <dd>{{ date('M j, Y H:i',strtotime($post->created_at)) }}</dd>
                </dl>
                <dl class = "dl-horizontal">
                    <dt>Last Updated: </dt>
                    <dd>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                </dl>
                <hr>
                <div class = "row">
                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn
                        btn-danger btn-block')) !!}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
    @else
        <h1>404 Not Found</h1>
        <p>Страница не найдена</p>
    @endif
@endsection

@section('scripts')

    {!! Html::script('js/select2.min.js') !!}
    <script type="text/javascript">
        $('.select2-multi').select2()
        $('.select2-multi').select2().val({!! json_encode($post->tags()->getRelatedIds())
        !!}).trigger
        ('change');
    </script>

@endsection