<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Community;
use App\Models\Contact;
use App\Models\Page;
use App\Models\ReportedComment;
use App\Models\ReportedStory;
use App\Models\Story;
use App\Models\User;
use App\Policies\CommunityPolicy;
use App\Policies\CommentPolicy;
use App\Policies\ContactPolicy;
use App\Policies\PagePolicy;
use App\Policies\ReportPolicy;
use App\Policies\StoryPolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Cviebrock\EloquentTaggable\Models\Tag;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Story::class => StoryPolicy::class,
        Comment::class => CommentPolicy::class,
        Community::class => CommunityPolicy::class,
        Page::class => PagePolicy::class,
        Contact::class => ContactPolicy::class,
        ReportedStory::class => ReportPolicy::class,
        ReportedComment::class => ReportPolicy::class,
        Tag::class => TagPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
