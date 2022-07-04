<div>
    <h1>{{ __('Test') }}</h1>

    @if ($view == 'ask')
        <progress value="{{ $step - 1 }}" max="{{ $words_to_ask }}"></progress>
        <article>
            <header>
                <h3 style="margin-bottom: 0">{{ __('Word') }}: {{ $word->word }}</h3>
                <div style="text-align: right;">
                    {{ __('Score') }}: {{ $word->score->score }} |
                    <a href="{{ route('book.section.word.show', ['book' => $word->book_id, 'section' => $word->section_id, 'word' => $word->id]) }}" target="_blank">
                        {{ __('Open Word') }}
                    </a>
                </div>
            </header>

            @foreach ($translations as $key => $value)
                <input type="text" name="translations[{{ $key }}]" wire:model.lazy="translations.{{ $key }}" placeholder="Übersetzung eingeben"/>
            @endforeach

            <footer style="text-align: right">
                <a href="javascript:void();" wire:click="check" wire:loading.attr="disabled" role="button">{{ __('Check') }}</a>
                <a
                    href="javascript:void();"
                    wire:click="nextWord"
                    wire:loading.attr="disabled"
                    class="contrast"
                    @if($word->score->score <= 1) disabled data-tooltip="{{ __('You can only skip words above a score of 2.') }}"
                    @else data-tooltip="{{ __('If you skip a word, one point will be deducted from the score.') }}" @endif
                    role="button"
                >
                    {{ __('Skip') }}
                </a>
            </footer>
        </article>

        @if (count($word->other_words ?? []) != 0)
            <article>
                <header>Zusatzt</header>

                <ul>
                    @foreach ($word->other_words ?? [] as $other_word)
                        <li>{{ $other_word }}</li>
                    @endforeach
                </ul>
            </article>
        @endif
    @endif

    @if ($view == 'check')
        <article>
            <header>
                <h3 style="margin-bottom: 0">{{ __('Word :word check', ['word' => $word->word]) }}</h3>
                <div style="text-align: right;">
                    {{ __('Score') }}: {{ $word->score->score }}
                </div>
            </header>
            <table>
                <thead>
                    <tr>
                        <th>{{ __('Right Word') }}</th>
                        <th>{{ __('Your Input') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($translations as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <footer style="text-align: right">
                <a href="javascript:void();" wire:click="checkOK" role="button">{{ __('I entered it correctly') }}</a>
                <a href="javascript:void();" wire:click="checkFail" class="contrast" role="button">{{ __('This translation was wrong.') }}</a>
            </footer>
        </article>

        <article aria-busy="true" wire:loading wire:target="check"></article>
    @endif

    @if($view == 'results')
        <progress style="color: green" value="{{ $step }}" max="{{ $words_to_ask }}"></progress>
        <article>
            <header>
                <h3 style="margin-bottom: 0">{{ __('Results') }}</h3>
            </header>

            <table>
                <thead>
                    <tr>
                        <th>{{ __('Word') }}</th>
                        <th>{{ __('Score before') }}</th>
                        <th>{{ __('Score after') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result['word'] }}</td>
                            <td>{{ $result['score'] }}</td>
                            <td>
                                <span class="@if(($scoreDiff = ($result['new_score'] - $result['score'])) > 0) text-green @elseif ($scoreDiff < 0) text-red @endif">
                                    {{ $result['new_score'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <footer style="text-align: right">
                <a href="{{ request()->back ?? route('book.show', $book) }}" class="contrast" role="button">{{ __('End test') }}</a>
                <a href="{{ route('book.ask', $book) }}" role="button">{{ __('Make a new') }}</a>
            </footer>
        </article>
    @endif
</div>
