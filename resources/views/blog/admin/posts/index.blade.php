@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{ route('blog.admin.posts.create') }}">Create</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr class="justify-content-center">
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>header</th>
                                    <th>date</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pagination as $post)
                                @php /** @var \App\Models\BlogCategory $item */ @endphp
                                <tr @if(!$post->is_published) style="background-color: #ccc;" @endif>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td>
                                        <a href="{{route('blog.admin.posts.edit', $post->id)}}">{{ $post->title }}</a>
                                        <a href="{{route('blog.posts.edit', $post->id)}}" >Комментарии</a>
                                    </td>
                                    <td>{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : ' ' }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="justify-content-center">
            @if($pagination->total() > $pagination->count())
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ $pagination->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
