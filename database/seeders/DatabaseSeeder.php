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
        // Create admin user if not exists
        if (!User::where('email', 'admin123@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin123@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Create sample user if not exists
        $user = User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        // Create sample assessments if not exists
        if (!MentalHealthAssessment::where('title', 'Assessment Kecemasan Harian')->exists()) {
            MentalHealthAssessment::create([
                'user_id' => $user->id,
                'title' => 'Assessment Kecemasan Harian',
                'description' => 'Assessment untuk mengukur tingkat kecemasan harian',
                'category' => 'anxiety',
                'status' => 'completed',
                'score' => 75,
                'completed_at' => now(),
            ]);
        }

        if (!MentalHealthAssessment::where('title', 'Assessment Stres Kerja')->exists()) {
            MentalHealthAssessment::create([
                'user_id' => $user->id,
                'title' => 'Assessment Stres Kerja',
                'description' => 'Assessment untuk mengukur tingkat stres di tempat kerja',
                'category' => 'stress',
                'status' => 'in_progress',
            ]);
        }

        // Create sample journal entries if not exists
        if (!JournalEntry::where('title', 'Hari yang Menyenangkan')->exists()) {
            JournalEntry::create([
                'user_id' => $user->id,
                'title' => 'Hari yang Menyenangkan',
                'content' => 'Hari ini adalah hari yang sangat menyenangkan. Saya berhasil menyelesaikan semua tugas yang ada dan merasa sangat puas dengan hasilnya.',
                'mood_score' => 8,
                'mood_description' => 'happy',
                'entry_date' => now()->subDays(1),
                'is_private' => false,
            ]);
        }

        if (!JournalEntry::where('title', 'Refleksi Mingguan')->exists()) {
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
}
