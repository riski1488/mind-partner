<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthAssessment;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        $recentAssessments = $user->assessments()
            ->latest()
            ->take(5)
            ->get();
            
        $recentJournals = $user->journalEntries()
            ->latest()
            ->take(5)
            ->get();
            
        $totalAssessments = $user->assessments()->count();
        $completedAssessments = $user->assessments()->where('status', 'completed')->count();
        $totalJournals = $user->journalEntries()->count();
        
        $moodStats = $user->journalEntries()
            ->whereNotNull('mood_score')
            ->selectRaw('AVG(mood_score) as avg_mood, COUNT(*) as total_entries')
            ->first();

        return view('dashboard.index', compact(
            'recentAssessments',
            'recentJournals',
            'totalAssessments',
            'completedAssessments',
            'totalJournals',
            'moodStats'
        ));
    }
} 