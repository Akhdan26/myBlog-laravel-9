@extends('layouts.dashboard')

@section('title')
    Add Posts
@endsection

@section('breadcrumbs')
   {{Breadcrumbs::render('add_posts')}}
@endsection

@section('content')
<div class="row">
   <div class="col-md-12">
      <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
         @csrf
         <div class="card">
            <div class="card-body">
               <div class="row d-flex align-items-stretch">
                  <div class="col-md-8">
                     <!-- category -->
                     <!-- parent_category -->
                     <div class="form-group">
                        <label for="select_category" class="font-weight-bold">Category</label>
                        <select class="form-control" id="position-option" name="category_id">
                           @foreach ($categories as $category)
                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <!-- <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">
                           Thumbnail
                        </label>
                        <input id="input_post_title" value="{{ old('thumbnail') }}" name="thumbnail" type="text" class="form-control" placeholder="" />
                     </div> -->
                     <!-- <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">
                           Image
                        </label>
                        <input id="input_post_title" value="{{ old('image') }}" name="image" type="text" class="form-control" placeholder="" />
                     </div> -->
                     <!-- title -->
                     <div class="form-group">
                        <label for="input_post_title" class="font-weight-bold">
                           Title
                        </label>
                        <input id="input_post_title" value="{{ old('title') }}" name="title" type="text" class="form-control" placeholder="" />
                     </div>
                     <!-- slug -->
                     <div class="form-group">
                        <label for="input_post_slug" class="font-weight-bold">
                           Slug
                        </label>
                        <input id="input_post_slug" value="{{ old('slug') }}" name="slug" type="text" class="form-control" placeholder="" readonly />
                     </div>
                     <!-- short description -->
                     <div class="form-group">
                        <label for="input_post_description" class="font-weight-bold">
                           Short Description
                        </label>
                        <textarea id="input_post_description" name="short_description" value="{{ old('short_description') }}" placeholder="" class="form-control " rows="3"></textarea>
                     </div>
                     <!-- content -->
                     <div class="form-group">
                        <label for="input_post_content" class="font-weight-bold">
                           Content
                        </label>
                        <textarea id="input_post_content" name="content" value="{{ old('content') }}" placeholder="" class="form-control " rows="15"></textarea>
                     </div>
                     <div class="form-group">
                        <label for="image">Choose Image:</label>
                        <input required type="file" class="form-control" id="image" name="image">
                     </div>
                     <!-- thumbnail -->
                     {{-- <div class="form-group">
                        <label for="input_posts_thumbnail" class="font-weight-bold">
                           Thumbnail
                        </label>
                        <div class="input-group">
                           <div class="input-group-prepend">
                              <button id="button_posts_thumbnail" data-input="input_posts_thumbnail" class="btn btn-primary" type="button">
                                 Browse
                              </button>
                           </div>
                           <input id="input_posts_thumbnail" name="thumbnail" value="" type="text" class="form-control" placeholder=""
                              readonly />
                        </div>
                     </div> --}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="float-right">
                        <a class="btn btn-warning px-4" href="{{route('posts.index')}}">Back</a>
                        <button type="submit" class="btn btn-primary px-4">
                           Save
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
@endsection
{{-- @push('css-external')
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2-bootstrap4.min.css') }}">
@endpush
--}}
{{-- @push('javascript-external')
    
@endpush  --}}

@push('javascript-internal')
    <script>
      // input slug
        $(document).ready(function() {
         $("#input_post_title").change(function (event) {
            $("#input_post_slug").val(
               event.target.value
                  .trim()
                  .toLowerCase()
                  .replace(/[^a-z\d-]/gi, "-")
                  .replace(/-+/g, "-")
                  .replace(/^-|-$/g, "")
            );
         });
        });

      //   input image
        $('#button_post_image').filemanager('image');
    </script>
@endpush 