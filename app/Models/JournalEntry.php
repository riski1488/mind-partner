<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'mood_score',
        'mood_description',
        'image_path',
        'is_private',
        'entry_date',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'is_private' => 'boolean',
        'mood_score' => 'integer',
    ];

    /**
     * Get the user that owns the journal entry
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get mood description label
     */
    public function getMoodDescriptionLabelAttribute(): string
    {
        return match($this->mood_description) {
            'very_happy' => 'Sangat Bahagia',
            'happy' => 'Bahagia',
            'neutral' => 'Netral',
            'sad' => 'Sedih',
            'very_sad' => 'Sangat Sedih',
            'anxious' => 'Cemas',
            'stressed' => 'Stres',
            default => 'Tidak Diketahui',
        };
    }

    /**
     * Scope for private entries
     */
    public function scopePrivate($query)
    {
        return $query->where('is_private', true);
    }

    /**
     * Scope for public entries
     */
    public function scopePublic($query)
    {
        return $query->where('is_private', false);
    }
} 