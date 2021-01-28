@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Статья {{$post->title}}</h3>
                        </div>
                        <form role="form" method="post" action="{{route('posts.update', ['post' => $post->id])}}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{$post->title}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Цитата</label>
                                    <textarea class="form-control  @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3"
                                    >{{$post->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="content">Содержимое</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                              name="content" rows="5"
                                    >{{$post->content}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category">Категория</label>
                                    <select id="category" name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror">
                                        @foreach($categories as $catId => $catTitle)
                                            <option @if($catId === $post->category_id) selected @endif
                                             value="{{$catId}}">{{$catTitle}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group" data-select2-id="29">
                                    <label for="tags">Multiple</label>
                                    <select id="tags" name="tags[]" class="select2" multiple="multiple"
                                            data-placeholder="Выберите теги" style="width: 100%;">
                                        @foreach($tags as $tagId => $tagTitle)
                                            <option @if(in_array($tagId, $post->tags->pluck('id')->all())) selected @endif
                                            value="{{$tagId}}">{{$tagTitle}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="thumbnail">Файл</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="thumbnail" name="thumbnail"
                                                   class="custom-file-input">
                                            <label class="custom-file-label" for="thumbnail">Выберите файл</label>
                                        </div>
                                    </div>
                                    <div><img src="{{$post->getImage()}}" class="mt-2"  width="150px" alt=""></div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

