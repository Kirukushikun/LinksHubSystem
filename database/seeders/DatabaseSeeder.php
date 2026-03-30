<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Link;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Categories & Links from mockup ──────────────────

        // 1. Asana
        $asana = Category::create([
            'name'  => 'Asana',
            'color' => 'asana',
            'icon'  => '📋',
            'order' => 1,
        ]);

        Link::insert([
            [
                'category_id' => $asana->id,
                'name'        => 'BFC Main Workspace',
                'url'         => '#',
                'description' => 'Primary project management',
                'icon'        => '🏢',
                'order'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $asana->id,
                'name'        => 'Team Tasks',
                'url'         => '#',
                'description' => 'Assigned tasks & deadlines',
                'icon'        => '✅',
                'order'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $asana->id,
                'name'        => 'Project Tracker',
                'url'         => '#',
                'description' => 'Active project timelines',
                'icon'        => '📊',
                'order'       => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $asana->id,
                'name'        => 'My Tasks',
                'url'         => '#',
                'description' => 'Personal task list',
                'icon'        => '🎯',
                'order'       => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // 2. Web Apps
        $webapp = Category::create([
            'name'  => 'Web Apps',
            'color' => 'webapp',
            'icon'  => '🌐',
            'order' => 2,
        ]);

        Link::insert([
            [
                'category_id' => $webapp->id,
                'name'        => 'BGC Authenticator',
                'url'         => '#',
                'description' => 'Company systems portal',
                'icon'        => '🔐',
                'order'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $webapp->id,
                'name'        => 'Sales Dashboard',
                'url'         => '#',
                'description' => 'Realtime sales tracking',
                'icon'        => '📊',
                'order'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $webapp->id,
                'name'        => 'Digital Business Card',
                'url'         => '#',
                'description' => 'Employee digital cards',
                'icon'        => '🪪',
                'order'       => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $webapp->id,
                'name'        => 'Inventory System',
                'url'         => '#',
                'description' => 'Stock & warehouse tracking',
                'icon'        => '📦',
                'order'       => 4,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // 3. Resources
        $resource = Category::create([
            'name'  => 'Resources',
            'color' => 'resource',
            'icon'  => '📁',
            'order' => 3,
        ]);

        Link::insert([
            [
                'category_id' => $resource->id,
                'name'        => 'Company Drive',
                'url'         => '#',
                'description' => 'Shared files & documents',
                'icon'        => '📁',
                'order'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $resource->id,
                'name'        => 'Employee Handbook',
                'url'         => '#',
                'description' => 'Policies & guidelines',
                'icon'        => '📖',
                'order'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $resource->id,
                'name'        => 'Brand Assets',
                'url'         => '#',
                'description' => 'Logos, colors, templates',
                'icon'        => '🎨',
                'order'       => 3,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);

        // 4. Other
        $other = Category::create([
            'name'  => 'Other',
            'color' => 'other',
            'icon'  => '💬',
            'order' => 4,
        ]);

        Link::insert([
            [
                'category_id' => $other->id,
                'name'        => 'Team Chat',
                'url'         => '#',
                'description' => 'Internal messaging',
                'icon'        => '💬',
                'order'       => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'category_id' => $other->id,
                'name'        => 'Company Calendar',
                'url'         => '#',
                'description' => 'Events & schedules',
                'icon'        => '📅',
                'order'       => 2,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}