<?php namespace ConorSmith\Goals\Http\Requests;

use ConorSmith\Goals\Http\Requests\Request;
use ConorSmith\Goals\Goal;

class GoalsUpdateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        $goals = Goal::all();

        $rules = [];

        foreach ($goals as $goal) {
            $rules[$goal->slug] = "required|integer";
        }

		return $rules;
	}

}
