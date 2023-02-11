<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('form.store') }}">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('form.title') }}</label>
            <input type="text" name="title" class="form-control" value="{{ $title }}" required>
            @if ($errors->has('title'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group">
            <label for="description">{{ __('form.description') }}</label>
            <textarea name="description" class="form-control" required>{{ $description }}</textarea>
        </div>
        <div class="form-group">
            <label for="content">{{ __('form.content') }}</label>
        <textarea name="content" class="form-control" required>{{ $content }}</textarea>
    </div>
    <div class="form-group">
        <label> {{ __('form.caducable') }}</label>
        <div class="form-check">
            <input type="hidden" name="caducable" value="0">
            <input class="form-check-input" type="checkbox" name="caducable" value="1" {{ $caducable ? 'checked' : '' }}>
            <label class="form-check-label">Marca esta casilla si deseas que la publicación caduque</label>
        </div>
    </div>
    <div class="form-group">
        <label> {{ trans('form.comentable') }}</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="comentable" value="1" {{ $comentable ? 'checked' : '' }}>
            <label class="form-check-label">Marca esta casilla si deseas que los usuarios puedan comentar en la publicación</label>
        </div>
    </div>
    <div class="form-group">
        <label for="acceso">{{ trans('form.acceso') }}</label>
        <select name="acceso" class="form-control">
            <option value="privado" {{ $acceso == 'privado' ? 'selected' : ''}} >{{ trans('form.privado')}}</option>
            <option value="privado" {{ $acceso == 'publico' ? 'selected' : ''}} > {{trans('form.publico') }} </option>
            <input type="submit" value="Submit">
    </body>
</html>