<?php

namespace App\Repositories\Notification;

use App\Repositories\EloquentRepository;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Repositories\Notification\NotificationRepositoryInterface;

class NotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{

    public function getModel()
    {
        return Notification::class;
    }

}
