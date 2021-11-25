# mia-market-mezzio

1. Incluir libreria:
```bash
composer require agencycoda/mia-market-mezzio
```
2. Incluir rutas:
```php

$app->route('/mia-market/product/fetch/{id}', [\Mia\Market\Handler\Product\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_product.fetch');
$app->route('/mia-market/product/fetch-by-slug/{slug}', [\Mia\Market\Handler\Product\FetchSlugHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_product.fetch-by-slug');
$app->route('/mia-market/product/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Product\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.list');
$app->route('/mia-market/product/save', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Middleware\StoreOnlyMiddleware::class, \Mia\Market\Handler\Product\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.save');
//$app->route('/mia_product/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, App\Handler\MiaProduct\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_product.remove');
$app->route('/mia-market/product/reviews/{id}', [\Mia\Market\Handler\Product\ReviewsHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.reviews');
$app->route('/mia-market/product/add-review', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Product\AddReviewHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.add_review');

$app->route('/mia-market/product/questions/{id}', [\Mia\Market\Handler\Product\QuestionsHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.questions');
$app->route('/mia-market/product/add-question', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Product\AddQuestionHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.add_question');
$app->route('/mia-market/product/my-questions', [\Mia\Market\Handler\Product\MyQuestionsHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.my-questions');

$app->route('/mia-market/cart/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.list');
$app->route('/mia-market/cart/remove/{id}/{child_id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'mia_cart.remove');
$app->route('/mia-market/cart/add', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\AddHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.add');
$app->route('/mia-market/cart/minus', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Cart\MinusHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_cart.minus');

$app->route('/mia-market/favorite/toggle/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\ToggleHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'product_favorite.toggle');
$app->route('/mia-market/favorite/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\ListHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'product_favorite.list');
$app->route('/mia-market/favorite/remove/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Favorite\RemoveHandler::class], ['GET', 'DELETE', 'OPTIONS', 'HEAD'], 'product_favorite.remove');

$app->route('/mia-market/store/fetch/{id}', [\Mia\Market\Handler\Store\FetchHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_store.fetch');
$app->route('/mia-market/store/products/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Middleware\StoreOnlyMiddleware::class, \Mia\Market\Handler\Store\ProductsHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_store.products');
$app->route('/mia-market/store/save', [\Mia\Auth\Handler\AuthHandler::class, new \Mia\Auth\Middleware\MiaRoleAuthMiddleware([MIAUser::ROLE_ADMIN]),\Mia\Market\Handler\Store\SaveHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_product.save');

$app->route('/mia-market/store/order/fetch/{id}', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Middleware\StoreOnlyMiddleware::class,\Mia\Market\Handler\Order\FetchByStoreHandler::class], ['GET', 'OPTIONS', 'HEAD'], 'mia_store.order.fetch');
$app->route('/mia-market/store/order/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Middleware\StoreOnlyMiddleware::class, \Mia\Market\Handler\Order\ListByStoreHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_store.order.list');

$app->route('/mia-market/order/list', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Order\ListHandler::class], ['POST', 'OPTIONS', 'HEAD'], 'mia_order.list');

$app->route('/mia-market/payment/testing', [\Mia\Auth\Handler\AuthHandler::class, \Mia\Market\Handler\Payment\TestHandler::class], ['GET', 'POST', 'OPTIONS', 'HEAD'], 'mia_cart.payment.testing');

```