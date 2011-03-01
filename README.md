# Cookie Free Domain (CFD)

CFD module built for the Kohana PHP framework.  Light weight wrapper for the HTML::* class to serve static files from a cookie free domain.


## Requirements

- PHP 5.2+
- Kohana PHP 3.x (read the docs!)


## Setup

- Enable the module in Kohana's bootstrap file.


## Configuration


Simply extend

		abstract class Kohana_CFD

in your application folder and replace $subdomain.

		public static $subdomain = 'media';


## Links

[Markdown Reader](http://www.google.com/search?sourceid=chrome&ie=UTF-8&q=markdown+reader)

[Kohana PHP Framework](http://kohanaframework.org/)

[Yahoo Performance Rules](http://developer.yahoo.com/performance/rules.html#cookie_free)