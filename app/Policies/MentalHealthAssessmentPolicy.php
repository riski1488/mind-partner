<?php

namespace App\Policies;

use App\Models\MentalHealthAssessment;
use App\Models\User;

class MentalHealthAssessmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MentalHealthAssessment $assessment): bool
    {
        return $user->id === $assessment->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MentalHealthAssessment $assessment): bool
    {
        return $user->id === $assessment->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MentalHealthAssessment $assessment): bool
    {
        return $user->id === $assessment->user_id || $user->isAdmin();
    }
} 