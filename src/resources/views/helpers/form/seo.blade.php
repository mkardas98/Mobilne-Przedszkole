<div class="card">
    <div class="card__body">
        {!! $form->renderFieldGroup('seo_url') !!}
        {!! $form->renderFieldGroup('seo_title') !!}
        {!! $form->renderFieldGroup('seo_description') !!}
        {!! $form->renderFieldGroup('seo_tags') !!}
    </div>
</div>

@push('scripts.body.bottom')
    <script>
        const title = $('#title')
        const seoTitle = $('#seo_title')
        const seoUrl = $('#seo_url')

        const generate_url = (...args) => {
            const value = args.join(' ');
            return value
                .normalize('NFD') // split an accented letter in the base letter and the acent
                .replace('ł', 'l')
                .replace('Ł', 'l')
                .replace(/[\u0300-\u036f]/g, '') // remove all previously split accents
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9 ]/g, '') // remove all chars not letters, numbers and spaces (to be replaced)
                .replace(/\s+/g, '-'); // separator
        };

        const titleEdit = () => {
          if(!seoTitle.val())
             seoTitle.val(title.val())

            if(!seoUrl.val())
                seoUrl.val('/'+generate_url(title.val()))
        }


        seoUrl.on('change', function (){
            if(seoUrl.val() && !(seoUrl.val()[0] === '/')){
                seoUrl.val('/'+seoUrl.val())
            }
        })
        title.on('change', titleEdit)
        title.on('blur', titleEdit)

    </script>

@endpush
