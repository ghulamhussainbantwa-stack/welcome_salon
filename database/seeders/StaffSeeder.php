<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staff = [
            [
                'name' => 'James Sterling',
                'role' => 'Creative Director',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=400',
                'instagram_url' => '#',
                'linkedin_url' => '#',
            ],
            [
                'name' => 'Elena Rossi',
                'role' => 'Master Colorist',
                'image_url' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=400',
                'instagram_url' => '#',
                'linkedin_url' => '#',
            ],
            [
                'name' => 'Marcus Thorne',
                'role' => 'Senior Barber',
                'image_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=400',
                'instagram_url' => '#',
                'linkedin_url' => '#',
            ],
            [
                'name' => 'Sophia Chen',
                'role' => 'Skin Specialist',
                'image_url' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=400',
                'instagram_url' => '#',
                'linkedin_url' => '#',
            ],
        ];

        foreach ($staff as $member) {
            Staff::updateOrCreate(['name' => $member['name']], $member);
        }
    }
}
