# HarmsTylerClarifyBundle

The HarmsTylerClarifyBundle is a symfony wrapper bundle for the [Clarify](http://clarify.io/) php helper library.
Much of the Extension code is inspired by the [NelmioSolariumBundle](https://github.com/nelmio/NelmioSolariumBundle).

## Installation

Add HarmsTylerClarifyBundle in your composer.json:

```js
{
    "require": {
        "harmstyler/clarify-bundle": "dev-master"
    }
}
```

Download bundle:

``` bash
$ php composer.phar update harmstyler/clarify-bundle
```

Register HarmsTylerClarifyBundle with your AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            ...
            new HarmsTyler\ClarifyBundle\HarmsTylerClarifyBundle(),
            ...
        );
        ...
    }

## Basic configuration

Declare a default app:

```yaml
harms_tyler_clarify:
    apps:
        default:
            api_key: <api_key>

```

## Usage

```php
$bundle = $this->get('clarify.app');
$result = $bundle->search('close');
$results = $result['item_results'];
```

## Multiple apps

```yaml
harms_tyler_clarify:
    apps:
        default:
            api_key: <api_key>
        another:
            api_key: <api_key>
```

```php
$defaultBundle = $this->get('clarify.app');
$anotherBundle = $this->get('clarify.app.another');
```

You can also swap the `default` name with your own, doing so will require declaring the default app:

```yaml
harms_tyler_clarify:
    default_app: firstApp
    apps:
        firstApp:
            api_key: <api_key>
        secondApp:
            api_key: <api_key>
```

```php
$firstApp = $this->get('clarify.app');
//or
$firstApp = $this->get('clarify.app.firstApp');

$secondApp = $this->get('clarify.app.secondApp');
```

## License

Released under the MIT License, see LICENSE.
