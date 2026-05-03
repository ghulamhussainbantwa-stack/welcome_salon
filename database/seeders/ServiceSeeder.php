<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Signature Precision Cut',
                'price' => 85.00,
                'duration' => 60,
                'description' => 'A bespoke haircut tailored to your face shape and hair texture by our master stylists.',
                'image_url' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?q=80&w=800'
            ],
            [
                'name' => 'Balayage Artistry',
                'price' => 250.00,
                'duration' => 180,
                'description' => 'Hand-painted highlights for a natural, sun-kissed look with seamless transitions.',
                'image_url' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?q=80&w=800'
            ],
            [
                'name' => 'Royal Shave Experience',
                'price' => 65.00,
                'duration' => 45,
                'description' => 'Classic hot towel shave with premium essential oils and a soothing facial massage.',
                'image_url' => 'https://images.unsplash.com/photo-1503951914875-452162b0f3f1?q=80&w=800'
            ],
            [
                'name' => 'Olaplex Therapy',
                'price' => 120.00,
                'duration' => 90,
                'description' => 'Revolutionary bond-building treatment to repair and protect damaged hair.',
                'image_url' => 'https://images.unsplash.com/photo-1527799858524-8b18b7a00d49?q=80&w=800'
            ],
            [
                'name' => 'Hydra-Glow Facial',
                'price' => 150.00,
                'duration' => 75,
                'description' => 'Advanced skin resurfacing and hydration treatment for an instant, radiant glow.',
                'image_url' => 'https://images.unsplash.com/photo-1512290923902-8a9f81dc2069?q=80&w=800'
            ],
            [
                'name' => 'Keratin Smoothing',
                'price' => 300.00,
                'duration' => 150,
                'description' => 'Eliminate frizz and reduce styling time with our long-lasting keratin treatment.',
                'image_url' => 'https://images.unsplash.com/photo-1560869713-7d0a29430803?q=80&w=800'
            ],
            [
                'name' => 'Gentleman’s Executive Cut',
                'price' => 55.00,
                'duration' => 45,
                'description' => 'Sharp, tailored cut including a wash, style, and shoulder massage.',
                'image_url' => 'https://images.unsplash.com/photo-1621605815841-2da41ee70b9a?q=80&w=800'
            ],
            [
                'name' => 'Deep Tissue Scalp Ritual',
                'price' => 95.00,
                'duration' => 60,
                'description' => 'Stress-relieving head and neck massage with botanical infusions.',
                'image_url' => 'https://images.unsplash.com/photo-1519699047748-de8e457a634e?q=80&w=800'
            ],
            [
                'name' => 'Bridal Trial Session',
                'price' => 180.00,
                'duration' => 120,
                'description' => 'Work one-on-one with our senior artists to perfect your wedding day look.',
                'image_url' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?q=80&w=800'
            ],
            [
                'name' => 'Full Head Highlight',
                'price' => 210.00,
                'duration' => 150,
                'description' => 'Complete blonde transformation or multi-dimensional color depth.',
                'image_url' => 'https://images.unsplash.com/photo-1634449571010-02389ed0f9b0?q=80&w=800'
            ],
            [
                'name' => 'Nail Couture Manicure',
                'price' => 75.00,
                'duration' => 60,
                'description' => 'Luxury hand treatment including cuticle care, exfoliation, and gel finish.',
                'image_url' => 'https://images.unsplash.com/photo-1604654894610-df49ff6697ad?q=80&w=800'
            ],
            [
                'name' => 'Beard Sculpting',
                'price' => 45.00,
                'duration' => 30,
                'description' => 'Detailed shaping and trimming for the modern man.',
                'image_url' => 'https://images.unsplash.com/photo-1593702295094-ade34350338f?q=80&w=800'
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service);
        }
    }
}
