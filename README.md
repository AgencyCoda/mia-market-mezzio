# mia-market-mezzio

1. Incluir libreria:
```bash
composer require agencycoda/mia-market-mezzio
```
2. Incluir rutas:
```php

$app->route('/mia-market/product/fetch/{id}', [\Mia\Market\Handler\Product\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_product.fetch');
$app->route('/mia-market/product/fetch-by-slug/{slug}', [\Mia\Market\Handler\Product\FetchSlugHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_product.fetch');
//$app->route('/mia_product/list', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\MiaProduct\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.list');
//$app->route('/mia_product/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\MiaProduct\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_product.remove');
//$app->route('/mia_product/save', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\MiaProduct\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.save');


```