<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Requests\BlogCategoryCreateRequest;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Models\BlogCategory;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Str;

class CategoryController extends BaseController
{

    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$pagination = BlogCategory::paginate(5);
        $pagination = $this->blogCategoryRepository->getAllWithPaginate();
        return view('blog.admin.categories.index', compact('pagination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $item = new BlogCategory();
        //$categoryList = BlogCategory::all();
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogCategoryCreateRequest $request
     * @return Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {

        $data = $request->input();
//        if (($data['slug']) == null){
//           $data['slug'] = Str::slug($data['title']);
//            dd("Ты не туда залез");
//        }
//        $item = new BlogCategory($data);
//        $item->save();

        $item = (new BlogCategory())->create($data);


        if($item){
            return redirect()
                ->route('blog.admin.categories.edit', [$item->id])
                ->with(['success' => 'saved']);
        }else{
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        dd('
            ⣾⡇⣿⣿⡇⣾⣿⣿⣿⣿⣿⣿⣿⣿⣄⢻⣦⡀⠁⢸⡌⠻⣿⣿⣿⡽⣿⣿
            ⡇⣿⠹⣿⡇⡟⠛⣉⠁⠉⠉⠻⡿⣿⣿⣿⣿⣿⣦⣄⡉⠂⠈⠙⢿⣿⣝⣿
            ⠤⢿⡄⠹⣧⣷⣸⡇⠄⠄⠲⢰⣌⣾⣿⣿⣿⣿⣿⣿⣶⣤⣤⡀⠄⠈⠻⢮
            ⠄⢸⣧⠄⢘⢻⣿⡇⢀⣀⠄⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⡀⠄⢀
            ⠄⠈⣿⡆⢸⣿⣿⣿⣬⣭⣴⣿⣿⣿⣿⣿⣿⣿⣯⠝⠛⠛⠙⢿⡿⠃⠄⢸
            ⠄⠄⢿⣿⡀⣿⣿⣿⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣿⣿⣿⣿⡾⠁⢠⡇⢀
            ⠄⠄⢸⣿⡇⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣏⣫⣻⡟⢀⠄⣿⣷⣾
            ⠄⠄⢸⣿⡇⠄⠈⠙⠿⣿⣿⣿⣮⣿⣿⣿⣿⣿⣿⣿⣿⡿⢠⠊⢀⡇⣿⣿
            ⠒⠤⠄⣿⡇⢀⡲⠄⠄⠈⠙⠻⢿⣿⣿⠿⠿⠟⠛⠋⠁⣰⠇⠄⢸⣿⣿⣿

        ');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @param BlogCategoryRepository $categoryRepository
     * @return Response
     */
    public function edit($id)
    {
//        $item = BlogCategory::findorFail($id);
//        $categoryList = BlogCategory::all();
        $item = $this->blogCategoryRepository->getEdit($id);
        if (empty($item)){
            abort(404);
        }
        $categoryList = $this->blogCategoryRepository->getForComboBox();
        return view('blog.admin.categories.edit',
            compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogCategoryUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {

        /*
         * Создание ограничений для сохранения
         * */
//        $rules = [
//            'title'     =>  'required|min:5|max:200',
//            'slug'      =>  'max:200',
//            'description'   => 'string|max:500|min:3',
//            'parent_id'     =>  'required|integer|exists:blog_categories,id', //exists from table
//        ];
        //$validationData = $this->validate($request, $rules); был выбор между двумя, но второй варик понравился больше :D
        //$validationData = $request->validate()->rules();
        //$item = BlogCategory::find($id);
        $item = $this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            return back()
                ->withErrors(['msg' => "Category id=[{$id}] not found"])
                ->withInput();
        }
        $data = $request->all();
        //В обсервере
//        if (($data['slug']) == null){
//            $data['slug'] = Str::slug($data['title']);
//        }
        $result = $item->update($data);
//        $result = $item->fill($data);
//        $result->save();

        if($result){
            return redirect()
                ->route('blog.admin.categories.edit', $item->id)
                ->with(['success' => 'saved']);
        }else{
            return back()
                ->withErrors(['msg' => 'Save error'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        dd('
            ⣾⡇⣿⣿⡇⣾⣿⣿⣿⣿⣿⣿⣿⣿⣄⢻⣦⡀⠁⢸⡌⠻⣿⣿⣿⡽⣿⣿
            ⡇⣿⠹⣿⡇⡟⠛⣉⠁⠉⠉⠻⡿⣿⣿⣿⣿⣿⣦⣄⡉⠂⠈⠙⢿⣿⣝⣿
            ⠤⢿⡄⠹⣧⣷⣸⡇⠄⠄⠲⢰⣌⣾⣿⣿⣿⣿⣿⣿⣶⣤⣤⡀⠄⠈⠻⢮
            ⠄⢸⣧⠄⢘⢻⣿⡇⢀⣀⠄⣸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣧⡀⠄⢀
            ⠄⠈⣿⡆⢸⣿⣿⣿⣬⣭⣴⣿⣿⣿⣿⣿⣿⣿⣯⠝⠛⠛⠙⢿⡿⠃⠄⢸
            ⠄⠄⢿⣿⡀⣿⣿⣿⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⣷⣿⣿⣿⣿⡾⠁⢠⡇⢀
            ⠄⠄⢸⣿⡇⠻⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⣏⣫⣻⡟⢀⠄⣿⣷⣾
            ⠄⠄⢸⣿⡇⠄⠈⠙⠿⣿⣿⣿⣮⣿⣿⣿⣿⣿⣿⣿⣿⡿⢠⠊⢀⡇⣿⣿
            ⠒⠤⠄⣿⡇⢀⡲⠄⠄⠈⠙⠻⢿⣿⣿⠿⠿⠟⠛⠋⠁⣰⠇⠄⢸⣿⣿⣿

        ');
    }
}
