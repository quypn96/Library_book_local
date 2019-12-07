<?php
namespace App\ViewComposers;

use Illuminate\View\View;
use Auth;

class NotificationViewComposer
{
     /**
      * Create a movie composer.
      *
      * @return void
      */


    /**
    * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {
        $notifications = Auth::user()->notifications;
        $view->with('notifications', end($notifications));
    }
}
