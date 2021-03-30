<div id="myGroup-{{$name}}" style="position: relative">
    <label class="col-form-label" for="{{$name}}">
        {{$text}}
    </label>
    <div class="input-language-change">
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle show-item-change-language-{{$name}}" data-toggle="dropdown" href="#"
                   role="button"
                   aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase">
                    {{ $language_content['vi'] }}
                </a>
                @if(count($language_content) > 1)
                    <div class="dropdown-menu" style="margin: 0">
                        @foreach($language_content as $lang => $textLanguage)
                            <a data-toggle="collapse"
                               data-code="{{$lang}}"
                               data-text="{{$textLanguage}}"
                               data-parent="#myGroup-{{$name}}"
                               href="#input-lang-{{$name}}-{{$lang}}"
                               class="dropdown-item dropdown-item-change-language-{{$name}}">
                                {{ $textLanguage }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </li>
        </ul>
    </div>
    <div class="accordion-group">
        @foreach($language_content as $lang => $textLanguage)
            <div id="input-lang-{{$name}}-{{$lang}}"
                 class="collapse collapse-item-change-language-{{$name}} @if($lang == 'vi') show @endif">
                <div class="input-group">
                    <input type="{{ $type ?? 'text' }}"
                           name="{{$lang}}[{{$name}}]"
                           id="{{$name}}"
                           placeholder="{{$text}}: {{ $textLanguage }}"
                           value="{{ old($name, $value->translate($lang)->$name ?? '') }}"
                           class="form-control {{ $class ?? '' }}"
                           autocomplete="off"/>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    .input-language-change {
        position: absolute;
        right: 0;
        z-index: 100;
    }
</style>
<script type="text/javascript">
    jQuery('.dropdown-item-change-language-{{$name}}').click(function (e) {
        jQuery('.collapse-item-change-language-{{$name}}').collapse('hide');
        let text = $(this).attr('data-text');
        jQuery('.show-item-change-language-{{$name}}').text(text);
    });
</script>

