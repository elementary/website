/**
 * _scripts/pages/blog.js
 * Populates the homepage #whats-new with the blog feed
*/

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        $.getJSON('https://blog.elementary.io/feed/updates.json', function (data) {
            let blogContents = ''
            blogContents += '<div class="blog-container">'
            $.each(data.posts, function (n, post) {
                let postContents = ''
                postContents += '<a class="featured with-image" href="' + post.url + '">'
                postContents += '<div class="featured-image" alt="Featured image" style="background-image: url(' + post.image + ');"></div>'
                postContents += '<header>'
                postContents += '<h4>' + post.title + '</h4>'
                postContents += '<p>' + post.description + '</p>'
                postContents += '<div class="byline">'
                postContents += '<div class="avatar">'
                postContents += '<img '
                postContents += 'srcset="https://www.gravatar.com/avatar/' + post.author.gravatar + '?s=96&d=blank 2x" '
                postContents += 'src="https://www.gravatar.com/avatar/' + post.author.gravatar + '?s=48&d=blank" '
                postContents += 'alt="Avatar for ' + post.author.name + '"/>'
                postContents += '</div>'
                postContents += '<div class="author">'
                postContents += '<span class="name">' + post.author.name + '</span>'
                postContents += '</div>'
                const dateJs = new Date(post.pubDate)
                const dateOptions = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric', timezone: 'UTC' }
                const dateNice = dateJs.toLocaleDateString('en-US', dateOptions)
                postContents += '<time class="post-date" datetime="' + post.pubDate + '">' + dateNice + '</time>'
                postContents += '<span class="read-time" title="Estimated read time">'
                postContents += post.read_time
                postContents += '</span>'
                postContents += '</div>'
                postContents += '</header>'
                postContents += '</a>'
                blogContents += postContents
            })
            blogContents += '</div>'
            $('#whats-new').append(blogContents)
        })

        console.log('Loaded blog.js')
    })
})
