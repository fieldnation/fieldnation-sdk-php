# Contributing

## Tests
All merge requests require tests passing tests. Merge requests will not be approved if the tests do not pass, and if there are no new tests for the changes.

```sh
$ composer test
```

## Coding Standards
We follow the [PSR-2](http://www.php-fig.org/psr/psr-2) coding style. We will lint the code and merge requests will not be approved if they do not pass linting. You can lint using PHP_CodeSniffer.

```sh
$ composer lint:check
```

If you have lint errors or warnings you can try to auto clean them with `composer lint:fix`. If the errors/warnings can't be
fixed on their own you will have to manually fix them. `composer lint:check` should always exit with a 0.
