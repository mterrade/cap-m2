<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\Controller;

use Boxydev\Learn\Controller\Hello\World;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class BoxydevRouter implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private $actionFactory;

    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    public function match(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');

        if (false !== strpos($identifier, 'boxydev/hello/')) {
            $name = str_replace('boxydev/hello/', '', $identifier);

            $request
                ->setRouteName('boxydev')
                ->setControllerName('hello')
                ->setActionName('world')
                ->setParam('name', $name);
        } else {
            return null;
        }

        return $this->actionFactory->create(World::class);
    }
}
