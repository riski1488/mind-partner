<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentalHealthAssessment;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show admin dashboard
     */
    public function index()
    {
        $totalUsers = User::count();
        $totalAssessments = MentalHealthAssessment::count();
        $totalJournals = JournalEntry::count();
        
        $recentUsers = User::latest()->take(5)->get();
        $recentAssessments = MentalHealthAssessment::with('user')->latest()->take(5)->get();
        
        $userStats = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();
            
        $assessmentStats = MentalHealthAssessment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAssessments', 
            'totalJournals',
            'recentUsers',
            'recentAssessments',
            'userStats',
            'assessmentStats'
        ));
    }

    /**
     * Show all users
     */
    public function users()
    {
        $users = User::withCount(['assessments', 'journalEntries'])
            ->latest()
            ->paginate(15);
            
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show all assessments
     */
    public function assessments()
    {
        $assessments = MentalHealthAssessment::with('user')
            ->latest()
            ->paginate(15);
            
        return view('admin.assessments.index', compact('assessments'));
    }

    /**
     * Show all journals
     */
    public function journals()
    {
        $journals = JournalEntry::with('user')
            ->latest()
            ->paginate(15);
            
        return view('admin.journals.index', compact('journals'));
    }
} 