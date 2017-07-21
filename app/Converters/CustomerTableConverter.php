<?php

namespace WTG\Converters;

use WTG\Customer\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use WTG\Customer\Repositories\CompanyRepository;

/**
 * Customer table converter.
 *
 * @package     WTG\Converters
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class CustomerTableConverter extends AbstractTableConverter
{
    /**
     * @var CompanyRepository
     */
    protected $cr;

    /**
     * @var array
     */
    protected $csvFields = [
        'id',
        'username',
        'company_id',
        'email',
        'isAdmin',
        'manager',
        'password',
        'favorites',
        'cart',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * CustomerTableConverter constructor.
     *
     * @param  EntityManagerInterface  $em
     * @param  CompanyRepository  $cr
     */
    public function __construct(EntityManagerInterface $em, CompanyRepository $cr)
    {
        parent::__construct($em);

        $this->cr = $cr;
    }

    /**
     * Create a new entity.
     *
     * @param  array  $data
     * @return Customer
     */
    public function createEntity(array $data)
    {
        $company = $this->cr->findByCustomerNumber($data['company_id']);

        return new Customer(
            $company,
            $data['username'],
            $data['password'],
            $data['email'],
            $this->determineRole($data)
        );
    }

    /**
     * Determine the role of the customer.
     *
     * @param  array  $data
     * @return string
     */
    private function determineRole(array $data)
    {
        if ($data['company_id'] === $data['username']) {
            return Customer::CUSTOMER_ROLE_ADMIN;
        }

        if ($data['manager'] === "1") {
            return Customer::CUSTOMER_ROLE_MANAGER;
        }

        if ($data['manager'] === "0") {
            return Customer::CUSTOMER_ROLE_USER;
        }
    }
}