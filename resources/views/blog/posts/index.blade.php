@extends('layouts.app')

@section('content')


{{--@auth()--}}
<div class="container">
    <div class="justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card card-body">
                <p>Написать комментарий</p>
                <br>
                {{--            <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">--}}
                <form method="POST" action="{{ route('blog.posts.store')}}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="">
                                <textarea name="comment" id="comment" class="form-control"
                                          type="text"
                                          rows="3"></textarea>
                                <div class="card-body ml-auto">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{--@endauth--}}
<br>
@php
    /** @var \App\Models\Commentary $item */
@endphp
@foreach($commentaryList as $list)
<div class="container">
    <div class="col-md-12">
        <div class="card card-body">
                <div class="row">
                    <div class="col-sm">
                        <div class="card-body">
                            {{$list->user->name}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body">
                            {{$list->text}}
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="card-body">
                            Дата публикации
                            {{$list->created_at}}
                        </div>
                    </div>
                </div>
        </div>

    </div>
</div>
@endforeach
@endsection
