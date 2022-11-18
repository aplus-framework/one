One
===

.. image:: image.png
    :alt: Aplus Framework One Project

Aplus Framework One Project.

- `Installation`_
- `Structure`_
- `Configuration`_
- `Routing`_
- `Running`_
- `Deployment`_
- `Conclusion`_

Installation
------------

The installation of this project can be done with Composer:

.. code-block::

    composer create-project aplus/one

Or, to install the latest `LTS <https://aplus-framework.com/lts>`_ version:

.. code-block::

    composer create-project aplus/one:^22

Structure
---------

Project One has a minimalistic structure, with an index.php file being the only,
or main, application file.

With just one file it is possible to create a simple website or a microservice.

It shows the versatility of how it is possible to structure an application with
the Aplus Framework.

This is the basic directory tree:

.. code-block::

    .
    ├── composer.json
    ├── preload.php
    ├── public/
    │   └── index.php
    ├── storage/
    │   └── logs/
    ├── tests/
    └── vendor/

And remember, it's highly customizable. You can adapt it as you like.

Configuration
-------------

The application's configurations are set directly in the App class constructor,
where, by default, only two services are set; the **exceptionHandler** and the
**logger**. Which shows a beautiful page when exceptions are thrown and is also
able to save logs in the ``storage/logs`` directory.

Routing
-------

The routing is defined directly in the index.php file, as it is expected not to
contain too many lines. By default, only the route with the root path of the URL
is set, and also a customization in the Error 404 page. Both return a closure
with an array to be JSON-encoded.

Running
-------

Finally, the application will respond to HTTP requests. As per the last line of
the index.php file:

.. code-block:: php

    $app->runHttp();

If the application also responds from the command line, it is possible to use
the ``run`` method and, if it is only for the command line; ``runCli``.

Deployment
----------

The instructions for deployment are the same as for
`App Project <https://docs.aplus-framework.com/guides/projects/app/index.html#deployment>`_.

Conclusion
----------

Aplus One Project is an easy-to-use tool for, beginners and experienced, PHP developers. 
It is perfect for creating simple, high-performance applications. 
The more you use it, the more you will learn.

.. note::
    Did you find something wrong? 
    Be sure to let us know about it with an
    `issue <https://gitlab.com/aplus-framework/projects/one/issues>`_. 
    Thank you!
