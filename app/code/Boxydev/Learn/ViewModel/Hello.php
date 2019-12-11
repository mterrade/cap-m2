<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Learn\ViewModel;

use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class Hello implements ArgumentInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    public function __construct(
        RequestInterface $request,
        Session $session
    ) {
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->session->getCustomer();
    }

    public function say()
    {
        $name = $this->getRequest()->getParam('name', 'world');

        return __('Hello %1', ucfirst($name));
    }
}
