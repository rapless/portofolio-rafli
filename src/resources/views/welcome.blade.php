@php
    $setting = fn (string $key, mixed $default = null) => $settings->get($key, $default);
    $home = $sections->get('home');
    $about = $sections->get('about');
    $portfolio = $sections->get('portfolio');
    $contact = $sections->get('contact');
    $navLinks = $links->get('navigation', collect([
        (object) ['label' => 'Home', 'url' => '#home'],
        (object) ['label' => 'About', 'url' => '#about'],
        (object) ['label' => 'Portfolio', 'url' => '#portfolio'],
        (object) ['label' => 'Contact', 'url' => '#contact'],
    ]));
    $socialLinks = $links->get('social', collect());
    $footerLinks = $links->get('footer', collect());
    $contactLinks = $links->get('contact', collect());
    $assetImage = function (?string $path) {
        if (blank($path)) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset(str_starts_with($path, 'storage/') ? $path : 'storage/' . $path);
    };
    $accentColor = $setting('accent_color', '#7c3aed');
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $setting('meta_description', 'Portfolio digital yang dikelola secara dinamis lewat admin panel.') }}">
    <title>{{ $setting('page_title', $setting('site_name', 'Portfolio')) }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('front/portfolio-modern.css') }}">
    <style>
        :root { --accent: {{ $accentColor }}; }
    </style>
