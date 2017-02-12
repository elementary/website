/**
 * _scripts/widgets/pantheon/terminal.js
 * Creates a realistic terminal designed to mimic pantheon-terminal
 *
 * @exports {Class} default - Creates a realistic terminal
 */

import Promise from 'core-js/fn/promise'

/**
 * Here lies some basic commands that are included by default
 *
 * @param {String} cmd - command ran
 * @param {Object} term - terminal object
 * @returns {Number} exit code for command
 */
const commands = {}

commands[/^clear/] = function (cmd, term) {
    return new Promise((resolve, reject) => {
        term.history = []
        term.$i.text('')
        return resolve(0)
    })
}

commands[/^exit/] = function (cmd, term) {
    return new Promise((resolve, reject) => {
        window.history.back()
        return resolve(0)
    })
}

commands[/^whoami$/] = function (cmd, term) {
    if (term.user === 'groot') {
        return term.append('i am groot')
        .then(() => 0)
    } else {
        return term.append(term.user)
        .then(() => 0)
    }
}

commands[/^USER=/] = function (cmd, term) {
    return new Promise((resolve, reject) => {
        const userCMD = cmd.split('=')[1]
        if (userCMD == null || userCMD === '') return resolve(0)

        const user = userCMD.split(' ')[0]
        if (user == null || userCMD === '') return resolve(0)

        term.user = user
        return resolve(0)
    })
}

commands[/^rm -rf \/$/] = function (cmd, term) {
    return term.append('no.')
    .then(() => 0)
}

commands[/^cd/] = function (cmd, term) {
    return new Promise((resolve, reject) => {
        const split = cmd.split(' ')

        if (split[1] == null) return resolve(0)
        if (split[1] === '.' || split[1] === '~' || split[1] === './') return resolve(0)

        return resolve(term.append(`I'm sorry, ${term.user}. I'm afraid I can't do that.`))
        .then(() => 1)
    })
}

