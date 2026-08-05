<div class="mx-auto w-full max-w-5xl px-3 py-6">
    <div class="overflow-hidden rounded-md bg-white shadow-sm dark:bg-slate-800">
        <div class="relative h-48 bg-gray-100 dark:bg-slate-700">
            @if ($user->cover_image)
                <img src="{{ $user->getCoverImage() }}" alt="{{ $user->username }}"
                    class="h-full w-full object-cover">
            @endif
        </div>
        <div class="px-6 pb-6">
            <div class="-mt-12 flex items-end gap-4">
                <img src="{{ $user->getAvatar() }}" alt="{{ $user->username }}"
                    class="h-24 w-24 rounded-full border-4 border-white object-cover dark:border-slate-800">
                <div class="pb-2">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-slate-100">
                        {{ $user->name ?: $user->username }}
                    </h1>
                    <p class="text-sm text-gray-500 dark:text-slate-400">@{{ $user->username }}</p>
                </div>
            </div>
            @if ($user->profile?->bio)
                <p class="mt-4 text-gray-700 dark:text-slate-300">{{ $user->profile->bio }}</p>
            @endif
        </div>
    </div>

    @if ($pinnedStories->count())
        <section class="mt-6">
            <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-slate-100">{{ __('Pinned stories') }}</h2>
            @foreach ($pinnedStories as $story)
                <livewire:front.story-card :story="$story" :key="'pinned-'.$story->id" />
            @endforeach
        </section>
    @endif

    <section class="mt-6">
        <h2 class="mb-3 text-lg font-semibold text-gray-900 dark:text-slate-100">{{ __('Latest stories') }}</h2>
        @forelse ($userStoriesLatest as $story)
            <livewire:front.story-card :story="$story" :key="'user-story-'.$story->id" />
        @empty
            <div class="rounded-md bg-white p-10 text-center text-gray-500 dark:bg-slate-800 dark:text-slate-400">
                {{ __('No published stories yet') }}
            </div>
        @endforelse

        @if ($userStoriesLatest->hasMorePages())
            <x-ui.skeleton />
            <div x-intersect="$wire.loadMore" class="grid grid-cols-1"></div>
        @endif
    </section>
</div>
