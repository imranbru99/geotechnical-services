<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\KnowledgeArticle;
use App\Models\Post;
use App\Services\AiService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('posts'));
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function serviceShow(string $slug): View
    {
        $services = $this->serviceCatalog();
        abort_unless(isset($services[$slug]), 404);

        return view('services.show', [
            'slug' => $slug,
            'service' => $services[$slug],
            'services' => $services,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'phone' => ['nullable', 'string', 'max:40'],
            'subject' => ['nullable', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        ContactMessage::query()->create($data);

        return back()->with('success', 'Thanks! StratumForge Geotech will follow up within one business day.');
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_published', true)->latest('published_at')->paginate(9);

        return view('blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = Post::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('blog.show', compact('post'));
    }

    public function knowledge(): View
    {
        $articles = KnowledgeArticle::query()->where('is_published', true)->orderBy('category')->orderBy('title')->get()->groupBy('category');

        return view('kb.index', compact('articles'));
    }

    public function knowledgeShow(string $slug): View
    {
        $article = KnowledgeArticle::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();

        return view('kb.show', compact('article'));
    }

    public function chat(Request $request, AiService $ai)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'session_id' => ['nullable', 'string', 'max:80'],
        ]);

        $result = $ai->chat($data['message'], $data['session_id'] ?? null);

        return response()->json($result);
    }

    /** @return array<string, array<string, string>> */
    protected function serviceCatalog(): array
    {
        return array (
  'foundation-investigation' => 
  array (
    'title' => 'Foundation Investigation',
    'summary' => 'Borings, CPT, and bearing recommendations for shallow and deep foundations.',
    'body' => 'StratumForge scopes foundation investigations for Seattle mid-rises, waterfront pads, and hillside homes — subsurface profiles, liquefaction screening, and design parameters engineers can put on drawings.',
    'image' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80',
  ),
  'slope-stability' => 
  array (
    'title' => 'Slope Stability Analysis',
    'summary' => 'Limit-equilibrium and observational approaches for bluffs, cuts, and landslide-prone lots.',
    'body' => 'Puget Sound bluffs demand careful groundwater and strength assumptions. We model critical surfaces, recommend drainage or retaining strategies, and document residual risk in plain language for owners and cities.',
    'image' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?auto=format&fit=crop&w=1600&q=80',
  ),
  'retaining-wall-support' => 
  array (
    'title' => 'Retaining Wall Design Support',
    'summary' => 'Lateral earth pressures, embedment, and drainage criteria for wall designers.',
    'body' => 'We deliver active/passive pressures, surcharge cases, and drainage details so structural and civil teams design walls that survive wet Seattle winters.',
    'image' => 'https://images.unsplash.com/photo-1590496793929-36417d3117b4?auto=format&fit=crop&w=1600&q=80',
  ),
  'pavement-subgrade' => 
  array (
    'title' => 'Pavement Subgrade Evaluation',
    'summary' => 'CBR, R-value, and resilient modulus support for roadway and parking designs.',
    'body' => 'From municipal overlays to private lots, StratumForge characterizes subgrade so pavement sections are neither overbuilt nor destined for early rutting.',
    'image' => 'https://images.unsplash.com/photo-1515162816999-a0c47dc590f2?auto=format&fit=crop&w=1600&q=80',
  ),
  'seismic-site-class' => 
  array (
    'title' => 'Seismic Site Classification',
    'summary' => 'Vs30 estimates and ASCE site class for permitting and structural design.',
    'body' => 'We combine borings, CPT, and geophysical methods where needed to assign site class with the documentation building officials expect on Puget Sound projects.',
    'image' => 'https://images.unsplash.com/photo-1487958449943-2429e8be8625?auto=format&fit=crop&w=1600&q=80',
  ),
  'construction-observation' => 
  array (
    'title' => 'Construction Observation',
    'summary' => 'On-call observation for excavations, piles, ground improvement, and fill placement.',
    'body' => 'Design intent dies in the trench without eyes on site. Our field engineers document conditions, approve deviations, and keep the project record tight for closeout.',
    'image' => 'https://images.unsplash.com/photo-1581092162384-8987c1d64718?auto=format&fit=crop&w=1600&q=80',
  ),
);
    }
}