commands[/^echo/] = function (cmd, term) {
    return new Promise((resolve, reject) => {
        const text = cmd.match(/(["'])[^]*?\1/)[0]

        return resolve(term.append(text.substring(1, text.length - 1)))
        .then(() => 0)
    })
}

commands[/^mkdir .\/website$/] = function (cmd, term) {
    return 0
}

commands[/^rm -rf .\/website$/] = function (cmd, term) {
    return 0
}

commands[/^git clone https:\/\/github.com\/elementary\/website.git$/] = function (cmd, term) {
    return term.append(`Cloning into '/home/${term.user}/website'...`, 300)
    .then(() => term.append('remote: Counting objects: 20257, done.', 100))
    .then(() => {
        return term.append('remote: Compressing objects: 0% (0/29)')
        .then(($l) => {
            return new Promise((resolve, reject) => {
                let t = 0

                for (let i = 0; i <= 29; i++) {
                    setTimeout(() => {
                        $l.text(`remote: Compressing objects: ${Math.floor(i / 29 * 100)}% (${i}/29)${(i === 29) ? ', done.' : ''}`)
                    }, t)

                    t += Math.floor(Math.random() * 75)
                }

                setTimeout(() => {
                    return resolve()
                }, t)
            })
        })
    })
    .then(() => {
        return term.append('Receiving objects: 0% (0/20257), 0MiB | 0 MiB/s')
        .then(($l) => {
            return new Promise((resolve, reject) => {
                let t = 0

                for (let i = 0; i <= 20257; i++) {
                    setTimeout(() => {
                        $l.text(`Receiving objects: ${Math.floor(i / 20257 * 100)}% (${i}/20257), ${Math.floor(i / t * 4)}MiB | 1.21 GW/s${(i === 20257) ? ', done.' : ''}`)
                    }, t)

                    i += Math.floor(Math.random() * 50)
                    t += Math.random() * 10
                }

                setTimeout(() => {
                    $l.text('Receiving objects: 100% (20257/20257), 21MiB | 1.21 GW/s, done.')
                    return resolve()
                }, t)
            })
        })
    })
    .then(() => term.append('Receiving deltas: 100% (13052/13052), done.', Math.random() * 800))
    .then(() => term.append('Checking connectivity... done', Math.random() * 600))
    .then(() => 0)
}

// A rather special command that runs other commands
commands[/^\.\/demo$/] = function (cmd, term) {
    term.prompt()

    return term.type('rm -rf ./website')
    .then(() => term.type('git clone https://github.com/elementary/website.git'))
    .then(() => term.type('./demo'))
}

/**
 * default
 * A showcase slider for elementary homepage.
 *
 * @param {String} w - jQuery selector the terminal window
 */
export default class Terminal {

    /**
     * constructor
     * Creates a new Showcase
     *
     * @param {String} w - jQuery selector the terminal window
     */
    constructor (w = '.window[type="terminal"]') {
        this.w = w
        this.title = 'Home'
        this.user = 'ellie'
        this.host = 'elementary'
        this.folder = `/home/${this.user}`

        this.history = []

        // terminal colors by index
        this.colors = [
            '#073642',
            '#dc322f',
            '#859900',
            '#b58900',
            '#268bd2',
            '#ec0048',
            '#2aa198',
            '#94a3a5'
        ]

        // avalible commands to this terminal
        this.commands = commands

        this.$w = $(w)
        this.$i = $('.input', this.$w)
    }

    /**
     * start
     * Starts JS logic for the terminal
     */
    start () {
        this.handle()
        this.prompt()
        this.type('./demo')
    }

    /**
     * handle
     * Sets up handles for events
     */
    handle () {
        $(window).on('scroll', () => {
            this.activeCheck()
        })

        $(window).on('resize', (e) => {
            this.activeCheck()
            this.$i.trigger('move')
        })

        $(window).on('keydown', (e) => {
            if (!this.$w.hasClass('active')) return

            var key = e.which

            // TODO: we need to detect if active better before
            // preventing critical key defaults
            if (key === 8 || key === 32) {
                // e.preventDefault()
                this.keyper(key)
            } else if (key === 13) {
                // e.preventDefault()
                this.process()
            }
        })

        $(window).on('keypress', (e) => {
            if (!this.$w.hasClass('active')) return

            this.keyper(e.which)
            this.$i.trigger('move')
        })

        this.$i.on('move', () => {
            this.$i.scrollTop(this.$i[0].scrollHeight)
        })
    }

    /**
     * activeCheck
     * Checks if the current terminal window should be active
     */
    activeCheck () {
        const debounce = () => {
            var pT = this.$w.offset().top
            var pL = this.$w.offset().left
            var scroll = $(window).scrollTop()
            var wH = $(window).height()
            var wW = $(window).width()

            if (scroll + wH > pT && scroll < pT + wH && pL < wW) {
                this.$w.addClass('active')
            } else {
                this.$w.removeClass('active')
            }
        }

        var diff = new Date().getTime() - this.activeChecked

        if (this.activeChecked == null || diff >= 500) {
            this.activeChecked = new Date().getTime()
            debounce()
        } else {
            clearTimeout(this.activeTimer)
            this.activeTimer = setTimeout(debounce, 500)
        }
    }

    /**
     * keyper
     * Simple handler for all input to terminal
     *
     * @param {Number} key - key charactor
     */
    keyper (key) {
        const letter = String.fromCharCode(key)
        const $line = $('> span:last-child', this.$i)
        let $sec = $('> span:last-child', $line)

        if (!$sec.hasClass('input')) {
            $line.append('<span class="input"></span>')
            $sec = $('> span:last-child', $line)
        }

        if (key === 8) {
            $sec.text($sec.text().slice(0, -1))
        } else {
            $sec.text($sec.text() + letter)
        }

        this.$i.trigger('move')
    }

    /**
    * append
    * Writes a new line to terminal
    *
    * @param {String} str - string to write to terminal (it can honestly be anything)
    * @param {Number} time - time in miliseconds to wait before appending
    * @returns {Object} - jQuery object of newly appended line
    */
    append (str, time = 0) {
        if (str.substr(0, 4) !== '<span') str = '<span>' + str + '</span>'
        const data = $(str)

        return new Promise((resolve, reject) => {
            setTimeout(() => {
                this.$i.append(data)
                this.$i.trigger('move')
                return resolve($('> span:last-child', this.$i))
            }, time)
        })
    }

    /**
     * format
     * Returns span ready for DOM appendage
     *
     * @param {String} str - string to write
     * @param {Number} c - terminal color code
     * @param {String} s - text style properties (bold)
     * @param {String} i - additional classes to write
     * @returns {String} - span wrapped text with color
     */
    format (str, c, s, i) {
        if (this.colors[c] != null) c = this.colors[c]

        var out = '<span'
        var styles = []

        if (c != null) styles.push(['color', c])

        if (s != null && s === 'i') styles.push(['font-style', 'italic'])
        if (s != null && s === 'b') styles.push(['font-weight', 'bold'])
        if (s != null && s === 'u') styles.push(['text-decoration', 'underline'])

        if (styles.length > 0) {
            out += ' style="'

            styles.forEach((o) => {
                out += `${o[0]}: ${o[1]};`
            })

            out += '"'
        }

        if (i != null) out += ` class="${i}"`

        out += `>${str}</span>`

        return out
    }

    /**
     * prompt
     * Prints a prompt
     */
    prompt () {
        const folder = this.folder.replace(`/home/${this.user}`, '~')
        const prompt = this.format(`${this.user}@${this.host}`, 2, 'b') + this.format(':') + this.format(folder, 4, 'b') + this.format('$')

        let title = this.folder
        if (this.folder === `/home/${this.user}`) {
            title = 'Home'
        }
        if (this.history.length > 0) {
            const last = this.history[this.history.length - 1]

            if (last.length > 30) {
                title += `: ${last.split(' ')[0]}`
            } else {
                title += `: ${last}`
            }
        }

        $('.titlebar .title', this.$w).text(title)
        $('.tabbar .tab.active .title', this.$w).text(title)
        this.append(`<span class="prompt">${prompt} </span><span class="input"></span>`)
        this.$i.trigger('move')
    }

    /**
     * process
     * Takes user input from line and processes it
     *
     * @param {String} cmd - command to process
     * @returns {Number} exit code of the ran command
     */
    process (cmd = $('> span:last-child > span.input:last-of-type', this.$i).text()) {
        cmd = cmd.replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"|'/g, '&quot;')

        if (!this.$w.hasClass('active') || this.onHold) {
            return new Promise((resolve, reject) => {
                setTimeout(() => {
                    this.process(cmd)
                }, 50)
            })
        }

        const time = new Date()

        return new Promise((resolve, reject) => {
            if (cmd == null || cmd === '') return resolve(0)

            const cmds = Object.keys(this.commands).filter((reg) => {
                const regex = new RegExp(reg.substr(1, reg.lastIndexOf('/') - 1), reg.substr(reg.lastIndexOf('/') + 1))
                return regex.test(cmd)
            })

            if (cmds.length < 1) return reject(-1)

            this.history.push(cmd)

            $('.titlebar .title', this.$w).text(cmd)
            $('.tabbar .tab.active .title', this.$w).text(cmd)

            return resolve(this.commands[cmds[0]](cmd, this))
        })
        .catch((code) => {
            if (code !== -1) return

            return this.append(`${cmd.split(' ')[0]}: command not found`, Math.random() * 30)
            .then(() => 1)
        })
        .then((code) => {
            const current = new Date()

            if (current - time > 300) this.notify(this.history[this.history.length - 1])

            this.prompt()
            return code
        })
    }

    /**
     * notify
     * Creates a notification
     *
     * @param {String} cmd - command to put on notification
     */
    notify (cmd) {
        if (!this.$w.hasClass('active')) return

        const $c = $('#notification-container')
        const $p = $c.parent('.pantheon')

        var $n = $('[type="notification"]', $c)
        $('p', $n).text(cmd)
        $n.addClass('active')

        $p.show()
        $c.append($n)
        $n.one('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', (e) => {
            $p.hide()
        })
    }

    /**
     * type
     * Types a command out in the terminal then runs it
     *
     * @param {String} cmd - command to type
     * @returns {Number} exit code of the ran command
     */
    type (cmd) {
        return new Promise((resolve, reject) => {
            let time = 0

            for (let i = 0; i < cmd.length; i++) {
                setTimeout(() => {
                    this.keyper(cmd.charCodeAt(i))
                }, time)

                time += 50
            }

            setTimeout(() => {
                this.process()
                .then((c) => resolve(c))
                .catch((e) => reject(e))
            }, time + 200)
        })
    }
}
