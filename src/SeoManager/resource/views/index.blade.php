<link rel="stylesheet" href="{{ asset('/vendor/seo-manager/css/app.css') }}">
<span class="setting_admin"><i class="fa fa-2x fa-cogs" aria-hidden="true"></i></span>
<div class="setting-admin">
    <h1 class="text-center">Change seo for this page</h1>
    <form action="{{route('laravelSeoManager.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="url" value="{{$locale}}">
        <div class="d-flex">
            <div class="form-group {{ $errors->has("title") ? 'has-error' : ''}} p-4">
                {!! Form::label("title", 'Meta Title', ['class' => 'control-label']) !!}

                {!! Form::textarea("title", $meta_title, ['class' => 'form-control']) !!}
                {!! $errors->first("title", '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has("meta_keywords") ? 'has-error' : ''}} p-4">
                {!! Form::label("meta_keywords", 'Meta Keywords', ['class' => 'control-label']) !!}

                {!! Form::textarea("meta_keywords", $meta_keywords, ['class' => 'form-control']) !!}
                {!! $errors->first("meta_keywords", '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has("meta_description") ? 'has-error' : ''}} p-4">
                {!! Form::label("meta_description", 'Meta Description', ['class' => 'control-label']) !!}

                {!! Form::textarea("meta_description", $meta_description, ['class' => 'form-control']) !!}
                {!! $errors->first("meta_description", '<p class="help-block">:message</p>') !!}
            </div>
            <div class="form-group {{ $errors->has("image") ? 'has-error' : ''}} p-4">
                {!! Form::label("Opengraph Image", 'Opengraph Image', ['class' => 'control-label']) !!}
                <img src="{{$seo_image}}" alt="">
                <input type="file" name="image" width="150">
                {!! $errors->first("image", '<p class="help-block">:message</p>') !!}
            </div>
        </div>
        <button class="btn btn-primary" style="width: 100%;cursor: pointer" type="submit">Update</button>
    </form>
</div>
<script src="{{ asset('/vendor/seo-manager/js/jquery-3.2.1.min.js') }}"></script>
<script src="https://use.fontawesome.com/d487d7c0de.js"></script>
<script>
    $('.setting_admin').on('click', function () {
        var setting_admin = $('.setting-admin');
        if (setting_admin.hasClass('open-setting-admin')) {
            setting_admin.removeClass('open-setting-admin')
        } else {
            setting_admin.addClass('open-setting-admin')
        }

    })
</script>
