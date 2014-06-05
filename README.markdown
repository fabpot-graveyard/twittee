What is Twittee?
================

Twittee is the **smallest**, and still useful, Dependency Injection Container
in PHP; it is also probably one of the first public software to use the newest
anonymous functions support of **PHP 5.3**.

Packed in less than **140 characters**, it fits in a [tweet][1].

Despite its size, Twittee is a full-featured Dependency Injection Container
with support for object definitions, object injection and parameters.

Published in 2009 by [Fabien Potencier][2], Twittee is in the Public Domain.
Tweet me if you find a bug!

Usage
-----

Finding a simple example to demonstrate a Dependency Injection Container is
not an easy task. Instead of showing a classic "Hello World!" example, which
would have been too simple to demonstrate the power of Twittee, I have
converted the example I used to introduce the Symfony 2 Dependency Injection
Container on my [blog][3].

The following example shows how to create a Zend_Mail object that sends its
emails using a Gmail account:

    $c = new Container();
    
    // parameters
    $c->mailer_class = function () { return 'Zend_Mail'; };
    $c->mailer_username = function () { return 'fabien'; };
    $c->mailer_password = function () { return 'myPass'; };
    
    // objects / services
    $c->mailer_transport = function ($c) {
      return new Zend_Mail_Transport_Smtp(
        'smtp.gmail.com',
        array(
          'auth'     => 'login',
          'username' => $c->mailer_username,
          'password' => $c->mailer_password,
          'ssl'      => 'ssl',
          'port'     => 465,
        )
      );
    };
    $c->mailer = function ($c) {
      $obj = new $c->mailer_class();
      $obj->setDefaultTransport($c->mailer_transport);
      return $obj;
    };
    
    // get the mailer
    $mailer = $c->mailer;

Some explanations about the code are in order:

  * Parameters are defined by anonymous functions that return strings;

  * Objects/services are defined by anonymous functions that return object
    instances;

  * Links between objects and parameters access are done by accessing the
    container, which is passed to the anonymous function as an argument.

Looking for a "real" Dependency Injection Container for PHP?
------------------------------------------------------------

Try the [Symfony Service Container][4].

Do you like Twittee?
--------------------

If you like Twittee, you will also probably like [Twitto][5], the Web Framework
that fits in a tweet!

[1]: http://twitter.com/fabpot/status/1443952125
[2]: http://fabien.potencier.org/
[3]: http://fabien.potencier.org/article/12/do-you-need-a-dependency-injection-container
[4]: http://fabien.potencier.org/article/11/what-is-dependency-injection
[5]: http://twitto.org/
