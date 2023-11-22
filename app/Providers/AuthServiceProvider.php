<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Default\User' => 'App\Policies\UserPolicy',
        'App\Models\Default\Attachment' => 'App\Policies\AttachmentPolicy',
        'App\Models\Default\Comment' => 'App\Policies\CommentPolicy',
        'App\Models\Default\History' => 'App\Policies\HistoryPolicy',
        'App\Models\Default\Reply' => 'App\Policies\ReplyPolicy',
        'App\Models\Default\Task' => 'App\Policies\TaskPolicy',

        // ZTech
        'App\Models\ZTech\Batch' => 'App\Policies\ZTech\BatchPolicy',
        'App\Models\ZTech\Installment' => 'App\Policies\ZTech\InstallmentPolicy',
        'App\Models\ZTech\Notice' => 'App\Policies\ZTech\NoticePolicy',
        'App\Models\ZTech\Receipt' => 'App\Policies\ZTech\ReceiptPolicy',
        'App\Models\ZTech\Recovery' => 'App\Policies\ZTech\RecoveryPolicy',

        // 
        'App\Models\Targetly\SocialPostLink' => 'App\Policies\Targetly\SocialPostLinkPolicy',

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
