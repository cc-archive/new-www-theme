This theme uses npm, gulp, and browserify to manage dependencies.

Versions of node and npm we know work:
`npm 3.3.12`
`node 5.4.1`

To install gulp:

- run `npm install -g gulp`

To build the js/css:

- run `npm install` to download the 3rd party libs in `package.json`
- during development:
    - run `gulp` in the background, i.e. run `gulp` in a terminal and leave it running. It will automatically recompile
     `css/app.css` files as you edit the src files.
- when preparing for production:
    - run `gulp dist` to create minified `css/app.css` files.
- also update the CC_CSS_RELEASE_SERIAL_NUMBER at the top of functions.php to purge the caches.