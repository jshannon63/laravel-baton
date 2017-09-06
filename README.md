
# Baton - Share Laravel named routes and other collection data with javascript


Baton registers a global view composer which will enable passing of the Baton collection to all views. The Baton collection contains all named routes (optional) as well as any additional values you wish to add to the collection prior to rendering the view.
## Installation

1. Add Baton to your composer.json file: `composer require jshannon63/laravel-baton`
2. Laravel 5.5 will automatically take care of the service provider registration.


## Usage

### Configuration:

Baton will by default pass named routes to the rendered view. If you wish to disable this action, add the following line to your .env file.
```js
BATON_ROUTES = false    // Disable returning named routes in Baton
```
### By default, Baton contains a collection of named routes called "routes":

```php
array:1 [▼
  "routes" => Collection {#201 ▼
    #items: array:9 [▼
      "blogs" => Collection {#206 ▼
        #items: array:2 [▼
          "uri" => "blog"
          "methods" => array:2 [▼
            0 => "GET"
            1 => "HEAD"
          ]
        ]
      }
      "login" => Collection {#205 ▶}
      "logout" => Collection {#216 ▶}
      "register" => Collection {#217 ▶}
      "password.request" => Collection {#218 ▶}
      "password.email" => Collection {#219 ▶}
      "password.reset" => Collection {#220 ▶}
      "home" => Collection {#221 ▶}
      "about" => Collection {#222 ▶}
    ]
  }
]
```

### Adding additional data to Baton before passing on to the view
Baton is an extension of the Collection class. You may add, manuipulate or remove any collection elements using the methods of Illuminate\Support\Collection.

#### Example to add a Blog article to Baton:

First, create a real time Facade for Baton as follows
```php

use Facades/Jshannon63/Baton/Baton;

```

Then access the put method of Baton using the Facade.

```php

Baton::put( 'article', Blog::find(1) );

```

### Rendering Baton data in a view

The {!!baton!!} declaration will be replaced with a javascript compliant variable declaration. Notice that the syntax used to embed our $baton variable in the blade view will prevent escaping by the htmlspecialchars() function. You may place {!!$baton!!} anywhere in your view. You may choose to make it available as window.baton or even within a Vue component or other javascript implementation.
  
  This is before rendering...
```php
...  
  
<!-- JAVASCRIPT -->
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript">
    {!!$baton!!}
</script>
<!-- END JAVASCRIPT -->

</body>
</html>
```

This is after rendering...
```php
...    
  
<!-- JAVASCRIPT -->
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript">
    var baton = JSON.parse('{"routes":{"blogs":{"uri":"blog","methods":["GET","HEAD"]},"login":{"uri":"login","methods":["GET","HEAD"]},"logout":{"uri":"logout","methods":["POST"]},"register":{"uri":"register","methods":["GET","HEAD"]},"password.request":{"uri":"password\/reset","methods":["GET","HEAD"]},"password.email":{"uri":"password\/email","methods":["POST"]},"password.reset":{"uri":"password\/reset\/{token}","methods":["GET","HEAD"]},"home":{"uri":"home","methods":["GET","HEAD"]},"about":{"uri":"about","methods":["GET","HEAD"]}}}');
</script>
<!-- END JAVASCRIPT -->

</body>
</html>
```
In the above example, the blog route uri is available on the client side as window.baton.routes.blogs

## Contributing

If you would like to contribute refer to CONTRIBUTING.md