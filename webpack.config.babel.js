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
import webpack from 'webpack'

const scriptPattern = path.resolve('_scripts', 'pages', '**', '*.js')

const browsers = [
    'last 4 version',
    'not ie <= 11'
]

const stats = {
    hash: false,
    version: false,
    timings: true,
    assets: true,
    chunks: false,
    modules: false,
    reasons: true,
    children: false,
    source: true,
    errors: true,
    errorDetails: true,
    warnings: true,
    publicPath: false
}

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
    devtool: 'source-map',
    entry: scriptFiles,
    output: {
        filename: '[name].js',
        path: './scripts',
        publicPath: '/scripts',
        sourceMapFilename: '[name].map.js'
    },
    module: {
        rules: [{
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /node_modules/,
            query: {
                presets: [['env', {
                    modules: false,
                    targets: { browsers }
                }]]
            }
        }]
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, '_scripts')
        }
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'common',
            minChunks: Infinity
        }),
        new webpack.optimize.UglifyJsPlugin({
            minimize: true,
            sourceMap: true,
            mangle: true,
            compressor: {
                warnings: false,
                screw_ie8: true
            }
        }),
        new webpack.DefinePlugin({
            'process.env': {
                'NODE_ENV': JSON.stringify('production')
            }
        })
    ],
    stats
}
