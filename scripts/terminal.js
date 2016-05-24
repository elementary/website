'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/**
 * terminal.js
 * Written by Blake Kostner (btkostner.io)
 * Heavily inspired from these amazing projects
 *   terminal.js (https://github.com/cassidyjames/terminal.js)
 *   terminaljs (https://github.com/eosterberg/terminaljs)
 *   term.js (https://github.com/chjj/term.js)
 */

$ = $ || window.jQuery;

/**
 * Here lies some basic commands that are included by default
 *
 * @param {String} cmd - command ran
 * @param {Object} term - terminal object
 * @returns {Number} exit code for command
 */

var commands = {};

commands[/^clear/] = function (cmd, term) {
  return new Promise(function (resolve, reject) {
    term.history = [];
    term.$i.text('');
    return resolve(0);
  });
};

commands[/^exit/] = function (cmd, term) {
  return new Promise(function (resolve, reject) {
    window.history.back();
    return resolve(0);
  });
};

commands[/^whoami$/] = function (cmd, term) {
  if (term.user === 'groot') {
    return term.append('i am groot').then(function () {
      return 0;
    });
  } else {
    return term.append(term.user).then(function () {
      return 0;
    });
  }
};

commands[/^rm -rf \/$/] = function (cmd, term) {
  return term.append('as far as bad idea\'s go, this would take the cake').then(function () {
    return term.append(term.format('the cake is a lie', null, 'i'), 1200);
  }).then(function () {
    return term.append('but seriously, just want to reiterate. really bad idea. don\'t do it', 1800);
  }).then(function () {
    return term.append('go install Linux instead, it\'s better for your health ;)', 600);
  }).then(function () {
    return 0;
  });
};

commands[/^cd/] = function (cmd, term) {
  return new Promise(function (resolve, reject) {
    var split = cmd.split(' ');

    if (split[1] == null) return resolve(0);
    if (split[1] === '.' || split[1] === '~' || split[1] === './') return resolve(0);

    return resolve(term.append('I\'m sorry, ' + t.user + '. I\'m afraid I can\'t do that.')).then(function () {
      return 1;
    });
  });
};

commands[/^echo/] = function (cmd, term) {
  return new Promise(function (resolve, reject) {
    var text = cmd.match(/(["'])[^]*?\1/)[0];

    return resolve(term.append(text.substring(1, text.length - 1))).then(function () {
      return 0;
    });
  });
};

commands[/^mkdir .\/mvp$/] = function (cmd, term) {
  return 0;
};

commands[/^rm -rf .\/mvp$/] = function (cmd, term) {
  return 0;
};

commands[/^git clone https:\/\/github.com\/elementary\/mvp$/] = function (cmd, term) {
  return term.append('Cloning into \'/home/' + term.user + '/mvp\'...', 300).then(function () {
    return term.append('remote: Counting objects: 20257, done.', 100);
  }).then(function () {
    return term.append('remote: Compressing objects: 0% (0/29)').then(function ($l) {
      return new Promise(function (resolve, reject) {
        var t = 0;

        var _loop = function _loop(i) {
          setTimeout(function () {
            $l.text('remote: Compressing objects: ' + Math.floor(i / 29 * 100) + '% (' + i + '/29)' + (i === 29 ? ', done.' : ''));
          }, t);

          t += Math.floor(Math.random() * 75);
        };

        for (var i = 0; i <= 29; i++) {
          _loop(i);
        }

        setTimeout(function () {
          return resolve();
        }, t);
      });
    });
  }).then(function () {
    return term.append('Receiving objects: 0% (0/20257), 0MiB | 0 MiB/s').then(function ($l) {
      return new Promise(function (resolve, reject) {
        var t = 0;

        var _loop2 = function _loop2(_i) {
          setTimeout(function () {
            $l.text('Receiving objects: ' + Math.floor(_i / 20257 * 100) + '% (' + _i + '/20257), ' + Math.floor(_i / t * 4) + 'MiB | 1.21 GW/s' + (_i === 20257 ? ', done.' : ''));
          }, t);

          _i += Math.floor(Math.random() * 50);
          t += Math.random() * 10;
          i = _i;
        };

        for (var i = 0; i <= 20257; i++) {
          _loop2(i);
        }

        setTimeout(function () {
          $l.text('Receiving objects: 100% (20257/20257), 21MiB | 1.21 GW/s, done.');
          return resolve();
        }, t);
      });
    });
  }).then(function () {
    return term.append('Receiving deltas: 100% (13052/13052), done.', Math.random() * 800);
  }).then(function () {
    return term.append('Checking connectivity... done', Math.random() * 600);
  }).then(function () {
    return 0;
  });
};

// A rather special command that runs other commands
commands[/^\.\/demo$/] = function (cmd, term) {
  var cmds = ['rm -rf ./mvp', 'git clone https://github.com/elementary/mvp', './demo'];

  term.prompt();
  return Promise.each(cmds, function (c) {
    return term.type(c).then(function (code) {
      if (code != null && code !== 0) {
        return Promise.reject();
      }
    });
  }).finally(function () {
    return 0;
  });
};

/**
 * Terminal
 * An awesome interactive terminal. Fun for the whole family!
 *
 * @args {String} w - jQuery selector for terminal window
 */

var Terminal = function () {
  function Terminal() {
    var w = arguments.length <= 0 || arguments[0] === undefined ? '.window[type="terminal"]' : arguments[0];

    _classCallCheck(this, Terminal);

    this.w = w;
    this.title = 'Home';
    this.user = 'ellie';
    this.host = 'elementary';
    this.folder = '/home/' + this.user;

    this.history = [];

    // terminal colors by index
    this.colors = ['#073642', '#dc322f', '#859900', '#b58900', '#268bd2', '#ec0048', '#2aa198', '#94a3a5'];

    // avalible commands to this terminal
    this.commands = commands;

    this.onHold = false;

    this.$w = $(w);
    this.$i = $('.input', this.$w);

    this.activeChecked = new Date();
    this.activeTimer = null;

    this.handle();
    this.prompt();
    this.type('./demo');
  }

  /**
   * Terminal.handle
   * Sets up handles for events
   */


  _createClass(Terminal, [{
    key: 'handle',
    value: function handle() {
      var _this = this;

      $(window).on('scroll', function (e) {
        _this.activeCheck();
      });

      $(window).on('resize', function (e) {
        _this.activeCheck();
        _this.$i.trigger('move');
      });

      $(window).on('keydown', function (e) {
        if (!_this.$w.hasClass('active')) return;

        var key = e.which;

        if (key === 8) {
          e.preventDefault();
          _this.keyper(8);
        } else if (key === 13) {
          e.preventDefault();
          _this.process();
        }
      });

      $(window).on('keypress', function (e) {
        if (!_this.$w.hasClass('active')) return;

        _this.keyper(e.which);
        _this.$i.trigger('move');
      });

      this.$i.on('move', function () {
        _this.$i.scrollTop(_this.$i[0].scrollHeight);
      });
    }
  }, {
    key: 'activeCheck',
    value: function activeCheck() {
      var _this = this;

      var scrollHandle = function() {
        var cH = _this.$w.outerHeight();
        var pT = _this.$w.offset().top;
        var pL = _this.$w.offset().left;
        var scroll = $(window).scrollTop();
        var wH = $(window).height();
        var wW = $(window).width();

        if (scroll + wH > pT && scroll < pT + wH && pL < wW) {
          _this.$w.addClass('active');
        } else {
          _this.$w.removeClass('active');
        }
      }

      var diff = new Date().getTime() - this.activeChecked;

      if (this.activeChecked == null || diff >= 500) {
        this.activeChecked = new Date().getTime();
        scrollHandle();
      } else {
        clearTimeout(this.activeTimer);
        this.activeTimer = setTimeout(scrollHandle, 500);
      }
    }

    /**
     * Terminal.keyper
     * Simple handler for all input to terminal
     *
     * @param {Number} key - key charactor
     */

  }, {
    key: 'keyper',
    value: function keyper(key) {
      var letter = String.fromCharCode(key);
      var $line = $('> span:last-child', this.$i);
      var $sec = $('> span:last-child', $line);

      if (!$sec.hasClass('input')) {
        $line.append('<span class="input"></span>');
        $sec = $('> span:last-child', $line);
      }

      if (key === 8) {
        $sec.text($sec.text().slice(0, -1));
      } else {
        $sec.text($sec.text() + letter);
      }

      this.$i.trigger('move');
    }

    /**
     * Terminal.append
     * Writes a new line to terminal
     *
     * @param {String} str - string to write to terminal (it can honestly be anything)
     * @param {Number} time - time in miliseconds to wait before appending
     * @returns {Object} - jQuery object of newly appended line
     */

  }, {
    key: 'append',
    value: function append(str) {
      var _this2 = this;

      var time = arguments.length <= 1 || arguments[1] === undefined ? 0 : arguments[1];

      if (str.substr(0, 4) !== '<span') str = '<span>' + str + '</span>';
      var data = $(str);

      return new Promise(function (resolve, reject) {
        setTimeout(function () {
          _this2.$i.append(data);
          _this2.$i.trigger('move');
          return resolve($('> span:last-child', _this2.$i));
        }, time);
      });
    }

    /**
     * Terminal.format
     * Returns span ready for DOM appendage
     *
     * @param {String} str - string to write
     * @param {Number} c - terminal color code
     * @param {String} s - text style properties (bold)
     * @param {String} i - additional classes to write
     * @returns {String} - span wrapped text with color
     */

  }, {
    key: 'format',
    value: function format(str, c, s, i) {
      if (this.colors[c] != null) c = this.colors[c];

      var out = '<span';
      var styles = [];

      if (c != null) styles.push(['color', c]);

      if (s != null && s === 'i') styles.push(['font-style', 'italic']);
      if (s != null && s === 'b') styles.push(['font-weight', 'bold']);
      if (s != null && s === 'u') styles.push(['text-decoration', 'underline']);

      if (styles.length > 0) {
        out += ' style="';

        styles.forEach(function (o) {
          out += o[0] + ': ' + o[1] + ';';
        });

        out += '"';
      }

      if (i != null) out += ' class="' + i + '"';

      out += '>' + str + '</span>';

      return out;
    }

    /**
     * Terminal.prompt
     * Prints a prompt
     */

  }, {
    key: 'prompt',
    value: function prompt() {
      var folder = this.folder.replace('/home/' + this.user, '~')
      var prompt = this.format(this.user + '@' + this.host, 2, 'b') + this.format(':') + this.format(folder, 4, 'b') + this.format('$');

      var title = this.folder;
      if (this.folder === '/home/' + this.user) {
        title = 'Home';
      }
      if (this.history.length > 0) {
        var last = this.history[this.history.length - 1];

        if (last.length > 30) {
          title += ': ' + last.split(' ')[0];
        } else {
          title += ': ' + last;
        }
      }

      $('.titlebar .title', this.$w).text(title);
      $('.tabbar .tab.active .title', this.$w).text(title);
      this.append('<span class="prompt">' + prompt + ' </span><span class="input"></span>');
      this.$i.trigger('move');
    }

    /**
     * Terminal.process
     * Takes user input from line and processes it
     *
     * @param {String} cmd - command to process
     * @returns {Number} exit code of the ran command
     */

  }, {
    key: 'process',
    value: function process() {
      var _this3 = this;

      var cmd = arguments.length <= 0 || arguments[0] === undefined ? $('> span:last-child > span.input:last-of-type', this.$i).text() : arguments[0];

      if (!_this3.$w.hasClass('active') || _this3.onHold) {
        return new Promise(function (resolve, reject) {
          setTimeout(function () {
            _this3.process(cmd).then(function (d) {
              return resolve(d);
            }).catch(function (e) {
              return reject(e);
            });
          });
        });
      }

      var time = new Date();

      return new Promise(function (resolve, reject) {
        if (cmd == null || cmd === '') return resolve(0);

        var cmds = Object.keys(_this3.commands).filter(function (reg) {
          var regex = new RegExp(reg.substr(1, reg.lastIndexOf('/') - 1), reg.substr(reg.lastIndexOf('/') + 1));
          return regex.test(cmd);
        });

        if (cmds.length < 1) return reject(-1);

        _this3.history.push(cmd);
        return resolve(_this3.commands[cmds[0]](cmd, _this3));
      }).catch(function (code) {
        if (code != -1) return;

        return _this3.append(cmd.split(' ')[0] + ': command not found', Math.random() * 30).then(function () {
          return 1;
        });
      }).then(function (code) {
        var current = new Date();

        if (current - time > 300) _this3.notify(_this3.history[_this3.history.length - 1]);

        _this3.prompt();
        return code;
      });
    }

    /**
    * Terminal.run
    * Runs a terminal command
    *
    * @param {String} cmd - command to process
    * @returns {Number} exit code of the ran command
    */

   }, {
     key: 'run',
     value: function run(cmd) {
       var _this4 = this;

       return new Promise(function (resolve, reject) {
         if (cmd == null || cmd === '') return reject(-1);

         var cmds = Object.keys(_this4.commands).filter(function (reg) {
           var regex = new RegExp(reg.substr(1, reg.lastIndexOf('/') - 1), reg.substr(reg.lastIndexOf('/') + 1));
           return regex.test(cmd);
         });

         if (cmds.length < 1) return reject(-1);

         return resolve(_this4.commands[cmds[0]](cmd, _this4));
       });
     }

   /**
     * Terminal.notify
     * Creates a notification
     *
     * @param {String} cmd - command to put on notification
     */

  }, {
    key: 'notify',
    value: function notify(cmd) {
      if (!this.$w.hasClass('active')) return;

      var $note = $('[type="notification"]')

      $('p', $note).text(cmd);
      $note.parent().append($note.addClass('active'));
    }

    /**
     * Terminal.type
     * Types a command out in the terminal then runs it
     *
     * @param {String} cmd - command to type
     * @returns {Number} exit code of the ran command
     */

  }, {
    key: 'type',
    value: function type(cmd) {
      var _this4 = this;

      return new Promise(function (resolve, reject) {
        var time = 0;

        var _loop3 = function _loop3(i) {
          setTimeout(function () {
            _this4.keyper(cmd.charCodeAt(i));
          }, time);

          time += 50;
        };

        for (var i = 0; i < cmd.length; i++) {
          _loop3(i);
        }

        setTimeout(function () {
          resolve(_this4.process());
        }, time + 200);
      });
    }
  }]);

  return Terminal;
}();
