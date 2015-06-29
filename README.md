## About ##
This is a project I created that allows an end user to upload a bitmap-style image and then convert it into a Scalable Vector Graphic for them to download. This solves the problem of a readily available, _free (as in free beer)_, web-based SVG Vectorization program.

The project leverages HTML and CSS3 up front with some help from [Bootstrap](http://getbootstrap.com/) in order to put together a new front end because the old one was a crime against humanity. jQuery is being utilized in _land.js_ in order to hide the input buttons on the page so that the Bootstrap buttons can take all the glory.

_fileUpload.php_ does the heavy lifting; it handles checking the user's input to make sure the it something that can be vectorized and small enough to not take a very long time before it is passed off to [AutoTrace](http://linux.die.net/man/1/autotrace). Due to an incompatible MIME Type, _headerfix.sh_ exists in order to chop the top two line off of the resulting vector image since Autotrace declares it as an XML document. After the chop, _headerfix.sh_ throws an SVG declaration in so that the web browser sees the image as a SVG image and displays it accordingly.

## Getting Started ##
In order to play with this project, just follow these few easy steps:

1.  As of right now, Vectorizer only runs via Linux (originally developed on Debian).

2.  Make sure to install AutoTrace if not already installed (I believe with Ubuntu it is preinstalled):
`sudo apt-get install autotrace` (in the case of Debian-based distros).

3.  Make sure to install PHP if not already installed (and the rest of the LAMP stack (Linux Apache MySQL PHP) while you're at it).
`sudo apt-get install PHP`

4.  From here, open your [browser of choice](https://www.mozilla.org/en-US/firefox/new/) and navigate to _index.html_

5.  The rest...well the rest is pretty self explanatory huh? Enjoy.