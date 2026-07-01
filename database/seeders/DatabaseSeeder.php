<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\JobCircular;
use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'platform.pipra@gmail.com'],
            [
                'name' => 'Admin',
                'password' => '12345678',
                'is_admin' => true,
            ]
        );

        $settings = [
            'site_name' => 'Pipra',
            'site_email' => 'epipra.bd@gmail.com',
            'site_phone' => '01601-041123',
            'site_address' => 'Shop No-81, 82, Station Road, Railway Market, Puran Bogra, Bangladesh',
            'footer_text' => 'Copyright © 2024 Pipra',
            'footer_services' => "Architecture|#\n3D Animation|#\nHouse Planning|#\nInterior Design|#\nConstruction|#",
            'footer_quick_links' => "About Us|/about\nContact Us|/contact\nOur Services|/projects\nTerms & Condition|#\nSupport|/contact",
            'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2483.010148022944!2d-0.13445098404809602!3d51.51302981811226!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604d31cdfefbb%3A0x27d5339f1859d7f1!2s62%20Dean%20St%2C%20London%20W1D%204QF%2C%20UK!5e0!3m2!1sen!2sin!4v1666266891426!5m2!1sen!2sin',
            'facebook' => '#',
            'twitter' => '#',
            'linkedin' => '#',
            'instagram' => '#',
            'youtube' => '#',
            'rss' => '#',
            'meta_keywords' => 'architecture, interior design, construction, modern template, building',
            'og_title' => 'Modern Template | Creative Architecture Studio',
            'og_description' => 'We are a creative architecture studio specializing in modern interior design and construction projects.',
        ];

        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        Page::updateOrCreate(['slug' => 'home'], [
            'title' => 'Home',
            'meta_title' => 'Modern Template | Home',
            'subtitle' => 'Welcome',
            'heading' => 'We are creative Architecture Studio',
            'content' => '<p><b>Dummy text is also used to demonstrate the appearance of different typefaces and layouts.</b></p><p>typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.</p>',
            'intro_image' => 'images/gallery/portrait/pic2.jpg',
            'who_subtitle' => 'Wo we are',
            'who_heading' => 'We are creative architecture Studio',
            'who_content' => 'Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general the content of dummy text is nonsensical. Due to its widespread use texts.',
            'who_badge_strong' => '30+ Projects',
            'who_badge_span' => 'Completed',
            'facts_subtitle' => 'Some',
            'facts_heading' => 'Intresting Facts',
            'facts_content' => 'Morbi mattis ex non urna condimentum, eget eleif end diam molestie. Curabitur lorem enim, maximus non nulla sed, egestas venenatis felis.',
            'facts_bg_image' => 'images/background/bg-11.jpg',
            'facts_stats' => [
                ['value' => '451', 'label' => 'Happy Clients'],
                ['value' => '532', 'label' => 'Finished projects'],
                ['value' => '299', 'label' => 'Working Days'],
            ],
            'is_published' => true,
        ]);

        Page::updateOrCreate(['slug' => 'about'], [
            'title' => 'About Us',
            'banner_title' => 'Fusing logic with imagination and truth with discovery.',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Modern Template | About',
            'subtitle' => 'About Us',
            'heading' => 'Our mission is the best interior design & development.',
            'content' => '<p><b>Dummy text is also used to demonstrate the appearance of different typefaces and layouts, and in general</b></p><p class="text-lowercase">typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.</p>',
            'about_gallery_images' => [
                'images/gallery/portrait/pic2.jpg',
                'images/gallery/portrait/pic3.jpg',
                'images/gallery/portrait/pic4.jpg',
                'images/gallery/portrait/pic5.jpg',
                'images/gallery/portrait/pic6.jpg',
            ],
            'about_button_text' => 'Contact Us',
            'about_button_link' => '/contact',
            'experts_heading' => 'Our experts',
            'experts_bg_image' => 'images/background/ptn-1.png',
            'show_experts_section' => true,
            'is_published' => true,
        ]);

        Page::updateOrCreate(['slug' => 'contact'], [
            'title' => 'Contact Us',
            'banner_title' => 'Inspired design for people',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Modern Template | Contact',
            'is_published' => true,
        ]);

        Page::updateOrCreate(['slug' => 'projects'], [
            'title' => 'Projects',
            'banner_title' => 'Creating places that enhance the human experience.',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Projects',
            'is_published' => true,
        ]);

        Page::updateOrCreate(['slug' => 'career'], [
            'title' => 'Career',
            'banner_title' => 'Join our team — explore career opportunities',
            'banner_image' => 'images/background/bg-11.jpg',
            'meta_title' => 'Career',
            'is_published' => true,
        ]);

        $categories = [
            ['name' => 'House', 'slug' => 'house'],
            ['name' => 'Building', 'slug' => 'building'],
            ['name' => 'Office', 'slug' => 'office'],
            ['name' => 'Garden', 'slug' => 'garden'],
            ['name' => 'Interior', 'slug' => 'interior'],
        ];

        foreach ($categories as $i => $cat) {
            ProjectCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'sort_order' => $i + 1, 'is_active' => true]
            );
        }

        $images = [
            'images/gallery/portrait/pic1.jpg',
            'images/gallery/portrait/pic2.jpg',
            'images/gallery/portrait/pic3.jpg',
            'images/gallery/portrait/pic4.jpg',
            'images/gallery/portrait/pic5.jpg',
            'images/gallery/portrait/pic6.jpg',
            'images/gallery/portrait/pic7.jpg',
        ];

        foreach (range(1, 10) as $i) {
            Project::updateOrCreate(
                ['slug' => 'triangle-concrete-house-' . $i],
                [
                    'title' => $i <= 5 ? 'New Acropolis Museum' : 'Triangle Concrete House on lake',
                    'excerpt' => 'Mattis ex non urna condimentum, eget eleifend diam molestie. Curabitur lorem enimnulla sed, egestas, maximus non nulla sed, egestas venenatis felis',
                    'description' => 'Typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.typefaces of dummy text is nonsensical.',
                    'image' => $i <= 5 ? "images/projects/pic-{$i}.jpg" : $images[($i - 1) % count($images)],
                    'banner_image' => 'images/background/bg-11.jpg',
                    'project_category_id' => (($i - 1) % 5) + 1,
                    'project_date' => now()->subMonths($i),
                    'client' => 'Branding NthPsd Company',
                    'project_type' => 'Construction, Branding',
                    'creative_director' => 'Lorem Ipsum doler',
                    'is_published' => true,
                    'is_featured' => $i <= 6,
                    'sort_order' => $i,
                ]
            );
        }

        $sliderContent = [
            1 => ['title' => 'Virtually Build Your House', 'subtitle' => 'GENERAL', 'description' => 'Excepteur sint occaecat cupidatat non proident laborum.'],
            2 => ['title' => 'Natural plus modern.', 'subtitle' => 'GENERAL', 'description' => 'sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'],
            3 => ['title' => 'Creative & Professional', 'subtitle' => 'GENERAL', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.'],
        ];

        foreach (range(1, 3) as $i) {
            Slider::updateOrCreate(
                ['sort_order' => $i],
                [
                    'title' => $sliderContent[$i]['title'],
                    'subtitle' => $sliderContent[$i]['subtitle'],
                    'description' => $sliderContent[$i]['description'],
                    'image' => "images/main-slider/slider1/slide{$i}.jpg",
                    'button_text' => null,
                    'button_link' => null,
                    'is_active' => true,
                ]
            );
        }

        $team = [
            ['name' => 'Robert willson', 'position' => 'Co-manager associated', 'image' => 'images/our-team5/pic1.jpg', 'featured' => true],
            ['name' => 'David Gray', 'position' => 'Co-manager associated', 'image' => 'images/our-team5/pic2.jpg', 'featured' => false],
            ['name' => 'Taylor Roberts', 'position' => 'Co-manager associated', 'image' => 'images/our-team5/pic3.jpg', 'featured' => false],
            ['name' => 'Robert willson', 'position' => 'Co-manager associated', 'image' => 'images/our-team5/pic4.jpg', 'featured' => false],
        ];

        foreach ($team as $i => $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name'], 'sort_order' => $i + 1],
                [
                    'position' => $member['position'],
                    'image' => $member['image'],
                    'is_featured' => $member['featured'],
                    'is_active' => true,
                    'sort_order' => $i + 1,
                ]
            );
        }

        $testimonialData = [
            ['name' => 'Taylor Roberts', 'position' => 'Co-manager associated', 'image' => 'images/testimonials/pic1.jpg', 'quote' => 'typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.typefaces of dummy text is nonsensical.'],
            ['name' => 'Robert willson', 'position' => 'Co-manager associated', 'image' => 'images/testimonials/pic4.jpg', 'quote' => 'typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.typefaces of dummy text is nonsensical.'],
            ['name' => 'Taylor Roberts', 'position' => 'Co-manager associated', 'image' => 'images/testimonials/pic2.jpg', 'quote' => 'typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.typefaces of dummy text is nonsensical.'],
            ['name' => 'Robert willson', 'position' => 'Co-manager associated', 'image' => 'images/testimonials/pic3.jpg', 'quote' => 'typefaces and layouts, and in appearance of different general the content of dummy text is nonsensical.typefaces of dummy text is nonsensical.'],
        ];

        foreach ($testimonialData as $i => $item) {
            Testimonial::updateOrCreate(
                ['sort_order' => $i + 1],
                array_merge($item, ['is_active' => true, 'sort_order' => $i + 1])
            );
        }

        foreach (range(1, 6) as $i) {
            Client::updateOrCreate(
                ['sort_order' => $i],
                [
                    'name' => "Client {$i}",
                    'logo' => "images/client-logo/w{$i}.png",
                    'url' => '/about',
                    'is_active' => true,
                ]
            );
        }

        $jobs = [
            [
                'title' => 'Senior Architect',
                'slug' => 'senior-architect',
                'department' => 'Design',
                'job_type' => 'Full-time',
                'location' => 'New York, USA',
                'vacancies' => 2,
                'excerpt' => 'We are looking for an experienced architect to lead residential and commercial design projects.',
                'description' => '<p><b>Responsibilities:</b></p><ul><li>Lead design concepts and client presentations</li><li>Manage project timelines and teams</li><li>Ensure quality standards across deliverables</li></ul><p><b>Requirements:</b></p><ul><li>5+ years of architecture experience</li><li>Proficiency in AutoCAD and Revit</li><li>Strong communication skills</li></ul>',
            ],
            [
                'title' => 'Interior Designer',
                'slug' => 'interior-designer',
                'department' => 'Interior',
                'job_type' => 'Full-time',
                'location' => 'Remote / Hybrid',
                'vacancies' => 1,
                'excerpt' => 'Join our creative team to design stunning interior spaces for modern homes and offices.',
                'description' => '<p><b>Responsibilities:</b></p><ul><li>Create mood boards and interior layouts</li><li>Select materials, furniture, and finishes</li><li>Collaborate with architects and clients</li></ul><p><b>Requirements:</b></p><ul><li>3+ years interior design experience</li><li>Portfolio of completed projects</li><li>Knowledge of current design trends</li></ul>',
            ],
            [
                'title' => 'Project Manager',
                'slug' => 'project-manager',
                'department' => 'Operations',
                'job_type' => 'Contract',
                'location' => 'London, UK',
                'vacancies' => 1,
                'excerpt' => 'Coordinate construction projects from planning through completion with our expert team.',
                'description' => '<p><b>Responsibilities:</b></p><ul><li>Oversee project budgets and schedules</li><li>Liaise with contractors and stakeholders</li><li>Report progress to senior management</li></ul><p><b>Requirements:</b></p><ul><li>PMP certification preferred</li><li>Construction industry experience</li><li>Excellent organizational skills</li></ul>',
            ],
        ];

        foreach ($jobs as $i => $job) {
            JobCircular::updateOrCreate(
                ['slug' => $job['slug']],
                array_merge($job, [
                    'deadline' => now()->addMonths(2),
                    'is_published' => true,
                    'show_on_home' => true,
                    'sort_order' => $i + 1,
                ])
            );
        }
    }
}
