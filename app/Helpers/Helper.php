<?php

namespace App\Helpers;

use Auth;
use App\Models\Book;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Repositories\User\UserRepository;
use App\Mail\MailWarning;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function checkUserIsLikeBook(Book $book)
    {
        if (Auth::check()) {
            if (in_array($book->id, Auth::user()->likes->pluck('book_id')->toArray())) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public static function saveImage($folder, $image, $pathDefault)
    {
        if (empty($image)) {

            return $pathDefault;
        }
        $fileName = $image->getClientOriginalName();
        $fileName = time() . $fileName;

        $path = $image->storeAs($folder, $fileName);

        return $path;
    }

    public static function saveImageProviderApi($userApi)
    {
        $fileContent = file_get_contents($userApi->getAvatar());
        $path = 'avatars/' . $userApi->getId() . '.jpg';
        $save = Storage::put($path, $fileContent);

        return $path;
    }

    public static function formatDate($date, $format = 'd/m/Y')
    {
        return Carbon::parse($date)->format($format);
    }

    public static function diffForHumans($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public static function addDayForDate($date, $day)
    {
        $date = strtotime("+".$day." days", strtotime($date));

        return  date("Y-m-d", $date);
    }

    public function sendEmailWarning()
    {
        $repo = new UserRepository();
        $users = $repo->getUsersAlmostDateReturnBook();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new MailWarning($user));
        }
    }

}
