<article class="relative mx-auto w-full sm:pt-6 md:max-w-4xl lg:max-w-5xl">
    @if ($advancedSettings->banner_before_content !== '')
        <section>{!! $advancedSettings->banner_before_content !!}</section>
    @endif
    <div class="mt-4 flex flex-col rounde-lg bg-white py-6 dark:bg-slate-800 dark:text-slate-200">
        @include('livewire.front.story.partials.top')

        @include('livewire.front.story.partials.content-header')
        {{-- Feature Image --}}
        @if ($story->getMedia('featured-image')->isNotEmpty())
            <div class="relative">
                {!! $story->getFirstMedia('featured-image')->img('', ['class' => 'max-h-600 object-cover w-full', 'alt' => $story->title]) !!}
            </div>
        @endif
        @if ($story->content_visibility === 'Auth')
            @auth
                @include('livewire.front.story.partials.content-body')
            @else
                @include('livewire.front.story.partials.non-auth')
            @endauth
        @else
            @include('livewire.front.story.partials.content-body')
        @endif
    </div>
    @if ($advancedSettings->banner_after_content !== '')
        <section class="mt-5">{!! $advancedSettings->banner_after_content !!}</section>
    @endif
    
    @if ($story->comment_visibility === 'Disable')
        <div class="relative mx-auto my-10 max-w-5xl rounded-lg bg-white px-3 py-8 dark:bg-slate-800 sm:px-6 lg:px-8">
            <div class="mx-auto ma-xl">
                {{ __('Comments are turned off by author') }}
            </div>
        </div>
    @else
        <livewire:front.comments.comments :story="$story" />
    @endif
</article>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/medium-zoom@1.0.6/dist/medium-zoom.min.js"></script>
    <script>
        mediumZoom('[data-zoomable]', {
            margin: 24,
            background: 'rgba(0, 1, 2, .8)',
            scrollOffset: 0,
        });
    </script>
    @if ($story->getMedia('story-audio')->isNotEmpty())
        <script src="https://cdn.plyr.io/3.8.3/plyr.js"></script>
        <link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css" />
        <style>
            .plyr--audio .plyr__controls {
                background: #f8fafc;
            }
        </style>
        <script>
            const player = new Plyr('#player');
        </script>
    @endif
@endpush
