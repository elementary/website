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
import glob from 'glob'
import path from 'path'
import webpack from 'webpack'

const stylePattern = path.resolve('_styles', '**', '*.css')

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

const styleFiles = {}
const scriptFiles = {}

glob.sync(stylePattern).forEach((p) => {
    const name = p.replace(path.resolve(__dirname, '_styles') + path.sep, '')
    styleFiles[name] = p
})

glob.sync(scriptPattern).forEach((p) => {
    const name = p
    .replace(path.resolve(__dirname, '_scripts', 'pages') + path.sep, '')
    .replace('.js', '')
    scriptFiles[name] = p
})

export const styles = {
    entry: styleFiles,
    output: {
        filename: '[name]',
        path: './styles'
    },
    module: {
        rules: [{
            test: /\.css$/,
            use: Extract.extract({
                use: [{
                    loader: 'raw-loader'
                }, {
                    loader: 'postcss-loader',
                    options: {
                      plugins: () => [
                        cssnext({ browsers })
                      ]
                    }
                }]
            })
        }]
    },
    plugins: [
        new Extract('[name]')
    ],
    stats
}

export const scripts = {
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
          },
          ...styles.module.rules
        ]
    },
    resolve: {
        alias: {
            '~': path.resolve(__dirname, '_scripts'),
            'styles': path.resolve(__dirname, '_styles')
        }
    },
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'common',
            minChunks: Infinity
        }),
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
