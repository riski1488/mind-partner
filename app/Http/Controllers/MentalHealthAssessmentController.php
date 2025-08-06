<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MentalHealthAssessmentController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assessments = Auth::user()->assessments()->latest()->paginate(10);
        return view('assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assessments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:anxiety,depression,stress,mood,general',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $assessment = Auth::user()->assessments()->create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'status' => 'pending',
        ]);

        return redirect()->route('assessments.show', $assessment)
            ->with('success', 'Assessment berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MentalHealthAssessment $assessment)
    {
        $this->authorize('view', $assessment);
        return view('assessments.show', compact('assessment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MentalHealthAssessment $assessment)
    {
        $this->authorize('update', $assessment);
        return view('assessments.edit', compact('assessment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MentalHealthAssessment $assessment)
    {
        $this->authorize('update', $assessment);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:anxiety,depression,stress,mood,general',
            'score' => 'nullable|integer|min:0|max:100',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'status' => $request->status,
        ];

        if ($request->filled('score')) {
            $data['score'] = $request->score;
        }

        if ($request->status === 'completed' && !$assessment->completed_at) {
            $data['completed_at'] = now();
        }

        $assessment->update($data);

        return redirect()->route('assessments.show', $assessment)
            ->with('success', 'Assessment berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MentalHealthAssessment $assessment)
    {
        $this->authorize('delete', $assessment);
        
        $assessment->delete();
        
        return redirect()->route('assessments.index')
            ->with('success', 'Assessment berhasil dihapus!');
    }
} 