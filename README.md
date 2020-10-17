# Bushido PHP Foundation

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what
PSRs you support to avoid any confusion with users and contributors.

## Install
Via Composer
``` bash
$ composer require code-bushido/foundation
```

## Table of Contents
### Contracts
- [Arrayable](src/Contracts/Arrayable.php)
- [EntityInterface](src/Contracts/EntityInterface.php)
- [Indexable](src/Contracts/Indexable.php)
- [Jsonable](src/Contracts/Jsonable.php)
- [Makeable](src/Contracts/Makeable.php)
- [Persistable](src/Contracts/Persistable.php)

### Exceptions
- [Exception](src/Exception.php)
- [InvalidArgumentException](src/Exceptions/InvalidArgumentException.php)

### Smart Entity
**Smart Entity** concept is a powerful implementation of getters and setters entity concept.  [See more](doc/SmartEntity.md)

### Helpers
- [PsrLoggerTrait](src/Helpers/PsrLoggerTrait.php) - provides base support for optional PSR Logger Interface implementation

## Change log
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email wnowicki@me.com instead of using the issue tracker.

## Credits
- [Wojciech Nowicki][link-author]
- [All Contributors][link-contributors]

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/code-bushido/foundation.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/code-bushido/foundation/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/code-bushido/foundation.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/code-bushido/foundation.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/code-bushido/foundation.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/code-bushido/foundation
[link-travis]: https://travis-ci.org/code-bushido/foundation
[link-scrutinizer]: https://scrutinizer-ci.com/g/code-bushido/foundation/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/code-bushido/foundation
[link-downloads]: https://packagist.org/packages/code-bushido/foundation
[link-author]: https://github.com/wnowicki
[link-contributors]: ../../contributors
