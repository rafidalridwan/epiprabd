@if(($page->show_work_spans_section ?? true) && $workSpanCategories->isNotEmpty())
<section class="home-work-spans" aria-label="Our work spans" data-work-spans>
    <div class="home-work-spans__inner">
        <div class="home-work-spans__heading-wrap">
            <p class="home-work-spans__heading" data-work-spans-heading>{{ $page->work_spans_heading ?? 'Our work spans' }}</p>
        </div>

        <div class="home-work-spans__panels" data-work-spans-panels>
            @foreach($workSpanCategories as $item)
            <article class="home-work-spans__panel" data-work-spans-panel>
                <div class="home-work-spans__media">
                    <div
                        class="home-work-spans__image"
                        style="background-image: url('{{ $item['image'] }}');"
                        role="img"
                        aria-label="{{ $item['name'] }}"
                    ></div>
                </div>
                <div class="home-work-spans__label">
                    <p class="home-work-spans__title">{{ $item['name'] }}</p>
                    <span class="home-work-spans__arrow" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 8" fill="none">
                            <path fill="currentColor" d="M16.354 4.422a.5.5 0 0 0 0-.707L13.172.533a.5.5 0 1 0-.708.707l2.829 2.829-2.829 2.828a.5.5 0 1 0 .708.707l3.182-3.182ZM0 4.07v.5h16v-1H0v.5Z"></path>
                        </svg>
                    </span>
                </div>
                <a class="home-work-spans__link" href="{{ $item['url'] }}" aria-label="View {{ $item['name'] }} projects"></a>
            </article>
            @endforeach
        </div>
    </div>

    <div class="home-work-spans__mobile">
        <p class="home-work-spans__mobile-heading">{{ $page->work_spans_heading ?? 'Our work spans' }}</p>
        <div class="home-work-spans__mobile-list">
            @foreach($workSpanCategories as $item)
            <a class="home-work-spans__mobile-item" href="{{ $item['url'] }}">
                <div class="home-work-spans__mobile-image" style="background-image: url('{{ $item['image'] }}');"></div>
                <div class="home-work-spans__mobile-label">
                    <span>{{ $item['name'] }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 8" fill="none" aria-hidden="true">
                        <path fill="currentColor" d="M16.354 4.422a.5.5 0 0 0 0-.707L13.172.533a.5.5 0 1 0-.708.707l2.829 2.829-2.829 2.828a.5.5 0 1 0 .708.707l3.182-3.182ZM0 4.07v.5h16v-1H0v.5Z"></path>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
