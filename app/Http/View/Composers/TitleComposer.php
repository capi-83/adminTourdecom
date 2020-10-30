<?php


namespace App\Http\View\Composers;


use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class TitleComposer
{
    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct()
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
        $préfix = explode('.',Route::currentRouteName())[0];
        $title = config('titles.' . $préfix );
        $title = __('titles.' . $title);
        $view->with('title', $title);
    }
}
