<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MentalHealthAssessment;
use App\Models\JournalEntry;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create sample user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create sample assessments
        MentalHealthAssessment::create([
            'user_id' => $user->id,
            'title' => 'Assessment Kecemasan Harian',
            'description' => 'Assessment untuk mengukur tingkat kecemasan harian',
            'category' => 'anxiety',
            'status' => 'completed',
            'score' => 75,
            'completed_at' => now(),
        ]);

        MentalHealthAssessment::create([
            'user_id' => $user->id,
            'title' => 'Assessment Stres Kerja',
            'description' => 'Assessment untuk mengukur tingkat stres di tempat kerja',
            'category' => 'stress',
            'status' => 'in_progress',
        ]);

        // Create sample journal entries
        JournalEntry::create([
            'user_id' => $user->id,
            'title' => 'Hari yang Menyenangkan',
            'content' => 'Hari ini adalah hari yang sangat menyenangkan. Saya berhasil menyelesaikan semua tugas yang ada dan merasa sangat puas dengan hasilnya.',
            'mood_score' => 8,
            'mood_description' => 'happy',
            'entry_date' => now()->subDays(1),
            'is_private' => false,
        ]);

        JournalEntry::create([
            'user_id' => $user->id,
            'title' => 'Refleksi Mingguan',
            'content' => 'Minggu ini penuh dengan tantangan, tapi saya berhasil mengatasinya dengan baik. Saya belajar banyak hal baru dan merasa lebih percaya diri.',
            'mood_score' => 7,
            'mood_description' => 'neutral',
            'entry_date' => now()->subDays(3),
            'is_private' => true,
        ]);
    }
}
