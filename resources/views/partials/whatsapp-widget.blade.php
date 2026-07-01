@php
    $whatsappNumber = '8801601041123';
    $siteName = setting('site_name', 'your team');
    $whatsappQuestions = [
        'What services do you offer?',
        'Can I get a project quote?',
        'How do I book a consultation?',
        'What are your working hours?',
        'I want to discuss a new project.',
    ];
@endphp

<div class="whatsapp-widget" id="whatsapp-widget" data-whatsapp-number="{{ $whatsappNumber }}">
    <div class="whatsapp-widget__popup" id="whatsapp-popup" hidden aria-hidden="true">
        <div class="whatsapp-widget__popup-header">
            <div class="whatsapp-widget__popup-avatar" aria-hidden="true">
                <i class="fa fa-whatsapp"></i>
            </div>
            <div>
                <strong class="whatsapp-widget__popup-title">Chat with us</strong>
                <p class="whatsapp-widget__popup-subtitle">We typically reply within an hour</p>
            </div>
            <button type="button" class="whatsapp-widget__popup-close" data-whatsapp-close aria-label="Close chat tips">
                <i class="fa fa-times"></i>
            </button>
        </div>
        <div class="whatsapp-widget__popup-body">
            <p class="whatsapp-widget__popup-hint">Hi there! How can we help you today?</p>
            <ul class="whatsapp-widget__questions">
                @foreach($whatsappQuestions as $question)
                <li>
                    <a
                        href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode('Hi ' . $siteName . ', ' . $question) }}"
                        class="whatsapp-widget__question"
                        target="_blank"
                        rel="noopener noreferrer"
                    >{{ $question }}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <a
            href="https://wa.me/{{ $whatsappNumber }}"
            class="whatsapp-widget__popup-action"
            target="_blank"
            rel="noopener noreferrer"
        >
            <i class="fa fa-whatsapp"></i> Start chat on WhatsApp
        </a>
    </div>

    <button
        type="button"
        class="whatsapp-widget__btn"
        id="whatsapp-toggle"
        aria-label="Open WhatsApp chat"
        aria-expanded="false"
        aria-controls="whatsapp-popup"
    >
        <span class="whatsapp-widget__pulse" aria-hidden="true"></span>
        <span class="whatsapp-widget__pulse whatsapp-widget__pulse--delay" aria-hidden="true"></span>
        <span class="whatsapp-widget__icon">
            <i class="fa fa-whatsapp"></i>
        </span>
    </button>
</div>
