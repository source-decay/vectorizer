#!/bin/sh

#April 2013
#Created by Josh Taylor
#Format the header of vectorImage.svg so that it can be displayed by the web browser as
#Autotrace formats the picture so that it is read as an XML document which prevents it
#from being displayed.

#Remove top two lines (the problem) from vectorImage.svg and make a new file called
#vectorImage2.svg
tail -n +3 $1 > upload/vectorImage2.svg

#Insert an SVG declaration that will fix the file so that it can be displayed
sed -i '1i<svg xmlns="http://www.w3.org/2000/svg" height="400" width="400">' upload/vectorImage2.svg
