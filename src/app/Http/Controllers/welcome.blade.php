<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $setting?->site_name ?? 'Portfolio' }}</title>

    <link rel="stylesheet" href="{{ asset('front/dynamic-modern.css') }}">
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="logo">
            {{ $setting?->site_name }}
        </div>

        <div class="nav-links">
            <a href="#about">About</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#contact">Contact</a>
        </div>
    </div>
</nav>

<section class="hero">
    <div class="container hero-grid">

        <div>
            <span class="badge">
                PORTFOLIO
            </span>

            <h1>
                {{ $setting?->hero_title }}
            </h1>

            <p>
                {{ $setting?->hero_subtitle }}
            </p>

            <a href="#portfolio" class="btn-primary">
                Explore Portfolio
            </a>
        </div>

        <div>
            <img
                src="{{ asset('storage/' . $setting?->profile_image) }}"
                class="profile-image"
            >
        </div>

    </div>
</section>

<section id="about" class="section">
    <div class="container">

        <div class="section-title">
            About Me
        </div>

        <div class="about-card">
            {!! $setting?->about !!}
        </div>

        <div class="skills">
            @foreach ($skills as $skill)
                <span class="skill-badge">
                    {{ $skill->name }}
                </span>
            @endforeach
        </div>

    </div>
</section>

<section id="portfolio" class="section">
    <div class="container">

        <div class="section-title">
            My Portfolio
        </div>

        <div class="portfolio-grid">

            @foreach ($portfolios as $portfolio)
                <div class="portfolio-card">

                    <img
                        src="{{ asset('storage/' . $portfolio->thumbnail) }}"
                        alt="{{ $portfolio->title }}"
                    >

                    <div class="portfolio-body">

                        <h3>
                            {{ $portfolio->title }}
                        </h3>

                        <p>
                            {{ $portfolio->description }}
                        </p>

                        <div class="tech-wrapper">
                            @foreach ($portfolio->technologies ?? [] as $tech)
                                <span class="tech-badge">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>

                        <a
                            href="{{ $portfolio->url }}"
                            target="_blank"
                            class="project-link"
                        >
                            View Project
                        </a>

                    </div>

                </div>
            @endforeach

        </div>

    </div>
</section>

<section id="contact" class="section">
    <div class="container">

        <div class="section-title">
            Contact
        </div>

        <div class="contact-card">
            <p>{{ $setting?->email }}</p>
            <p>{{ $setting?->phone }}</p>
        </div>

    </div>
</section>

</body>
</html>