</head>
<body>
    <div class="page-noise" aria-hidden="true"></div>

    <nav class="navbar" id="navbar">
        <a href="#home" class="logo" aria-label="Back to home">{{ $setting('site_name', 'RYFDLLAH') }}</a>

        <button class="mobile-menu-toggle" id="mobileMenuToggle" type="button" aria-label="Open navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-links" id="navLinks">
            @foreach ($navLinks as $link)
                <a href="{{ $link->url }}">{{ $link->label }}</a>
            @endforeach
            <a href="{{ $contact?->button_url ?: '#contact' }}" class="nav-cta">{{ $contact?->button_label ?: 'Contact Me' }}</a>
        </div>
    </nav>

    <main>
        <section id="home" class="hero section-shell">
            <div class="orb orb-one"></div>
            <div class="orb orb-two"></div>

            <div class="hero-copy reveal">
                <p class="eyebrow">{{ $home?->eyebrow ?: 'Portofolio' }}</p>
                <h1>{{ $home?->title ?: 'RAFLY FADHILLAH' }}</h1>
                <p class="hero-subtitle">{{ $home?->subtitle ?: 'Website portfolio dinamis berbasis Laravel dan Filament.' }}</p>

                <div class="hero-actions">
                    <a href="{{ $home?->button_url ?: '#portfolio' }}" class="button button-primary">{{ $home?->button_label ?: 'Lihat Project' }}</a>
                    <a href="#about" class="button button-ghost">Kenalan dulu</a>
                </div>

                @if (! empty($home?->items))
                    <div class="hero-stack" aria-label="Main skills">
                        @foreach ($home->items as $item)
                            <span>{{ $item }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="hero-card reveal delay-1">
                <div class="glass-card profile-card">
                    @if ($assetImage($home?->image_path))
                        <img src="{{ $assetImage($home?->image_path) }}" alt="{{ $home?->title }}" class="profile-image">
                    @else
                        <div class="profile-placeholder">
                            <span>{{ collect(explode(' ', $home?->title ?: 'RF'))->map(fn ($word) => mb_substr($word, 0, 1))->take(2)->implode('') }}</span>
                        </div>
                    @endif
                    <div>
                        <p class="card-kicker">Available for</p>
                        <h2>Web App · Laravel · UI Build</h2>
                        <p>Konten halaman ini sepenuhnya bisa kamu edit dari admin panel.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="about section-shell section-grid">
            <div class="section-heading reveal">
                <p class="eyebrow">{{ $about?->eyebrow ?: 'About' }}</p>
                <h2>{{ $about?->title ?: 'About Me' }}</h2>
                @if ($about?->subtitle)
                    <p>{{ $about->subtitle }}</p>
                @endif
            </div>

            <div class="about-panel reveal delay-1">
                @if ($assetImage($about?->image_path))
                    <img src="{{ $assetImage($about?->image_path) }}" alt="{{ $about?->title }}" class="about-image">
                @endif

                <div class="rich-text">
                    {!! $about?->content ?: '<p>Tambahkan konten about dari admin panel.</p>' !!}
                </div>

                @if (! empty($about?->items))
                    <div class="tag-cloud">
                        @foreach ($about->items as $skill)
                            <span>{{ $skill }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section id="portfolio" class="portfolio section-shell">
            <div class="section-heading centered reveal">
                <p class="eyebrow">{{ $portfolio?->eyebrow ?: 'Projects' }}</p>
                <h2>{{ $portfolio?->title ?: 'Featured Work' }}</h2>
                <p>{{ $portfolio?->subtitle ?: 'Project yang muncul di sini bisa ditambah, diubah, dan disembunyikan lewat admin panel.' }}</p>
            </div>

            <div class="portfolio-grid">
                @forelse ($projects as $project)
                    <article class="project-card reveal">
                        <div class="project-media">
                            @if ($assetImage($project->image_path))
                                <img src="{{ $assetImage($project->image_path) }}" alt="{{ $project->title }}">
                            @else
                                <span>{{ mb_substr($project->title, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="project-content">
                            <div class="project-title-row">
                                <h3>{{ $project->title }}</h3>
                                @if ($project->is_featured)
                                    <span class="featured-pill">Featured</span>
                                @endif
                            </div>
                            <p>{{ $project->description }}</p>

                            @if (! empty($project->technologies))
                                <div class="tech-list">
                                    @foreach ($project->technologies as $tech)
                                        <span>{{ $tech }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="project-actions">
                                @if ($project->project_url)
                                    <a href="{{ $project->project_url }}" target="_blank" rel="noopener">Live Preview</a>
                                @endif
                                @if ($project->repository_url)
                                    <a href="{{ $project->repository_url }}" target="_blank" rel="noopener">Repository</a>
                                @endif
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="empty-state reveal">
                        <h3>Belum ada project</h3>
                        <p>Masuk ke admin panel lalu tambahkan project baru.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="contact" class="contact section-shell">
            <div class="contact-layout reveal">
                <div class="contact-card">
                    <p class="eyebrow">{{ $contact?->eyebrow ?: 'Contact' }}</p>
                    <h2>{{ $contact?->title ?: "Let's Work Together" }}</h2>
                    <p>{{ $contact?->subtitle ?: 'Hubungi saya untuk kolaborasi atau project baru.' }}</p>

                    @if ($contact?->content)
                        <div class="rich-text contact-description">
                            {!! $contact->content !!}
                        </div>
                    @endif

                    <div class="contact-actions">
                        @if ($setting('contact_email'))
                            <a href="mailto:{{ $setting('contact_email') }}" class="button button-ghost">{{ $setting('contact_email') }}</a>
                        @endif
                        @if ($setting('contact_whatsapp'))
                            <a href="{{ $setting('contact_whatsapp') }}" target="_blank" rel="noopener" class="button button-ghost">WhatsApp</a>
                        @endif
                    </div>

                    @if ($socialLinks->isNotEmpty() || $contactLinks->isNotEmpty())
                        <div class="social-row">
                            @foreach ($socialLinks->merge($contactLinks) as $link)
                                <a href="{{ $link->url }}" target="_blank" rel="noopener">
                                    @if ($link->icon)
                                        <span>{{ $link->icon }}</span>
                                    @endif
                                    {{ $link->label }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>

                <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <h3>Kirim Pesan</h3>

                    @if (session('contact_success'))
                        <div class="form-alert success">{{ session('contact_success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="form-alert error">Cek lagi input kamu ya, ada yang belum valid.</div>
                    @endif

                    <label>
                        <span>Nama</span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu" required>
                        @error('name') <small>{{ $message }}</small> @enderror
                    </label>

                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                        @error('email') <small>{{ $message }}</small> @enderror
                    </label>

                    <label>
                        <span>Pesan</span>
                        <textarea name="message" rows="6" placeholder="Tulis pesan kamu..." required>{{ old('message') }}</textarea>
                        @error('message') <small>{{ $message }}</small> @enderror
                    </label>

                    <button type="submit" class="button button-primary">
                        {{ $contact?->button_label ?: 'Kirim Pesan' }}
                    </button>
                </form>
            </div>
        </section>
    </main>

    <footer class="footer">
        <p>© {{ now()->year }} {{ $setting('site_name', 'RYFDLLAH') }}. Built with Laravel + Filament.</p>
        @if ($footerLinks->isNotEmpty())
            <div>
                @foreach ($footerLinks as $link)
                    <a href="{{ $link->url }}">{{ $link->label }}</a>
                @endforeach
            </div>
        @endif
    </footer>

    <script src="{{ asset('front/portfolio-modern.js') }}"></script>
</body>
</html>
