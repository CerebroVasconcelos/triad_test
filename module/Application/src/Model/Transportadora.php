<?php

namespace Application\Model;

use DomainException;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Transportadora
{
    public  $id;

    public  $city;

    public  $name;

    public  $freight_air;
    public  $freight_earthly;
    public  $freight_water;

    private $inputFilter;

    public function exchangeArray(array $data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->city = (!empty($data['city'])) ? $data['city'] : null;
        $this->name  = (!empty($data['name'])) ? $data['name'] : null;
        $this->freight_air  = (!empty($data['freight_air'])) ? $data['freight_air'] : null;
        $this->freight_earthly  = (!empty($data['freight_earthly'])) ? $data['freight_earthly'] : null;
        $this->freight_water  = (!empty($data['freight_water'])) ? $data['freight_water'] : null;
    }

    public function getArrayCopy()
    {
        return [
            'id'     => $this->id,
            'city' => $this->city,
            'name'  => $this->name,
            'freight_air'  => $this->freight_air,
            'freight_earthly'  => $this->freight_earthly,
            'freight_water'  => $this->freight_water,
        ];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new DomainException(sprintf(
            '%s does not allow injection of an alternate input filter',
            __CLASS__
        ));
    }

    public function getInputFilter()
    {
        if ($this->inputFilter) {
            return $this->inputFilter;
        }

        $inputFilter = new InputFilter();

        $inputFilter->add([
            'name'     => 'id',
            'required' => true,
            'filters'  => [
                ['name' => 'int'],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'city',
            'required'   => true,
            'filters'    => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'name',
            'required'   => true,
            'filters'    => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 100,
                    ],
                ],
            ],
        ]);

        $this->inputFilter = $inputFilter;

        return $this->inputFilter;
    }
}
