<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogPostCreateRequest;
use App\Models\BlogPost;
use App\Models\Commentary;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PostController extends BaseController
{
    /*
     *
     */
    /**
     * Manage blog
     * @var BlogPostRepository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private $blogPostRepository;

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;


    public function __construct()
    {
        parent::__construct();
        $this->blogPostRepository = app(BlogPostRepository::class); //потому что
        $this->blogCategoryRepository = app(BlogCategoryRepository::class); //тоже потому что
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagination = $this->blogPostRepository->getAllWithPaginate(25);
        return view('blog.admin.posts.index', compact('pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $item = new BlogPost();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.posts.edit', compact('item','categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogPostCreateRequest $request)
    {
        //
        $data = $request->input();
        $item = (new BlogPost())->create($data);
        if($item){
            return redirect()->route('blog.admin.posts.edit', [$item->id])->with(['success' => 'Saved']);
        }else{
            return back()->withErrors(['msg' => 'Save error'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = $this->blogPostRepository->getEdit($id);
        if(empty($item)){
            abort(404,'Pages not found');
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.posts.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Post id=[{$id}] not found"])
                ->withInput();
        }

        $data = $request->all();
        //Закинуть в обсервер {Закинул :D}
//        if(empty($data['slug'])){
//            $data['slug'] = \Str::slug($data['title']);
//        }
//
//        if(empty($item->published_at) && $data['is_published']){
//            $data['published_at'] = Carbon::now();
//        }
        //-----------------------------------
        $result = $item->update($data);
        //dd($data);
        if ($result){
            return redirect()
                ->route('blog.admin.posts.edit', $item->id)
                ->with(['success' => 'Saved']);
        }else {
            return back()
                ->withErrors(['msg' => 'Save errors'])
                ->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
