<?php

namespace App\Observers;

use App\Models\BlogCategory;
use Carbon\Carbon;
use Str;

class BlogCategoryObserver
{
    /**
     * Handle the blog category "created" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function created(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "updated" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function updated(BlogCategory $blogCategory)
    {
        //
    }


    public function creating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }
    public function updating(BlogCategory $blogCategory)
    {
        $this->setSlug($blogCategory);
    }

    public function setSlug(BlogCategory $blogCategory)
    {
        if (($blogCategory->slug) == null){
            $blogCategory->slug = Str::slug($blogCategory->title);
            //dd('BlogCategoryObserver - slug');
        }
    }
    /**
     * Handle the blog category "deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function deleted(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "restored" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function restored(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Handle the blog category "force deleted" event.
     *
     * @param  \App\Models\BlogCategory  $blogCategory
     * @return void
     */
    public function forceDeleted(BlogCategory $blogCategory)
    {
        //
    }
}
