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
            @php $tag = $card->link ? 'a' : 'div'; @endphp
            <{{ $tag }}
                @if($card->link) href="{{ $card->link }}" @endif
                class="home-card"
            >
                <div class="home-card__media">
                    <img src="{{ media_url($card->image, 'images/gallery/portrait/pic1.jpg') }}" alt="{{ $card->title }}">
                </div>
                <h3 class="home-card__title">{{ $card->title }}</h3>
                @if($card->subtitle)
                <p class="home-card__subtitle">{{ $card->subtitle }}</p>
                @endif
            </{{ $tag }}>
            @endforeach
        </div>
    </div>
</div>
@endif
