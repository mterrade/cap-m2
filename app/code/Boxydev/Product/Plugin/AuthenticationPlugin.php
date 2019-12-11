<?php

/*
 * This file is part of the magento.com package.
 *
 * (c) Matthieu Mota <matthieu@boxydev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Boxydev\Product\Plugin;

use Magento\Customer\Model\Authentication;
use Magento\Customer\Model\CustomerRegistry;
use Psr\Log\LoggerInterface;

class AuthenticationPlugin
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CustomerRegistry
     */
    private $customerRegistry;

    public function __construct(LoggerInterface $logger, CustomerRegistry $customerRegistry)
    {
        $this->logger = $logger;
        $this->customerRegistry = $customerRegistry;
    }

    public function afterAuthenticate(\Magento\Customer\Model\Authentication $subject, $result, $customerId)
    {
        $customer = $this->customerRegistry->retrieve($customerId);
        $this->logger->debug('Connexion de ' . $customer->getEmail(), ['customer' => $customer]);

        return $result;
    }
}
