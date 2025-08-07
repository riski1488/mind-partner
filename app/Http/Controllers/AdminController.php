<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MentalHealthAssessment;
use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Hapus constructor, middleware sudah diatur di route

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

    // Edit assessment (admin)
    public function editAssessment(MentalHealthAssessment $assessment)
    {
        return view('admin.assessments.edit', compact('assessment'));
    }

    public function updateAssessment(Request $request, MentalHealthAssessment $assessment)
    {
        $validator = Validator::make($request->all(), [
            'score' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:pending,in_progress,completed',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = [
            'status' => $request->status,
        ];
        if ($request->filled('score')) {
            $data['score'] = $request->score;
        }
        if ($request->status === 'completed' && !$assessment->completed_at) {
            $data['completed_at'] = now();
        }
        $assessment->update($data);
        return redirect()->route('admin.assessments')->with('success', 'Assessment berhasil diupdate!');
    }

    public function destroyAssessment(MentalHealthAssessment $assessment)
    {
        $assessment->delete();
        return redirect()->route('admin.assessments')->with('success', 'Assessment berhasil dihapus!');
    }

    /**
     * Tampilkan form edit user
     */
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update data user
     */
    public function updateUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:user,admin',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user->update($request->only(['name', 'email', 'role']));
        return redirect()->route('admin.users')->with('success', 'User berhasil diupdate!');
    }

    /**
     * Hapus user
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User berhasil dihapus!');
    }

    /**
     * Tampilkan form edit jurnal
     */
    public function editJournal(JournalEntry $journal)
    {
        return view('admin.journals.edit', compact('journal'));
    }

    /**
     * Update status jurnal
     */
    public function updateJournal(Request $request, JournalEntry $journal)
    {
        $validator = Validator::make($request->all(), [
            'is_private' => 'required|in:0,1',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $journal->is_private = $request->is_private;
        $journal->save();
        return redirect()->route('admin.journals')->with('success', 'Status jurnal berhasil diupdate!');
    }

    /**
     * Hapus jurnal
     */
    public function destroyJournal(JournalEntry $journal)
    {
        $journal->delete();
        return redirect()->route('admin.journals')->with('success', 'Jurnal berhasil dihapus!');
    }
} 