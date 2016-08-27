/**
 * webpack.config.babel.js
 * Builds mvp assets for use in a browser
 *
 * @exports {Object} styles - configuration object for style assets
 * @exports {Object} scripts - configuration object for script assets
 * @exports {Array} default - configuration objects for webpack
 */

import cssnext from 'postcss-cssnext'
import Extract from 'extract-text-webpack-plugin'
import path from 'path'
import webpack from 'webpack'

const styleFiles = {
    'brand': 'brand.css',
    'capnet-assist': 'capnet-assist.css',
    'developer': 'developer.css',
    'docs': 'docs.css',
    'get-involved': 'get-involved.css',
    'home': 'home.css',
    'main': 'main.css',
    'open-source': 'open-source.css',
    'solarized_dark_bash': 'solarized_dark_bash.css',
    'solarized_dark': 'solarized_dark.css',
    'solarized_light': 'solarized_light.css',
    'store': 'store.css',
    'support': 'support.css',
    'team': 'team.css'
}

const scriptFiles = {
    'developer': 'developer.js',
    'docs/installation': 'docs/installation.js',
    'docs/main': 'docs/main.js',
    'download': 'download.js',
    'get-involved': 'get-involved.js',
    'main': 'main.js',
    'slider.run': 'slider.run.js',
    'slingshot': 'slingshot.js',
    'store/cart': 'store/cart.js',
    'store/checkout': 'store/checkout.js',
    'store/index': 'store/index.js'
}

const browsers = [
    'last 2 version',
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

Object.keys(styleFiles).forEach((key) => {
    styleFiles[key] = `./_styles/${styleFiles[key]}`
})

Object.keys(scriptFiles).forEach((key) => {
    scriptFiles[key] = `./_scripts/${scriptFiles[key]}`
})

export const styles = {
    entry: styleFiles,
    output: {
        filename: '[name].css',
        path: './styles'
    },
    module: {
        loaders: [
            { test: /\.css$/, loader: Extract.extract('raw!postcss') }
        ]
    },
    postcss: [
        cssnext({ browsers })
    ],
    plugins: [
        new Extract('[name].css')
    ],
    stats
}

export const scripts = {
    devtool: 'eval',
    entry: scriptFiles,
    output: {
        filename: '[name].js',
        path: './scripts',
        publicPath: '/scripts'
    },
    exclude: [
        path.resolve(__dirname, 'node_modules')
    ],
    module: {
        loaders: [
            { test: /\.js$/, loader: 'babel', exclude: /node_modules/ },
            { test: /\.css$/, loader: 'style!css!postcss' }
        ]
    },
    resolve: {
        alias: {
            'lib': path.resolve(__dirname, '_scripts', 'lib'),
            'styles': path.resolve(__dirname, '_styles')
        }
    },
    postcss: styles.postcss,
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'common',
            minChunks: 4
        }),
        new webpack.optimize.DedupePlugin(),
        new webpack.optimize.OccurenceOrderPlugin(),
        new webpack.optimize.UglifyJsPlugin({
            minimize: true,
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

export default [styles, scripts]
