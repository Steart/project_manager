<?php

namespace App\Tests\Form\Type;

use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Class AddressTypeTest
 * @package App\Tests\Form\Type
 */
class AddressTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = [
            'street_name' => null,
            'house_number' => 1,
            'house_number_addition' => null,
            'postal_code' => null,
            'city' => null,
            'country' => null,
        ];

        $objectToCompare = new Address();
        // $objectToCompare will retrieve data from the form submission; pass it as the second argument
        $form = $this->factory->create(AddressType::class, $objectToCompare);

        $object = (new Address())->setHouseNumber(1);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        // check that $objectToCompare was modified as expected when the form was submitted
        $this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
