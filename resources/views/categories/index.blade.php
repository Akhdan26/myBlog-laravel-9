@extends('layouts.dashboard')

@section('title')
    Categories
@endsection

@section('breadcrumbs')
    {{Breadcrumbs::render('categories')}}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
            <div class="row">
                {{-- <div class="col-md-6"> --}}
                  {{-- Form: search --}}
                   {{-- <form action="{{ route('categories.index') }}" method="GET">
                      <div class="input-group">
                         <input name="keyword" type="search" class="form-control" value="{{ request()->get('keyword') }}" placeholder="Search for categories">
                         <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                               <i class="fas fa-search"></i>
                            </button>
                         </div>
                      </div>
                   </form>
                </div> --}}
                <div class="col-md-6">
                   <a href="{{ route('categories.create') }}" class="btn btn-primary float-left" role="button">
                      Add new
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
             <ul class="list-group list-group-flush">
                <!-- list category -->
                @include('categories._category-list',[
                  'categories' => $categories
                ])
             </ul>
          </div>
          <div class="card-footer">
            {{ $categories->links('vendor.pagination.bootstrap-4') }}
          </div>
       </div>
    </div>
 </div>
 
@endsection

@push('javascript-internal')
    <script>
      $(document).ready(function() {
         // Delete Category
         $("form[role='alert']").submit(function(event) {
            event.preventDefault();
            Swal.fire({
            title: "Delete Category",
            text: "Are you sure want to delete this category?",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: "Cancel",
            reverseButtons: true,
            confirmButtonText: "Yes",
         }).then((result) => {
            if (result.isConfirmed) {
               // todo: process of deleting categories
               event.target.submit();
            }
         });
         });
      });
    </script>
@endpush