# Hello #
This is one of my little pet projects that is called 'Vectorizer' (it really rolls off the tongue, I know). What we are looking at here is a project that I had been working on for my in my senior capstone course in university. Three classmates and myself were tasked with creating a web page that allowed an end user to upload a bitmap-style image and then convert it into a Scalable Vector Graphic for them to download. This solved the problem of a readily available, _free (as in free beer)_, web-based SVG Vectorization program.

The initial iteration of the project was enough to get us an 'A' on the project but I wanted the project to be more than it was so I took it upon myself to continue working on the project in my free time in order to make it everything I wanted it to be.

As far as what we have going on, this project is running HTML and CSS3 upfront in the form of [Bootstrap](http://getbootstrap.com/) so that I could rapidly prototype a new interface because let's face it, the old one was a crime against humanity. There is also some jQuery being used in _land.js_ to solve a little problem of hiding the different inputs on the page since they seem to be quite annoying to style. With jQuery, I was able to hide them while allowing Bootsrap buttons to be clicked which would then 'Click' the hidden buttons. All the heavy lifting on the backend is being done via PHP in _fileUpload.php_. The PHP is checking the user's file to make sure that it is something that is allowed to be uploaded and that the file size is within reason. From here, the 'Vectorization' begins which leverages [AutoTrace](http://linux.die.net/man/1/autotrace). Due to an incompatible MIME Type, _headerfix.sh_ exists in order to chop the top two line off of the resulting vector image since Autotrace declares it as an XML document. After the chop, _headerfix.sh_ throws an SVG declaration in so that the web browser sees the image as a SVG image and displays it accordingly. I'm currently in the process of tidying everything up (I'm looking at you, _fileUpload.php_) and adding in aditional features once I get the aforementioned tidying done.

## Getting Started ##
In order to play with this project, just follow these few easy steps:
-  As of right now, Vectorizer only runs via Linux (originally developed on Debian).
-  Make sure to install AutoTrace if not already installed (I believe with Ubuntu it is preinstalled):
`sudo apt-get install autotrace` (in the case of Debian-based distros).
-  Make sure to install PHP if not already installed (and the rest of the LAMP stack (Linux Apache MySQL PHP) while you're at it).
`sudo apt-get install PHP`
-  From here, open your [browser of choice](https://www.mozilla.org/en-US/firefox/new/) and navigate to _index.html_
-  The rest...well the rest is pretty self explanatory huh? Enjoy.