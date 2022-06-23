# PHP JasperStarter Library

Use a symfony bundle for additional features/capabilities and integration into Symfony

## Install JasperStarter Library via Composer

```
composer require "simplisti/jasper-starter"
```

## Example

### TODO
 - Basic no DB report
 - DB report
 - JSON or XML

 - Include a compile profiler button in toolbar?
```

![image](https://user-images.githubusercontent.com/4084940/175361601-bbc8e458-3d41-41f8-94a2-68c0dd08c63c.png)


<?php

include_once 'vendor/autoload.php';

use Simplisti\Lib\JasperStarter\Reporter;

use Simplisti\Lib\JasperStarter\Option\OptionParameter as oParams;

use Simplisti\Lib\JasperStarter\Option\OptionDb as oDbConn;
use Simplisti\Lib\JasperStarter\Option\OptionOutputType as oOutputType;

// Use aggregate DB connection object
$optionDb = new oDbConn('simplisti', 'root');

$options[] = new oOutputType('pdf');
$options = array_merge($options, (array)$optionDb);

$parameters = new oParams([
    'ID_ORGANIZATION' => 254,
    'ID_WORKORDER' => 112203
]);

$outputFile = '';

$reporter = new Reporter('/opt/jasperstarter/bin/jasperstarter'); // NOTE: Manually provide jasperstarter?!? Need PATH= otherwise

$reporter->compile('/vagrant/devlib/tpl/cert.jrxml');
$reporter->process('/vagrant/devlib/tpl/cert.jasper', $outputFile, $options, $parameters);

$parameters = [];
$reporter->listParameters('tpl/cert.jrxml', $parameters);

print_r($parameters);
```

## Alternatives

- https://packagist.org/packages/cossou/jasperphp
- https://packagist.org/packages/jasperphp/jasperphp
