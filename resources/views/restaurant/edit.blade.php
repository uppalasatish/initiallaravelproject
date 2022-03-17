@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.edit') }} {{ trans('global.restaurant.title') }}
                </div>
                <div class="panel-body">`
                    <form action="{{ route("admin.restaurant.update", [$restaurant->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                         <input type="hidden" name="id"value="{{ isset($restaurant) ? $restaurant->id : '' }}">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('global.restaurant.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ isset($restaurant) ? $restaurant->name : '' }}">
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                            <label for="code">{{ trans('global.restaurant.fields.code') }}*</label>
                            <input type="text" id="code" name="code" class="form-control" value="{{ isset($restaurant) ? $restaurant->code : '' }}" required>
                            @if($errors->has('code'))
                                <p class="help-block">
                                    {{ $errors->first('code') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('global.restaurant.fields.email') }}*</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ isset($restaurant) ? $restaurant->email : '' }}">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('global.restaurant.fields.phone_number') }}*</label>
                            <input type="number" id="number" name="number" class="form-control" value="{{ isset($restaurant) ? $restaurant->number : '' }}" required>
                            @if($errors->has('number'))
                                <p class="help-block">
                                    {{ $errors->first('number') }}
                                </p>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                            <label for="desc">{{ trans('global.restaurant.fields.desc') }}</label>
                            <textarea type="text" id="desc" name="desc" class="form-control">{{ isset($restaurant) ? $restaurant->desc : '' }}</textarea>
                            @if($errors->has('desc'))
                                <p class="help-block">
                                    {{ $errors->first('desc') }}
                                </p>
                            @endif
                        </div>
                        <?php $filePath = asset('images/restaurant/'.$restaurant->image->image); ?>
                        <div class="profile-img-block">
                            <img src="{{ $filePath }}" name="aegq" style="width: 160px; height: 160px;" class="img img-thumbnail img-profile"/>
                        </div>
                        <div class="form-group {{ $errors->has('profile_picture') ? 'has-error' : '' }}">
                            <label for="profile_picture">{{ trans('global.restaurant.fields.image') }}</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control profile-picture"><br><br>
                            @if($errors->has('profile_picture'))
                                <p class="help-block">
                                    {{ $errors->first('profile_picture') }}
                                </p>
                            @endif
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img style="width:160px;height: 160px;" class="img-responsive img-thumbnail" src="', e.target.result,
                    '" title="', escape(theFile.name), '"/>'].join('');
                    $('.profile-img-block').html(span);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('profile_picture').addEventListener('change', handleFileSelect, false);
    </script>
@endsection