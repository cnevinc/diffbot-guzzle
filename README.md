diffbot-guzzle
==============

Diffbot client library using Guzzle PHP. For server API document please visit http://www.diffbot.com/products/automatic/.

<h2>Installation</h2>
1. Install Composer
2. Install Guzzle
3. Place the code

<h3>1. Install Composer</h3>
<h4> For windows </h4>
Download <a href='http://getcomposer.org/Composer-Setup.exe'>Composer-Setup.exe</a> and install
<h4> For x-nix </h4>
<pre>
curl -sS https://getcomposer.org/installer | php
</pre>
<h3>1. Install Guzzle</h3>
<h4> For windows </h4>
Create a folder as your website root. Use command line and go to that folder. Execute: 
<pre>
composer require guzzle/guzzle:~3.7
</pre>
<h4> For x-nix </h4>
<pre>
php composer.phar require guzzle/guzzle:~3.7
</pre>
<h3>3. Place the code</h3>
See index.php for examples on how to use Guzzle to make REST call to Diffbot server.
