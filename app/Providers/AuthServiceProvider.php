<?php

namespace App\Providers;

use App\Models\MentalHealthAssessment;
use App\Models\JournalEntry;
use App\Policies\MentalHealthAssessmentPolicy;
use App\Policies\JournalEntryPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        MentalHealthAssessment::class => MentalHealthAssessmentPolicy::class,
        JournalEntry::class => JournalEntryPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
} 