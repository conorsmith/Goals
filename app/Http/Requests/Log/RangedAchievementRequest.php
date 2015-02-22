<?php namespace ConorSmith\Goals\Http\Requests\Log;

use ConorSmith\Goals\Http\Requests\Request;

class RangedAchievementRequest extends Request {

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
		return [
			'from_date' => 'required|date_format:Y-m-d',
            'to_date' => 'required|date_format:Y-m-d',
            'name' => 'required',
		];
	}

}
