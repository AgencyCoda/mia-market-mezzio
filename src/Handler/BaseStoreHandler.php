<?php

namespace Mia\Market\Handler;

use Mia\Market\Model\MiaStore;

abstract class BaseStoreHandler extends \Mia\Auth\Request\MiaAuthRequestHandler
{
    /**
     * @var MiaStore
     */
    protected $store;

    protected function initStore(\Psr\Http\Message\ServerRequestInterface $request)
    {
        $this->store = $this->getStore($request);
    }
    /**
     * 
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @return MiaStore
     */
    protected function getStore(\Psr\Http\Message\ServerRequestInterface $request)
    {
        return $request->getAttribute(MiaStore::class);
    }
}