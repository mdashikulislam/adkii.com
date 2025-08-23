@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add a new category</h6>
                        @include('admin.form_content')
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary">Save and back</button>
                        <button class="btn btn-dark">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
