# Isbn-Ean

picture ISBN, EAN code transfer.

## Using

```bash
composer require islenbo/isbn-ean
```

EAN code to ISBN code
```php
list($isbn, $err) = Transfer::getInstance()->ean2Isbn($ean);
```

ISBN code to EAN code
```php
list($ean, $err) = Transfer::getInstance()->isbn2Ean($isbn);
```
