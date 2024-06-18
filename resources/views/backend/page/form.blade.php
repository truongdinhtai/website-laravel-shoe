<form method="POST" action="" autocomplete="off" enctype="multipart/form-data">
    <div class="row">
        <div class="col-sm-8">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tên </label>
                <input type="text" name="name" placeholder="Tên" class="form-control" value="{{ old('name', $page->name ?? "") }}">
                @error('name')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('name') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Mô tả</label>
                <textarea name="description" class="form-control" id="" cols="30" rows="3">{{ old('description', $page->description ?? "") }}</textarea>
                @error('description')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('description') }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nội dung</label>
                <textarea name="page_content" class="form-control" id="editor" cols="30" rows="3">{{ old('page_content', $page->page_content ?? "") }}</textarea>
                @error('page_content')
                <small id="emailHelp" class="form-text text-danger">{{ $errors->first('page_content') }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Lưu dữ liệu</button>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="exampleInputEmail1">Route </label>
                <input type="text" name="route" placeholder="route" class="form-control" value="{{ old('route', $page->route ?? "") }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Url </label>
                <input type="text" name="url" placeholder="url" class="form-control" value="{{ old('url', $page->url ?? "") }}">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Hình ảnh</label>
                <input type="file" class="form-control" name="avatar">
                @if (isset($article->avatar) && $article->avatar)
                    <img src="{{ pare_url_file($article->avatar) }}" style="width: 60px;height: 60px; border-radius: 10px; margin-top: 10px" alt="">
                @endif
            </div>
        </div>
    </div>
</form>

@section('script')
<style>
    .ck-editor__editable_inline {
        min-height: 200px !important;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '{{route('image.upload').'?_token='.csrf_token()}}',
            }
        })
        .catch( error => {
            console.error( error );
        } );
</script>
@stop