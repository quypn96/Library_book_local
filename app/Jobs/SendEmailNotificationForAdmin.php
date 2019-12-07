<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailNotification;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendEmailNotificationForAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $borrow;
    public $users;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Borrow $borrow, $users)
    {
        $this->borrow = $borrow;
        $this->users = $users;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->users as $user) {
            Mail::to($user->email)->send(new MailNotification($this->borrow));
        }
    }
}
