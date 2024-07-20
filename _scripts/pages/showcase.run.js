/**
 * _scripts/pages/showcase.run.js
 * Loads the homepage showcase and other related widgets
 */

import jQuery from '~/lib/jquery'
import Showcase from '~/widgets/showcase'

jQuery.then(($) => {
    $(document).ready(() => {
        const showcase = new Showcase({
            container: '#showcase',
            index: '#showcase-index',
            slides: [
                'showcase-music',
                'showcase-epiphany',
                'showcase-mail',
                'showcase-photos',
                'showcase-videos',
                'showcase-calendar',
                'showcase-files',
                'showcase-terminal',
                'showcase-code',
                'showcase-camera'
            ],
            fixed: false
        })
        showcase.start()

        $('#showcase .showcase-tab .showcase-back').on('click', (e) => {
            e.preventDefault()
            showcase.slideTo('index')
        })

        console.log('Loaded showcase.run.js')
    })
})
