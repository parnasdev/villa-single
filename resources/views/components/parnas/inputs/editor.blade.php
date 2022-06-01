
<div x-init="
                    tinymce.remove('.editor');
                    tinymce.init({
                        selector: '.editor',
                        width: '100%',
                        height: 500,
                        theme:'silver',
                        menubar: true,
                        branding: false,
                        skin: 'oxide',
                        toolbar1: 'undo redo | formatSelect | bold italic blockquote strikethrough underline forecolor backcolor | numlist bullist | alignright aligncenter alignleft alignjustify | rtl ltr | link unlink | removeformat',
                        toolbar2: 'fontselect | fontsizeselect | indent outdent | cut copy paste pastetext | charmap image media responsivefilemanager table emoticons hr | searchreplace preview code fullscreen help editormode',
                        plugins: 'lists,advlist,directionality,link,paste,charmap,table,emoticons,codesample,preview,code,fullscreen,help,hr,nonbreaking,searchreplace,visualblocks,visualchars,autolink,image,media',
                        advlist_bullet_styles: 'square,circle,disc',
                        advlist_number_styles: 'lower-alpha,lower-roman,upper-alpha,upper-roman',
                        help_tabs: ['shortcuts'],
                        fontsize_formats: '6pt 7pt 8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 32pt 34pt 36pt 40pt',
                        lineheight_formats: '1pt 2pt 3pt 4pt 5pt 6pt 7pt 8pt 9pt 10pt 11pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 36pt 38pt 40pt 42pt 44pt 46pt 48pt 50pt 60pt 70pt 80pt 100pt',
                        directionality :'rtl',
                        language: 'fa_IR',
                        setup: function (editor) {
                            editor.on('init change', function () {
                                editor.save();
                            });
                            editor.on('change', function (e) {
                            @this.set('{{$attributes['wire:model.debounce.1000ms']}}', editor.getContent());
                            });
                        },
                        file_picker_callback (callback, value, meta) {
                            let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth
                            let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight

                            tinymce.activeEditor.windowManager.openUrl({
                                url : '/file-manager/tinymce5',
                                title : 'Laravel File manager',
                                width : x * 0.8,
                                height : y * 0.8,
                                onMessage: (api, message) => {
                                    callback(message.content, { text: message.text })
                                }
                            })
                        }
                    });
">
    <textarea class="editor" {{ $attributes }}></textarea>
</div>
