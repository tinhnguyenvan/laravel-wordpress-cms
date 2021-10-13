<div id="myGroup-{{$name}}" style="position: relative">
    <label class="col-form-label" for="{{$name}}">
        {{$text}}
    </label>
    @if(count($language_content) > 1)
        <div class="input-language-change">
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle show-item-change-language-textarea-{{$name}}"
                       data-toggle="dropdown"
                       href="#"
                       role="button"
                       aria-haspopup="true" aria-expanded="false" style="text-transform: uppercase">
                        {{ $language_content['vi'] }}
                    </a>

                    <div class="dropdown-menu" style="margin: 0">
                        @foreach($language_content as $lang => $textLanguage)
                            <a data-toggle="collapse"
                               data-code="{{$lang}}"
                               data-text="{{$textLanguage}}"
                               data-parent="#myGroup-{{$name}}"
                               href="#input-lang-{{$name}}-{{$lang}}"
                               class="dropdown-item dropdown-item-change-language-textarea-{{$name}}">
                                {{ $textLanguage }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    @endif
    <div class="accordion-group">
        @foreach($language_content as $lang => $textLanguage)
            <div id="input-lang-{{$name}}-{{$lang}}"
                 class="collapse collapse-item-change-language-textarea-{{$name}} @if($lang == 'vi') show @endif">
                @if(($config['editor_content'] ?? '') == 'ckeditor5' && ($class ?? '') == 'ckeditor')
                    <div class="box-ckeditor5">
                        <div id="toolbar-container"></div>
                        <div class="ckeditor5"></div>
                        <textarea style="display: none"
                                  name="{{$lang}}[{{$name}}]"
                                  placeholder="{{$text}}: {{ $textLanguage }}"
                                  id="textarea-lang-{{$name}}-{{$lang}}"
                                  rows="{{ $rows ?? 5 }}"
                                  class="text-{{ $config['editor_content'] ?? '' }} form-control {{ $class ?? '' }}">{{ old($name, $value->translate($lang)->$name ?? '') }}</textarea>
                    </div>
                @else
                    <div class="input-group">
                    <textarea name="{{$lang}}[{{$name}}]"
                              placeholder="{{$text}}: {{ $textLanguage }}"
                              id="textarea-lang-{{$name}}-{{$lang}}"
                              rows="{{ $rows ?? 5 }}"
                              class="form-control {{ $class ?? '' }}">{{ old($name, $value->translate($lang)->$name ?? '') }}</textarea>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <style type="text/css">

        /*ckeditor5*/
        .ck-editor__editable {
            min-height: 400px !important;
        }

        .ck-editor__editable_inline {
            background-color: #fff;
            border: 1px solid #e4e7ea !important;
        }

        .input-language-change {
            position: absolute;
            right: 0;
            z-index: 100;
        }
    </style>
    <script type="text/javascript">
        jQuery('.dropdown-item-change-language-textarea-{{$name}}').click(function (e) {
            jQuery('.collapse-item-change-language-textarea-{{$name}}').collapse('hide');
            let text = $(this).attr('data-text');
            jQuery('.show-item-change-language-textarea-{{$name}}').text(text);
        });
    </script>

    @if(($config['editor_content'] ?? '') == 'ckeditor5')
        <script type="text/javascript">
            jQuery(document).on('submit', '.submit', function () {
                let html = jQuery(".ckeditor5").html();
                jQuery(".text-{{$config['editor_content']}}").val(html)
            })
        </script>
    @endif
</div>
