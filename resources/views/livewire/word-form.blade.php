<div>
    <form wire:submit.prevent="save">
        @csrf
        <h1>
            {{ __('Book') }} <a href="{{ route('book.show', $book) }}">{{ $book->name }}</a> -
            {{ __('Section') }} <a href="{{ route('book.section.show', compact('book', 'section')) }}">{{ $section->name }}</a> -
            {{ $heading }}
        </h1>

        @if ($message)
            <article class="bg-green">{!! $message !!}</article>
        @endif

        <fieldset>
            <x-input name="word" wire:model.lazy="word" required :placeholder="__('Word')">{{ __('Word') }} <sub>({{ $book->lang('from') }})</sub></x-input>
        </fieldset>

        <fieldset>
            <x-label for="other_words">{{ __('Other meanings') }} <sub>({{ $book->lang('from') }})</sub></x-label>
            <table>
                @foreach ($other_words as $key => $value)
                    <tr>
                        <td><input id="other_words[{{ $key }}]" wire:model.lazy="other_words.{{ $key }}" @error('other_words') aria-invalid="true" @enderror required type="text"></td>
                        <td><button type="button" class="contrast" wire:click="removeOption('other_words', {{ $key }})" wire:loading.attr="aria-busy='true'">&times;</button></td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td><button wire:loading.attr="disabled" type="button" wire:click="addOption('other_words')" role="button" class="secondary">+</button></td>
                </tr>
            </table>
            <x-input-error name="other_words" />
        </fieldset>

        <fieldset>
            <x-label for="translations">{{ __('Translations') }} <sub>({{ $book->lang('to') }})</sub></x-label>
            <table>
                @foreach ($translations as $key => $value)
                    <tr>
                        <td><input id="translations[{{ $key }}]" wire:model.lazy="translations.{{ $key }}" @error('translations') aria-invalid="true" @enderror required type="text"></td>
                        <td><button type="button" class="contrast" wire:click="removeOption('translations', {{ $key }})" wire:loading.attr="disabled">&times;</button></td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td><button wire:loading.attr="disabled" type="button" wire:click="addOption('translations')" role="button" class="secondary">+</button></td>
                </tr>
            </table>
            <x-input-error name="translations" />
        </fieldset>

        <button type="submit" wire:loading.attr="disabled">{{ __('Save') }}</button>
        @if (!$edit)
            <button type="button" class="contrast" wire:loading.attr="disabled" wire:click="saveSite">{{ __('Save and add another') }}</button>
        @endif
    </form>
</div>
