# Address Abbreviation

Abbreviate address parts while maintaining their meaning to accommodate systems that are limited in the address length.  

## Installation

```bash
composer require dmt-software/address-abbreviation
```

## Usage

```php
use DMT\Address\Abbreviation\Dutch\Street\TypeNameAbbreviator;

$abbreviator = new TypeNameAbbreviator();
print $abbreviator->abbreviate('Jan Maurits van Nassaustraat'); 

// outputs: Jan Maurits van Nassaustr
```

### Configured sets

```php
use DMT\Address\Abbreviation\AbbreviationGroupFactory;

$abbreviator = (new AbbreviationGroupFactory())->getNen5825AbbreviationGroup();
print $abbreviator->abbreviate('Burgemeester W. van Eertenstraat');

// outputs: Burg W van Eertenstraat (according to NEN 5825:2002)
```
