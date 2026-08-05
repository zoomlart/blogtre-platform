<div class="p-4">
    @if ($story->poll && ! $addPoll)
        <div class="space-y-4">
            <div>
                <x-forms.label class="mb-2 text-base font-semibold">
                    {{ __('Question') }}
                </x-forms.label>
                <div class="rounded-md border border-gray-200 bg-gray-50 p-3 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200">
                    {{ $story->poll->question }}
                </div>
            </div>

            <div>
                <x-forms.label class="mb-2 text-base font-semibold">
                    {{ __('Choices') }}
                </x-forms.label>
                <ul class="space-y-2">
                    @foreach ($story->poll->choices as $choice)
                        <li class="rounded-md border border-gray-200 px-3 py-2 text-sm dark:border-slate-700 dark:text-slate-200">
                            {{ $choice->text }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="text-sm text-gray-500 dark:text-slate-400">
                {{ __('Poll ends') }}: {{ $story->poll->poll_ends->format('Y-m-d H:i') }}
            </div>

            <x-button
                type="button"
                negative
                outline
                label="{{ __('Remove poll') }}"
                wire:click="removePoll({{ $story->poll->id }})" />
        </div>
    @else
        <div class="space-y-4">
            <p class="text-sm text-gray-500 dark:text-slate-400">
                {{ __('No poll has been added to this story.') }}
            </p>

            <x-button
                type="button"
                primary
                label="{{ __('Add poll') }}"
                wire:click="$dispatch('openAddPollModal')" />
        </div>
    @endif
</div>
