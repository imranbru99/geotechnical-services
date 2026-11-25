<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(206) 555-0194',
            ]
        );
        $admin->syncRoles(['admin']);

        User::query()->updateOrCreate(
            ['email' => 'manager@bedrockforge.com'],
            [
                'name' => 'Soren Blake',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(206) 555-0194',
            ]
        )->syncRoles(['manager']);

        User::query()->updateOrCreate(
            ['email' => 'field@bedrockforge.com'],
            [
                'name' => 'Mei Tanaka',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(206) 555-0194',
            ]
        )->syncRoles(['staff']);

        $settings = [
            'company_name' => 'BedrockForge Geotech',
            'company_phone' => '(206) 555-0194',
            'company_email' => 'hello@bedrockforge.com',
            'whatsapp' => '12065550194',
            'service_area' => 'Seattle, Bellevue, Tacoma, Everett & Puget Sound',
            'tax_rate' => '10.25',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = array (
  0 => 
  array (
    'name' => 'Standard Boring Day',
    'sku' => 'GEO-BOR-D',
    'category' => 'field',
    'unit_cost' => 2200,
    'unit_price' => 4800,
    'stock_qty' => 999,
    'unit' => 'day',
  ),
  1 => 
  array (
    'name' => 'CPT Sounding',
    'sku' => 'GEO-CPT-1',
    'category' => 'field',
    'unit_cost' => 450,
    'unit_price' => 1100,
    'stock_qty' => 999,
    'unit' => 'sounding',
  ),
  2 => 
  array (
    'name' => 'Lab — Atterberg + Grain Size',
    'sku' => 'GEO-LAB-AG',
    'category' => 'lab',
    'unit_cost' => 55,
    'unit_price' => 145,
    'stock_qty' => 999,
    'unit' => 'sample',
  ),
  3 => 
  array (
    'name' => 'Lab — Direct Shear',
    'sku' => 'GEO-LAB-DS',
    'category' => 'lab',
    'unit_cost' => 120,
    'unit_price' => 320,
    'stock_qty' => 999,
    'unit' => 'test',
  ),
  4 => 
  array (
    'name' => 'Slope Stability Memo',
    'sku' => 'GEO-SLP-M',
    'category' => 'analysis',
    'unit_cost' => 800,
    'unit_price' => 2400,
    'stock_qty' => 999,
    'unit' => 'report',
  ),
  5 => 
  array (
    'name' => 'Seismic Site Class Letter',
    'sku' => 'GEO-SEI-L',
    'category' => 'analysis',
    'unit_cost' => 350,
    'unit_price' => 950,
    'stock_qty' => 999,
    'unit' => 'letter',
  ),
  6 => 
  array (
    'name' => 'Observation Half-Day',
    'sku' => 'GEO-OBS-H',
    'category' => 'field',
    'unit_cost' => 280,
    'unit_price' => 720,
    'stock_qty' => 999,
    'unit' => 'half-day',
  ),
  7 => 
  array (
    'name' => 'Shelby Tube Pack',
    'sku' => 'GEO-SHL-6',
    'category' => 'equipment',
    'unit_cost' => 40,
    'unit_price' => 95,
    'stock_qty' => 48,
    'unit' => 'pack',
  ),
);
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + ['is_active' => true]);
        }

        $customers = collect(array (
  0 => 
  array (
    'name' => 'Dana Okoye',
    'email' => 'dana@soundrise.dev',
    'phone' => '(206) 555-2201',
    'company' => 'Soundrise Development',
    'city' => 'Seattle',
    'state' => 'WA',
    'zip' => '98101',
    'address' => '1201 2nd Ave',
  ),
  1 => 
  array (
    'name' => 'Erik Lindqvist',
    'email' => 'erik@cascadecivil.com',
    'phone' => '(425) 555-2210',
    'company' => 'Cascade Civil Engineers',
    'city' => 'Bellevue',
    'state' => 'WA',
    'zip' => '98004',
    'address' => '500 108th Ave NE',
  ),
  2 => 
  array (
    'name' => 'Rosa Mendez',
    'email' => 'rosa@tacomapw.gov',
    'phone' => '(253) 555-2299',
    'company' => 'City of Tacoma Public Works',
    'city' => 'Tacoma',
    'state' => 'WA',
    'zip' => '98402',
    'address' => '747 Market St',
  ),
  3 => 
  array (
    'name' => 'Nate Crowley',
    'email' => 'nate.crowley@example.com',
    'phone' => '(425) 555-2188',
    'company' => NULL,
    'city' => 'Everett',
    'state' => 'WA',
    'zip' => '98201',
    'address' => '2930 Wetmore Ave',
  ),
  4 => 
  array (
    'name' => 'Yuki Nakamura',
    'email' => 'yuki@pierpointgc.com',
    'phone' => '(206) 555-2177',
    'company' => 'Pierpoint General Contractors',
    'city' => 'Seattle',
    'state' => 'WA',
    'zip' => '98134',
    'address' => '4401 E Marginal Way S',
  ),
))->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $projects = array (
  0 => 
  array (
    'customer' => 0,
    'title' => 'Mid-rise foundation investigation — SLU',
    'service_type' => 'foundation',
    'status' => 'scheduled',
    'sq_ft' => 0,
    'quoted_amount' => 28500,
  ),
  1 => 
  array (
    'customer' => 1,
    'title' => 'Bluff slope stability — Bellevue lot',
    'service_type' => 'slope',
    'status' => 'in_progress',
    'sq_ft' => 0,
    'quoted_amount' => 16400,
  ),
  2 => 
  array (
    'customer' => 2,
    'title' => 'Arterial pavement subgrade study',
    'service_type' => 'pavement',
    'status' => 'quoted',
    'sq_ft' => 0,
    'quoted_amount' => 9200,
  ),
  3 => 
  array (
    'customer' => 3,
    'title' => 'Residential seismic site class letter',
    'service_type' => 'seismic',
    'status' => 'completed',
    'sq_ft' => 0,
    'quoted_amount' => 1450,
    'final_amount' => 1450,
  ),
  4 => 
  array (
    'customer' => 4,
    'title' => 'Deep excavation observation — pier',
    'service_type' => 'observation',
    'status' => 'invoiced',
    'sq_ft' => 0,
    'quoted_amount' => 18750,
    'final_amount' => 19200,
  ),
);

        $projectModels = [];
        foreach ($projects as $i => $p) {
            $customer = $customers[$p['customer']];
            $projectModels[] = Project::query()->updateOrCreate(
                ['job_number' => 'JOB-26'.str_pad((string) ($i + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $customer->id,
                    'title' => $p['title'],
                    'service_type' => $p['service_type'],
                    'status' => $p['status'],
                    'sq_ft' => $p['sq_ft'],
                    'quoted_amount' => $p['quoted_amount'],
                    'final_amount' => $p['final_amount'] ?? null,
                    'start_date' => now()->subDays(10 - $i)->toDateString(),
                    'site_address' => trim(($customer->address ?? '').', '.$customer->city.', '.$customer->state),
                    'notes' => 'Seeded demo geotechnical project for BedrockForge ERP.',
                ]
            );
        }

        foreach ([0, 1, 3, 4] as $idx) {
            $project = $projectModels[$idx];
            $invoice = Invoice::query()->updateOrCreate(
                ['invoice_number' => 'INV-26'.str_pad((string) ($idx + 1), 3, '0', STR_PAD_LEFT)],
                [
                    'customer_id' => $project->customer_id,
                    'project_id' => $project->id,
                    'issue_date' => now()->subDays(8 - $idx)->toDateString(),
                    'due_date' => now()->addDays(14)->toDateString(),
                    'subtotal' => $project->final_amount ?? $project->quoted_amount,
                    'tax' => round(($project->final_amount ?? $project->quoted_amount) * 0.1025, 2),
                    'total' => round(($project->final_amount ?? $project->quoted_amount) * (1 + 0.1025), 2),
                    'amount_paid' => in_array($project->status, ['completed', 'invoiced'], true) ? round(($project->final_amount ?? $project->quoted_amount) * (1 + 0.1025), 2) : 0,
                    'status' => in_array($project->status, ['completed', 'invoiced'], true) ? 'paid' : 'sent',
                ]
            );

            if ($invoice->status === 'paid') {
                Payment::query()->updateOrCreate(
                    ['reference' => 'PMT-'.$invoice->invoice_number],
                    [
                        'invoice_id' => $invoice->id,
                        'amount' => $invoice->total,
                        'paid_at' => now()->subDays(3)->toDateString(),
                        'method' => 'ach',
                        'notes' => 'Demo payment',
                    ]
                );
            }
        }

        Appointment::query()->updateOrCreate(
            ['title' => 'Boring crew — Soundrise SLU'],
            [
                'customer_id' => $customers[0]->id,
                'project_id' => $projectModels[0]->id,
                'type' => 'drilling',
                'starts_at' => now()->addDays(2)->setTime(7, 0),
                'ends_at' => now()->addDays(2)->setTime(16, 0),
                'status' => 'scheduled',
                'location' => $customers[0]->address,
            ]
        );
        Appointment::query()->updateOrCreate(
            ['title' => 'Slope site walk — Bellevue'],
            [
                'customer_id' => $customers[1]->id,
                'project_id' => $projectModels[1]->id,
                'type' => 'site_walk',
                'starts_at' => now()->addDays(4)->setTime(9, 0),
                'ends_at' => now()->addDays(4)->setTime(12, 0),
                'status' => 'confirmed',
                'location' => $customers[1]->address,
            ]
        );

        $posts = array (
  0 => 
  array (
    'title' => 'What Seattle Mid-Rise Foundations Need from Geotech',
    'excerpt' => 'Bearing, settlement, and liquefaction screening — the trio structural engineers actually use.',
    'cover' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1400&q=80',
    'body' => 'A foundation report that only dumps boring logs is unfinished. BedrockForge pairs subsurface data with design parameters, settlement estimates, and clear construction notes for GCs.',
  ),
  1 => 
  array (
    'title' => 'Reading a Bluff Lot Before You Buy',
    'excerpt' => 'Groundwater, residual strength, and drainage — questions hillside buyers should ask early.',
    'cover' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1400&q=80',
    'body' => 'Puget Sound bluffs can look stable until a wet winter. Slope evaluations catch the failure modes that surprise owners after closing.',
  ),
  2 => 
  array (
    'title' => 'Site Class Without Guesswork',
    'excerpt' => 'Vs30 methods and when a letter is enough versus a fuller seismic study.',
    'cover' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1400&q=80',
    'body' => 'Building officials want documented site class. We match method complexity to project risk so you are not overpaying for Class D when Class C is justified — or the reverse.',
  ),
);
        foreach ($posts as $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'body' => $post['body'],
                    'cover_image' => $post['cover'],
                    'is_published' => true,
                    'published_at' => now()->subDays(random_int(2, 20)),
                ]
            );
        }

        $articles = array (
  0 => 
  array (
    'category' => 'issues',
    'title' => 'Unexpected soft clay in excavation',
    'body' => 'Stop dig. Notify BedrockForge. Photograph and log elevations. Do not place foundations on unverified fill. Update recommendations before concrete.',
  ),
  1 => 
  array (
    'category' => 'issues',
    'title' => 'Slope seepage after grading',
    'body' => 'Install temporary drainage, keep surcharge off the crest, and schedule an observation visit. Document piezometer or weep observations in the job record.',
  ),
  2 => 
  array (
    'category' => 'guides',
    'title' => 'How to prepare a site for borings',
    'body' => 'Mark utilities (811). Clear drill access. Provide proposed footing plans. Unlock gates. Share known fill history before the crew mobilizes.',
  ),
  3 => 
  array (
    'category' => 'guides',
    'title' => 'Geotech timeline from proposal to report',
    'body' => 'Week 0: Proposal & utility locate.
Week 1: Field exploration.
Weeks 2–3: Lab + analysis.
Closeout: Draft report, revision, final PDF.',
  ),
  4 => 
  array (
    'category' => 'admin',
    'title' => 'Admin ERP quick start',
    'body' => 'Login at /admin with admin@example.com / password.
1. Add clients.
2. Create projects with service type.
3. Schedule drilling and observation.
4. Invoice and record payments.
5. Use AI Studio.
6. Update Settings.',
  ),
  5 => 
  array (
    'category' => 'admin',
    'title' => 'Roles: Admin, Manager, Staff',
    'body' => 'Admin: full ERP + settings + users.
Manager: projects, inventory, invoices, scheduling.
Staff: field logs and appointment updates.',
  ),
  6 => 
  array (
    'category' => 'troubleshoot',
    'title' => 'Drill refusal before target depth',
    'body' => 'Record refusal elevation. Attempt offset boring if safe. Update foundation assumptions and notify the structural engineer the same day.',
  ),
  7 => 
  array (
    'category' => 'troubleshoot',
    'title' => 'Chatbot giving demo answers only',
    'body' => 'Add OPENAI_API_KEY or GEMINI_API_KEY to .env for live model replies.',
  ),
);
        foreach ($articles as $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                [
                    'title' => $article['title'],
                    'category' => $article['category'],
                    'body' => $article['body'],
                    'is_published' => true,
                ]
            );
        }
    }
}