<?php

namespace App\Http\Controllers;

use App\Models\JournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JournalEntryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $journals = Auth::user()->journalEntries()->latest()->paginate(10);
        return view('journals.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('journals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'mood_score' => 'nullable|integer|min:1|max:10',
            'mood_description' => 'nullable|in:very_happy,happy,neutral,sad,very_sad,anxious,stressed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_private' => 'boolean',
            'entry_date' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'mood_score' => $request->mood_score,
            'mood_description' => $request->mood_description,
            'is_private' => $request->has('is_private'),
            'entry_date' => $request->entry_date,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('journal-images', 'public');
            $data['image_path'] = $imagePath;
        }

        $journal = Auth::user()->journalEntries()->create($data);

        return redirect()->route('journals.show', $journal)
            ->with('success', 'Jurnal berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JournalEntry $journal)
    {
        $this->authorize('view', $journal);
        return view('journals.show', compact('journal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JournalEntry $journal)
    {
        $this->authorize('update', $journal);
        return view('journals.edit', compact('journal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JournalEntry $journal)
    {
        $this->authorize('update', $journal);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'mood_score' => 'nullable|integer|min:1|max:10',
            'mood_description' => 'nullable|in:very_happy,happy,neutral,sad,very_sad,anxious,stressed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_private' => 'boolean',
            'entry_date' => 'required|date|before_or_equal:today',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'mood_score' => $request->mood_score,
            'mood_description' => $request->mood_description,
            'is_private' => $request->has('is_private'),
            'entry_date' => $request->entry_date,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($journal->image_path) {
                Storage::disk('public')->delete($journal->image_path);
            }
            
            $imagePath = $request->file('image')->store('journal-images', 'public');
            $data['image_path'] = $imagePath;
        }

        $journal->update($data);

        return redirect()->route('journals.show', $journal)
            ->with('success', 'Jurnal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JournalEntry $journal)
    {
        $this->authorize('delete', $journal);
        
        // Delete image if exists
        if ($journal->image_path) {
            Storage::disk('public')->delete($journal->image_path);
        }
        
        $journal->delete();
        
        return redirect()->route('journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }
} 