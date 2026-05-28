<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use App\Models\PortfolioLink;
use App\Models\PortfolioProject;
use App\Models\PortfolioSection;
use App\Models\PortfolioSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $settings = PortfolioSetting::query()
            ->where('is_public', true)
            ->orderBy('group')
            ->orderBy('sort_order')
            ->get()
            ->mapWithKeys(fn (PortfolioSetting $setting) => [
                $setting->key => $setting->value['value'] ?? null,
            ]);

        $sections = PortfolioSection::query()
            ->where('is_enabled', true)
            ->orderBy('sort_order')
            ->get()
            ->keyBy('slug');

        $projects = PortfolioProject::query()
            ->where('is_enabled', true)
            ->orderBy('sort_order')
            ->get();

        $links = PortfolioLink::query()
            ->where('is_enabled', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group');

        return view('welcome', compact('settings', 'sections', 'projects', 'links'));
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:180'],
            'message' => ['required', 'string', 'min:5', 'max:3000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email belum benar.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan terlalu pendek.',
        ]);

        ContactSubmission::create([
            ...$validated,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return back()->with('contact_success', 'Pesan kamu sudah terkirim. Terima kasih!');
    }
}
