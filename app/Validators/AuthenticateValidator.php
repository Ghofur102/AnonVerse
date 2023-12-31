<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Class AuthenticateValidator.
 *
 * @package namespace App\Validators;
 */
class AuthenticateValidator implements ValidatorInterface
{
    /**
     * Validation Rules
     *
     * @var array
     */
    public function validate($data, $rules) {
        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
