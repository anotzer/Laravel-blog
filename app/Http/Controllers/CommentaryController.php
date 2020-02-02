<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;
use App\Models\Commentary;
use Illuminate\Http\Request;
use App\Http\Requests\BlogCommentaryRequest;

class CommentaryController extends Controller
{

    private $blogCommentary;


    public function __construct()
    {
        return $this->blogCommentary = new Commentary();

    }
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd(__METHOD__,$request->input(),'Прошло успешно');
        //
//        if(!$post = Post::find((int)$request->header('postId')))
//            return;
//
//        $commentary = new Commentary();
//        $commentary->post()->associate($post);
//        $commentary->user()->associate(Auth::user());
//        $commentary->text = $request->header('text');
//        $commentary->save();
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
        /** @var TYPE_NAME $id */
        //dd($id);
        //
        //$commentaryList = Commentary::all();
        $commentaryList = Commentary::where(['post_id' => $id])->get();
        //$sortList = BlogPost::find((int)$request->header('post_id'));
        return view('blog.posts.index', compact('commentaryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $commentary = Commentary::find((int)$request->header('commentaryId'));
        $commentary->text = $request->header('text');
        $commentary->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Commentary::find((int)$request->header('commentaryId'))->delete();
    }
}
