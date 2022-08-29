<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Actions\MonthPeriodQueryAction;
use Validator;

class RentalLogController extends BaseController
{
    /**
     * Get a statistic log data for both rented and returned items.
     *
     * @param int $period_days
     * @param int $period_months
     * @param int $period_years
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function stats(Request $request) {
        $validator = Validator::make($request->all(), [
            'period_years' => 'nullable|numeric',
            'period_months' => 'nullable|numeric',
            'period_days' => 'nullable|numeric',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $period_months = $request->period_months && isset($request->period_months)
            ? (int)$request->period_months : 0;
        $period_years = $request->period_years && isset($request->period_years)
            ? (int)$request->period_years : 0;
        $period_days = $request->period_days && isset($request->period_days)
            ? (int)$request->period_days : 0;

        $success = (new MonthPeriodQueryAction)->execute($period_months, $period_years, $period_days);

        return $this->sendResponse($success, 'Statistic log data retrieved successfully.');
    }
}
