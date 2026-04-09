/**
 * webpack.config.js
 * Builds mvp assets for use in a browser
 *
 * @exports {Object} default - configuration object for webpack
 */

import path from 'path'

import { glob } from 'glob'

import { fileURLToPath } from 'url'
import { WebpackManifestPlugin } from 'webpack-manifest-plugin'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

const scriptPattern = path.resolve('_scripts', 'pages', '**', '*.js')

/*
 * Everthing past this point is plugin configuration. Do not edit unless you
 * know what you are doing.
 */

const scriptFiles = {}

glob.sync(scriptPattern).forEach((p) => {
    const name = p
        .replace(path.resolve(__dirname, '_scripts', 'pages') + path.sep, '')
        .replace('.js', '')

    scriptFiles[name] = p
})

export default {
    mode: 'production',
    devtool: 'source-map',
    entry: scriptFiles,
    output: {
        filename: '[name].[contenthash].js',
        path: path.resolve(__dirname, 'scripts'),
        publicPath: '/scripts'
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, '_scripts')
        }
    },
    optimization: {
        runtimeChunk: 'single'
    },
    plugins: [
        new WebpackManifestPlugin({
            basePath: 'scripts/'
        })
    ]
}
