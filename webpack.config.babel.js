/**
 * webpack.config.babel.js
 * Builds mvp assets for use in a browser
 *
 * @exports {Object} styles - configuration object for style assets
 * @exports {Object} scripts - configuration object for script assets
 * @exports {Array} default - configuration objects for webpack
 */

import path from 'path'

import glob from 'glob'

import { fileURLToPath } from "url"
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
        publicPath: '/scripts',
    },
    module: {
        rules: [{
            test: /\.m?js$/,
            exclude: /node_modules/,
            use: {
                loader: 'babel-loader',
            }
        }]
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, '_scripts')
        }
    },
    optimization: {
        runtimeChunk: 'single',
    },
    plugins: [
        new WebpackManifestPlugin({
            'basePath': 'scripts/'
        })
    ]
}
