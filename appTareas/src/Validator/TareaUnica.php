<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
#[\Attribute] class TareaUnica extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'TareaFixtures con descripción "{{ value }}" existente.';

    /**
     * Con eso indicamos que la validacion se hace a nivel de entidad en lughar de propiedad
     *
     *
     * en la clse poner:  * @AppAssert\TareaUnica
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}