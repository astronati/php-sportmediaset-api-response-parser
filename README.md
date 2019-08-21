# SportMediaset Response Parser
Allows to map responses provided by any SportMediaset API endpoint.

## Supported Responses
Not all responses are currently supported but we are happy to work for you if you need some of them.

**NOTE:** To add another response into the supported list, please file a new issue.

To do that please file a new [issue](https://github.com/astronati/php-php-sportmediaset-api-response-parser/issues/new).

## Installation
You can install the library and its dependencies using `composer` running:
```sh
$ composer require astronati/sportmediaset-response-parser
```

### Usage
The library allows to return a model per each response and its content (formation, etc...).

##### Example
The following snippet can be helpful:

```php
use SMRP\Response\ResponseParser;
...
// Obtain a Response
$apiResponse = ... // Save this the response from the SportMediaset API
$response = ResponseParser::create($apiResponse, ResponseParser::GET_TEAM_FORMATION);
...
// Get Juventus formation
$formation = $response->getTeamFormationModel();
echo $formation->getCoach(); // Sarri
```

For more details please take a look at [Response](https://github.com/astronati/php-sportmediaset-api-response-parser/tree/master/src/Response).

## Development
The environment requires [phpunit](https://phpunit.de/), that has been already included in the `dev-dependencies` of the
`composer.json`.

### Dependencies
To install all modules you just need to run following command:

```sh
$ composer install
```

### Testing
Tests files are created in dedicates folders that replicate the
[src](https://github.com/astronati/php-sportmediaset-response-parser/tree/master/src) structure as follows:
```
.
+-- src
|   +-- [folder-name]
|   |   +-- [file-name].php
|   ...
+-- tests
|   +-- [folder-name]
|   |   +-- [file-name]Test.php
```

Execute following command to run the tests suite:
```sh
$ composer test
```

Run what follows to see the code coverage:
```sh
$ composer coverage
```

## License
This package is released under the [MIT license](LICENSE.md).

