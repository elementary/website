/**
 * _scripts/pages/blog.js
 * Populates the homepage #whats-new with the blog feed
*/

import jQuery from '~/lib/jquery'

jQuery.then(($) => {
    $(function () {
        $.getJSON('https://blog.elementary.io/feed.json', function (data) {
            var blog_contents = ''
            $.each(data.posts, function (n, post) {
                var post_contents = ''
                post_contents += '<a class="featured with-image" href="/' + post.url + '>'
                post_contents += '<div class="featured-image" alt="Featured image" style="background-image: url(' + post.image + ');"></div>'
                post_contents += '<header>'
                post_contents += '<h2>' + post.title + '</h2>'
                post_contents += '<h3>' + post.description + '</h3>'
                post_contents += '<div class="byline">'
                post_contents += '<div class="avatar">'
                post_contents += '<img '
                post_contents += 'srcset="https://www.gravatar.com/avatar/' + post.author.gravatar + '?s=96&d=blank 2x" '
                post_contents += 'src="https://www.gravatar.com/avatar/' + post.author.gravatar + '?s=48&d=blank" '
                post_contents += 'alt="Avatar for ' + post.author.name + '"/>'
                post_contents += '</div>'
                post_contents += '<div class="author">'
                post_contents += '<span class="name">' + post.author.name + '</span>'
                post_contents += '</div>'
                post_contents += '<time class="post-date" datetime="' + post.pubDate + '">' + post.pubDate + '</time>'
                post_contents += '<span class="read-time" title="Estimated read time">'
                post_contents += post.read_time
                post_contents += '</span>'
                post_contents += '</div>'
                post_contents += '</header>'
                post_contents += '</a>'
                blog_contents += post_contents
            })
            $('#whats-new').html(blog_contents)
        })

        console.log('Loaded blog.js')
    })
})
