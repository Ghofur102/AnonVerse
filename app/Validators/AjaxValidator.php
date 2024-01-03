<?php

namespace App\Validators;

use App\Contracts\ValidatorInterface;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

/**
 * Class AjaxValidator.
 *
 * @package namespace App\Validators;
 */
class AjaxValidator implements ValidatorInterface
{
    /**
     * Validation Rules
     *
     * @var array
     */
    public function validate($data, $rules) {
        $validator = Validator::make($data, $rules);
        if($validator->fails()) {
            // sama seperti response()->json([..], 422);
            throw new HttpResponseException(response()->json([
                $validator->errors()->first()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }
}
