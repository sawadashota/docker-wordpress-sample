const path = require('path')
const CleanWebpackPlugin = require('clean-webpack-plugin')

// For bundle scss
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')

const devMode = process.env.NODE_ENV !== 'production'

module.exports = {
  mode: devMode ? 'development' : 'production',
  devtool: devMode ? 'inline-source-map' : 'source-maps',
  entry: {
    app: './src/index.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist'),
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: [
                [
                  'env',
                  {
                    "targets": {
                      "browsers": [ ">0.25%"]
                    },
                  },
                ],
              ],
            },
          },
        ],
      },
      {
        test: /\.scss/, // 対象となるファイルの拡張子
        use: ExtractTextPlugin.extract({
          use:
            [
              {
                loader: 'css-loader',
                options: {
                  url: false,
                  sourceMap: devMode,
                  // 0 => no loaders (default);
                  // 1 => postcss-loader;
                  // 2 => postcss-loader, sass-loader
                  importLoaders: 2,
                },
              },
              {
                loader: 'sass-loader',
                options: {
                  sourceMap: devMode,
                },
              },
            ],
        }),
      },
    ],
  },
  // Minify CSS
  optimization: {
    minimizer: [
      new UglifyJsPlugin({
        cache: true,
        parallel: true,
        sourceMap: devMode,
      }),
      new OptimizeCSSAssetsPlugin({})
    ]
  },
  plugins: [
    // Clean up dist directory before compile
    new CleanWebpackPlugin(['dist']),
    // Don't bundle CSS in JS
    new ExtractTextPlugin('app.css'),
  ],
}
