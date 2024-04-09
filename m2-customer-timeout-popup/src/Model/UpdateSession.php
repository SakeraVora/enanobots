<?php
/**
 * Created by Q-Solutions Studio
 *
 * @category    Nanobots
 * @package     Nanobots_SessionTimeoutPopup
 * @author      Jakub Winkler <jwinkler@qsolutionsstudio.com>
 */

declare(strict_types=1);

namespace Nanobots\SessionTimeoutPopup\Model;

use Magento\Customer\Model\Session;
use Nanobots\SessionTimeoutPopup\Api\UpdateSessionInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class UpdateSession implements UpdateSessionInterface
{
    /**
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        protected Session $customerSession,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * @return void
     */
    public function bulkRequest(): void
    {
        //$customerEmail = $this->customerRepository->getById($customerId)->getEmail();
        //$customer = $this->customerRepository->get($customerEmail); 
        $customer = $this->getCurrentCustomer();               
        $this->customerSession->setCustomerDataAsLoggedIn($customer);
        $this->customerSession->regenerateId();
    }

    public function getCurrentCustomer()
    {
        return $this->customerSession->getCustomer();
    }
}
