<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MentalHealthAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'score',
        'category',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'score' => 'integer',
    ];

    /**
     * Get the user that owns the assessment
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get assessment category label
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'anxiety' => 'Kecemasan',
            'depression' => 'Depresi',
            'stress' => 'Stres',
            'mood' => 'Suasana Hati',
            default => 'Umum',
        };
    }

    /**
     * Get assessment status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'completed' => 'Selesai',
            'in_progress' => 'Sedang Berlangsung',
            'pending' => 'Menunggu',
            default => 'Belum Dimulai',
        };
    }
} 