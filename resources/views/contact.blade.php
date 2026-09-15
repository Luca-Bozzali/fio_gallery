<x-layout title="Contact">

<section class="contact-page">

    <div class="content-wrapper">

        <div class="contact-header">

            <h1>CONTACT</h1>

        </div>

        <div class="contact-card">

            @if (filled($setting?->instagram_url))

            <div class="contact-item">

                <span class="contact-label">INSTAGRAM</span>

                @php $igHandle = '@' . ltrim(parse_url($setting->instagram_url, PHP_URL_PATH), '/'); @endphp
                <a href="{{ $setting->instagram_url }}" target="_blank" rel="noopener noreferrer">
                    {{ $igHandle }}
                </a>

            </div>

            @endif

            @if (filled($setting?->vimeo_url))

            <div class="contact-item">

                <span class="contact-label">VIMEO</span>

                @php $vimeoHandle = rtrim(ltrim(parse_url($setting->vimeo_url, PHP_URL_PATH), '/'), '/'); @endphp
                <a href="{{ $setting->vimeo_url }}" target="_blank" rel="noopener noreferrer">
                    {{ $vimeoHandle }}
                </a>

            </div>

            @endif

            @if (filled($setting?->email))

            <div class="contact-item">

                <span class="contact-label">EMAIL</span>

                <span>
                    {{ $setting->email }}
                </span>

            </div>

            @endif

            @if (filled($setting?->location))

            <div class="contact-item">

                <span class="contact-label">LOCATION</span>

                <span>
                    {{ $setting->location }}
                </span>

            </div>

            @endif

        </div>

        <div class="contact-form">

            <h2>Send a message</h2>

            <form>

                <input
                    type="text"
                    placeholder="Your name"
                >

                <input
                    type="email"
                    placeholder="Email address"
                >


                <textarea
                    rows="7"
                    placeholder="Tell me about your project..."
                ></textarea>

                <button type="submit">

                    SEND MESSAGE

                </button>

            </form>

        </div>

    </div>

</section>

</x-layout>
