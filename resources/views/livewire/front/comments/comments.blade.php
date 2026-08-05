<div class="relative mx-auto my-10 max-w-5xl rounded-lg bg-white px-3 py-8 dark:bg-slate-800 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-xl">
        @auth
            <form wire:submit="addComment">
                <div
                    class="@error('newCommentState.comment') border-red-500 @enderror rounded-md border border-gray-200 bg-white p-4 hover:border-primary-500/20 hover:shadow-sm focus:border-primary-500/20 focus:ring-primary-500/20 dark:border-slate-50/[0.06] dark:bg-slate-800">
                    <label for="new-comment" class="sr-only">{{ __('Comment body') }}</label>
                    <textarea
                        wire:model="newCommentState.comment"
                        x-data="{
                            resize: () => {
                                $el.style.height = '40px';
                                $el.style.height = $el.scrollHeight + 'px'
                            }
                        }"
                        x-init="resize"
                        x-on:input="resize"
                        id="new-comment"
                        name="comment"
                        class="mb-4 block w-full overflow-hidden border-transparent p-0 focus:border-transparent focus:outline-none focus:ring-0 dark:bg-slate-800 dark:text-slate-200 sm:mb-8"
                        placeholder="{{ __('Write something') }}"></textarea>

                    <div class="mt-3 flex items-center justify-end sm:justify-between">
                        <div>
                            @error('newCommentState.comment')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-buttons.primary-button type="submit">
                            {{ __('Comment') }}
                        </x-buttons.primary-button>
                    </div>
                </div>
            </form>
        @else
            <div class="rounded-md border border-gray-200 bg-white p-4 dark:border-slate-50/[0.06] dark:bg-slate-800 dark:text-slate-200">
                <a href="{{ route('login') }}" class="link">{{ __('Login') }}</a>
                <span>{{ __('to leave a comment.') }}</span>
            </div>
        @endauth

        <div class="mt-8 space-y-6">
            @forelse ($comments as $comment)
                <livewire:front.comments.comment :comment="$comment" :key="$comment->id" :story="$story" />
            @empty
                <p class="text-sm text-gray-500 dark:text-slate-400">{{ __('No comments yet.') }}</p>
            @endforelse
        </div>

        @if ($comments->hasMorePages())
            <div class="mt-8 flex justify-center">
                <button
                    type="button"
                    wire:click="loadMore"
                    class="rounded-md border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-slate-100 dark:border-slate-50/[0.06] dark:text-slate-200 dark:hover:bg-slate-700">
                    {{ __('Load more') }}
                </button>
            </div>
        @endif
    </div>
</div>
