@php
    /**  @var \App\Models\BlogCategory $item  */
@endphp

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                @if($item->is_published)
                    Published
                @else
                    Draft
                @endif
            </div>
            <div class="card-body">
{{--                <div class="card-title"></div>--}}
{{--                <div class="card card-subtitle mb-2 text-muted"></div>--}}
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#maindata" role="tab">data category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#adddata" role="tab">Settings</a>
                    </li>
                </ul>
                <br>
                <div class="tab-content">
                    <div class="tab-pane active" id="maindata" role="tabpanel">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input  name="title"
                                    value="{{ $item->title }}"
                                    type="text"
                                    class="form-control"
                                    minlength="3"
                                    required>
                        </div>

                        <div class="form-group">
                            <label for="content_raw">Description</label>
                            <textarea name="content_raw"
                                      id="content_raw"
                                      class="form-control"
                                      rows="20"
                                      style="min-height: 400px;"
                                      >{{old('content_raw', $item->content_raw)}}</textarea>
                        </div>
                    </div>
                    <div class="tab-pane" id="adddata" role="tabpanel">
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select name="category_id"
                                    id="category_id"
                                    class="form-control"
                                    placeholder="Enter category"
                                    required >
                            @foreach($categoryList as $categoryOption)
                                <option value="{{$categoryOption->id}}"
                                        @if($categoryOption->id == $item->category_id) selected @endif>{{$categoryOption->id_title}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug"
                                      id="slug"
                                      class="form-control"
                                      type="text">
                        </div>

                        <div class="form-group">
                            <label for="excerpt">Slug</label>
                            <textarea name="excerpt"
                                   id="excerpt"
                                   class="form-control"
                                   type="text"
                                      rows="3">{{ old('excerpt', $item->excerpt) }}</textarea>
                        </div>

                        <div class="form-check">
                            <input name="is_published"
                                    type="hidden"
                                    value="0">
                            <input name="is_published"
                                    type="checkbox"
                                    class="form-check-input"
                                    value="1"
                                    @if($item->is_published) checked="checked"@endif>
                            <label class="form-check-label" for="is_published">Published</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
