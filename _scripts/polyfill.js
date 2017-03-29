/**
 * _scripts/polyfill.js
 * Overwrites global values for all browsers to support things like Promises
 * I'm sorry world :'(
 */

var _Promise = require('core-js/library/es6/promise')

global.Promise = _Promise
