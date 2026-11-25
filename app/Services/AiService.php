<?php

namespace App\Services;

use App\Models\ChatLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AiService
{
    /** @var array<int, array{q: string, a: string}> */
    protected array $faq = array (
  0 => 
  array (
    'q' => 'foundation investigation boring cpt bearing settlement',
    'a' => 'Foundation investigations combine borings/CPT with bearing and settlement recommendations. BedrockForge delivers parameters Seattle structural teams can put on drawings — call (206) 555-0194.',
  ),
  1 => 
  array (
    'q' => 'slope stability bluff landslide drainage',
    'a' => 'Slope studies model critical surfaces and drainage strategies for Puget Sound bluffs and cuts, with residual risk stated clearly for owners and cities.',
  ),
  2 => 
  array (
    'q' => 'retaining wall lateral earth pressure drainage embedment',
    'a' => 'We provide lateral earth pressures, surcharge cases, embedment guidance, and drainage criteria for wall designers.',
  ),
  3 => 
  array (
    'q' => 'pavement subgrade cbr r-value roadway parking',
    'a' => 'Pavement subgrade evaluations characterize strength so sections are neither overbuilt nor prone to early rutting.',
  ),
  4 => 
  array (
    'q' => 'seismic site class vs30 asce permit',
    'a' => 'Seismic site classification uses Vs30-compatible methods and documentation building officials expect for ASCE site class.',
  ),
  5 => 
  array (
    'q' => 'construction observation excavation pile fill',
    'a' => 'Construction observation documents excavations, piles, ground improvement, and fill so design intent survives the trench.',
  ),
  6 => 
  array (
    'q' => 'schedule quote seattle bellevue tacoma everett cost price',
    'a' => 'Call (206) 555-0194, use the contact form, or WhatsApp. We serve Seattle, Bellevue, Tacoma, Everett, and the Puget Sound region.',
  ),
  7 => 
  array (
    'q' => 'turnaround report how long boring timeline',
    'a' => 'Typical exploration-to-report is two to four weeks depending on lab queue and access. Rush letters for site class are available — ask estimating.',
  ),
);

    public function chat(string $message, ?string $sessionId = null): array
    {
        $reply = null;
        $source = 'demo';

        if ($key = config('services.openai.key')) {
            try {
                $reply = $this->callOpenAi($message, $key);
                $source = 'openai';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply && ($gemini = config('services.gemini.key'))) {
            try {
                $reply = $this->callGemini($message, $gemini);
                $source = 'gemini';
            } catch (\Throwable) {
                $reply = null;
            }
        }

        if (! $reply) {
            $reply = $this->demoReply($message);
            $source = 'demo';
        }

        ChatLog::query()->create([
            'session_id' => $sessionId,
            'message' => $message,
            'reply' => $reply,
            'source' => $source,
        ]);

        return ['reply' => $reply, 'source' => $source];
    }

    public function generate(string $type, string $prompt): string
    {
        $message = match ($type) {
            'blog' => "Write a concise SEO blog post outline and intro for a geotechnical services business about: {$prompt}",
            'description' => "Write a compelling service description for geotechnical services: {$prompt}",
            'automation' => "Suggest 5 practical AI automations for a geotechnical services SME ERP related to: {$prompt}",
            'troubleshoot' => "Troubleshoot this geotechnical services operations issue with clear steps: {$prompt}",
            default => $prompt,
        };

        $result = $this->chat($message);

        return $result['reply'];
    }

    protected function demoReply(string $message): string
    {
        $hay = Str::lower($message);
        $best = null;
        $bestScore = 0;

        foreach ($this->faq as $item) {
            $score = 0;
            foreach (explode(' ', $item['q']) as $word) {
                if ($word !== '' && str_contains($hay, $word)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $item['a'];
            }
        }

        if ($best && $bestScore > 0) {
            return $best;
        }

        return 'Thanks for reaching BedrockForge Geotech. We provide foundation investigations, slope stability, retaining wall support, pavement subgrade evaluation, seismic site class, and construction observation across the Puget Sound. Ask about scope, timelines, or scheduling—or call (206) 555-0194.';
    }

    protected function callOpenAi(string $message, string $key): string
    {
        $response = Http::withToken($key)
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => config('services.openai.model', 'gpt-4o-mini'),
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are the BedrockForge Geotech assistant for a Seattle, WA geotechnical services firm. Be concise about foundations, slopes, retaining walls, pavement subgrade, seismic site class, construction observation, and scheduling. Never invent engineering stamps or guarantee permit approval.',
                    ],
                    ['role' => 'user', 'content' => $message],
                ],
                'temperature' => 0.4,
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'choices.0.message.content', 'Unable to generate a response.');
    }

    protected function callGemini(string $message, string $key): string
    {
        $model = config('services.gemini.model', 'gemini-1.5-flash');
        $response = Http::timeout(30)
            ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$key}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "BedrockForge Geotech assistant (Seattle / Puget Sound geotechnical services). Answer briefly:
{$message}"],
                        ],
                    ],
                ],
            ]);

        $response->throw();

        return (string) data_get($response->json(), 'candidates.0.content.parts.0.text', 'Unable to generate a response.');
    }
}