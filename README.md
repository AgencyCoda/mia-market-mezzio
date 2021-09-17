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

$app->route('/mia-market/cart/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.list');
$app->route('/mia-market/cart/remove/{id}/{child_id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_cart.remove');
$app->route('/mia-market/cart/add', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\AddHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.add');
$app->route('/mia-market/cart/minus', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\MinusHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.minus');

$app->route('/mia-market/favorite/toggle/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\ToggleHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'product_favorite.toggle');
$app->route('/mia-market/favorite/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\ListHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'product_favorite.list');
$app->route('/mia-market/favorite/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'product_favorite.remove');

```