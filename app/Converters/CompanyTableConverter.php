<?php

namespace WTG\Converters;

use WTG\Customer\Entities\Company;

/**
 * Company table converter.
 *
 * @package     WTG\Converters
 * @author      Thomas Wiringa  <thomas.wiringa@gmail.com>
 */
class CompanyTableConverter extends AbstractTableConverter
{
    /**
     * @var array
     */
    protected $csvFields = [
        'id',
        'login',
        'company',
        'street',
        'postcode',
        'city',
        'email',
        'active',
        'created_at',
        'updated_at'
    ];

    /**
     * Create a new entity.
     *
     * @param  array  $data
     * @return Company
     */
    public function createEntity(array $data)
    {
        return new Company(
            $data['login'],
            $data['company'],
            $data['street'],
            $data['postcode'],
            $data['city'],
            $data['active'],
            (bool) ($data['deleted_at'] ?? false)
        );
    }
}