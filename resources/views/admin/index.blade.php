@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Groups
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lets add some groups</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
{{--                        <a href="{{route('groups.index')}}" class="btn btn-primary">Open</a>--}}
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-header">
                        Courses
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Lets add some courses</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
{{--                        <a href="{{route('courses.index')}}" class="btn btn-primary">Open</a>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
