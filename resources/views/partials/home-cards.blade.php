@if($homeCards->count())
<div class="section-full p-t80 p-b80 home-cards-section">
    <div class="container">
        @if(($sectionTitle ?? null) || ($sectionSubtitle ?? null))
        <div class="section-head text-left m-b40">
            @if($sectionTitle)
            <h2 class="text-uppercase font-36">{{ $sectionTitle }}</h2>
            @endif
            <div class="wt-separator-outer">
                <div class="wt-separator bg-black"></div>
            </div>
            @if($sectionSubtitle)
            <p class="font-16 m-t15">{{ $sectionSubtitle }}</p>
            @endif
        </div>
        @endif
        <div class="home-cards-grid">
            @foreach($homeCards as $card)
            <button
                type="button"
                class="home-card"
                data-home-card-open
                data-card-id="{{ $card->id }}"
                data-card-title="{{ $card->title }}"
                data-card-subtitle="{{ $card->subtitle }}"
                data-card-image="{{ media_url($card->image, 'images/gallery/portrait/pic1.jpg') }}"
                aria-haspopup="dialog"
            >
                <div class="home-card__media">
                    <img src="{{ media_url($card->image, 'images/gallery/portrait/pic1.jpg') }}" alt="{{ $card->title }}">
                </div>
                <h3 class="home-card__title">{{ $card->title }}</h3>
                @if($card->subtitle)
                <p class="home-card__subtitle">{{ $card->subtitle }}</p>
                @endif
            </button>
            <template id="home-card-details-{{ $card->id }}">
                {!! $card->details !!}
            </template>
            @endforeach
        </div>
    </div>
</div>

<div id="home-card-modal" class="home-card-modal" hidden aria-hidden="true">
    <div class="home-card-modal__backdrop" data-home-card-close></div>
    <div class="home-card-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="home-card-modal-title">
        <button type="button" class="home-card-modal__close" data-home-card-close aria-label="Close">
            <i class="fa fa-times"></i>
        </button>
        <div class="home-card-modal__media">
            <img id="home-card-modal-image" src="" alt="">
        </div>
        <div class="home-card-modal__body">
            <h3 id="home-card-modal-title" class="home-card-modal__title"></h3>
            <p id="home-card-modal-subtitle" class="home-card-modal__subtitle" hidden></p>
            <div id="home-card-modal-details" class="home-card-modal__details"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function ($) {
    var $modal = $('#home-card-modal');
    if (!$modal.length) {
        return;
    }

    var $title = $('#home-card-modal-title');
    var $subtitle = $('#home-card-modal-subtitle');
    var $details = $('#home-card-modal-details');
    var $image = $('#home-card-modal-image');

    function closeHomeCardModal() {
        $modal.attr('hidden', true).attr('aria-hidden', 'true');
        $('body').removeClass('home-card-modal-open');
        $details.empty();
        $image.attr('src', '').attr('alt', '');
        $subtitle.text('').attr('hidden', true);
    }

    function openHomeCardModal($card) {
        var id = $card.data('card-id');
        var title = $card.data('card-title') || '';
        var subtitle = $card.data('card-subtitle') || '';
        var image = $card.data('card-image') || '';
        var template = document.getElementById('home-card-details-' + id);
        var detailsHtml = template ? template.innerHTML.trim() : '';

        $title.text(title);
        $image.attr('src', image).attr('alt', title);

        if (subtitle) {
            $subtitle.text(subtitle).removeAttr('hidden');
        } else {
            $subtitle.text('').attr('hidden', true);
        }

        $details.html(detailsHtml || '<p>No details available for this service.</p>');

        $modal.removeAttr('hidden').attr('aria-hidden', 'false');
        $('body').addClass('home-card-modal-open');
    }

    $(document).on('click', '[data-home-card-open]', function () {
        openHomeCardModal($(this));
    });

    $(document).on('click', '[data-home-card-close]', closeHomeCardModal);

    $(document).on('keydown', function (event) {
        if (event.key === 'Escape' && !$modal.is('[hidden]')) {
            closeHomeCardModal();
        }
    });
})(jQuery);
</script>
@endpush
@endif
