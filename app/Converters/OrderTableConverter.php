<?php

namespace WTG\Converters;


use Carbon\Carbon;
use WTG\Checkout\Entities\Order;
use WTG\Checkout\Entities\OrderItem;
use Doctrine\ORM\EntityManagerInterface;
use WTG\Customer\Repositories\CompanyRepository;

/**
 * Order table converter.
 *
 * @author  Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class OrderTableConverter extends AbstractTableConverter implements TableConverter
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
        'products',
        'User_id',
        'created_at',
        'updated_at',
        'comment',
        'addressId'
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
     * Create the order with the order_items.
     *
     * @param  array  $data
     * @return Order
     */
    public function createEntity(array $data)
    {
        $company = $this->cr->findByCustomerNumber($data['User_id']);

        $order = new Order(
            $company,
            $data['comment'] ?: null,
            Carbon::parse($data['created_at'])
        );

        $items = unserialize($data['products']);

        foreach ($items as $item) {
            dump($item);
            $orderItem = new OrderItem(
                $order,
                $item['id'],
                $item['price'] ?? 0.00,
                $item['qty'],
                $item['subtotal'] ?? 0.00
            );

            $this->em->persist($orderItem);
        }

        return $order;
    }
}