<?php
    $asset_path = URL::asset('public/assets');
    $dir='rtl';
    $align = 'right';
?>
@extends('admin.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{__('Edit News')}}</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('news.update',$new->id)}}" enctype="multipart/form-data">
                          {{ csrf_field() }}

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة العربية)')}}</label><br>

                                  <input style="text-align:{{$align}}" id="title" type="text" class="form-control" name="subject_ar" value="{{ $new->translate('ar')->title }}" autocomplete="off" required>

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة العربية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea id="editor1" name="body_ar" style="text-align:{{$align}}" dir="{{$dir}}">{!! $new->translate('ar')->body !!}</textarea>
                          </div>
                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة الروسية)')}}</label><br>

                                  <input style="text-align:left" dir="ltr" id="title" type="text" class="form-control" name="subject_ru" value="{{ $new->translate('ru')->title }}" autocomplete="off" required>

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label dir="{{$dir}}" style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة الروسية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea dir="ltr" style="direction: ltr;text-align:left" id="editor2" name="body_ru">{!! $new->translate('ru')->body !!}</textarea>
                          </div>

                          <div dir="{{$dir}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('صنف الخبر')}}</label><br>

                                  <select name="category_id" class="form-control">
                                    @foreach($cats as $value)
                                        <option value="{{$value->id}}" {{$value->id == $new->category->id ? "selected" : "" }} >{{$value->translate('ar')->name}}</option>
                                    @endforeach
                                  </select>
                          </div>

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('صورة الخبر الرئيسية')}}</label><br>

                                  <input style="text-align:{{$align}}" id="title" type="file" class="form-control" name="main_image" value="" autocomplete="off" required>
                          </div>

                          @if(Auth::user()->can('manage-users'))
                            <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label" autocomplete="off">{{_('اضافة الى الاسلايدر')}}</label><br>
                                <input type="checkbox" name="slider" {{$new->slider == 1 ? "checked" : ""}}>
                            </div>
                            <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label" autocomplete="off">{{_('اضافة الى الاخبار العاجلة')}}</label><br>
                                <input type="checkbox" name="urgent" {{$new->urgent == 1 ? "checked" : ""}}>
                            </div>
                          @endif

                         
                          <div class="form-group text-center">
                                  <button type="submit" class="btn btn-primary">
                                      {{__('تعديل الخبر')}}
                                  </button>
                          </div>
                      </form>
                </div>
            </div>
        </div>
    </div>

@endsection

  @section('after')
  <script src="{{$asset_path}}/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.editorConfig = function(config) {
  // ...
     config.filebrowserBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
     config.filebrowserImageBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
     config.filebrowserFlashBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
     config.filebrowserUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
     config.filebrowserImageUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
     config.filebrowserFlashUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
  // ...
  };
     window.onload = function() {
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    };
  </script>
    {{-- <script src="{{$asset_path}}/admin/js/summernote.js"></script> --}}
    <!-- include summernote-ko-KR -->
    {{-- @if( $locale == 'ar')
      <script src="{{$asset_path}}/admin/js/summernote-ar-AR.js"></script>
    @endif --}}
   {{--  <script>
        $('#summernote1').summernote({
          height: 300,                  // set editor height
          minHeight: null,              // set minimum height of editor
          maxHeight: null,              // set maximum height of editor
          focus: true ,                 // set focus to editable area after initializing summernote
          lang: 'ar-AR'                 // default: 'en-US'
        });
        $('#summernote2').summernote({
          height: 300,                  // set editor height
          minHeight: null,              // set minimum height of editor
          maxHeight: null,              // set maximum height of editor
          focus: true ,                 // set focus to editable area after initializing summernote
        });
    </script> --}}
  @endsection