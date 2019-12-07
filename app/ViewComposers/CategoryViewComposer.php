<?php
 namespace App\Http\ViewComposers;

 use Illuminate\View\View;
 use App\Repositories\Category\CategoryRepository;

 class CategoryViewComposer
 {
     public $categoryRepository;
     /**
      * Create a movie composer.
      *
      * @return void
      */
     public function __construct(CategoryRepository $categoryRepository)
     {

     }

     /**
      * Bind data to the view.
      *
      * @param  View  $view
      * @return void
      */
     public function compose(View $view)
     {
         // $view->with('latestMovie', end($this->movieList));
     }
 }
