<?php
namespace App\Actions;
use Illuminate\Support\Facades\DB;

class MonthPeriodQueryAction {
    /**
     * Get a statistic calculation for time period
     *
     * @param int $period_months
     * @param int $period_years
     * @param int $period_days
     * @return array
     */
    public function execute($period_months, $period_years, $period_days) {
        // Rented Query
        $query['total_equipments_rented']  = DB::select(
            "SELECT COUNT(equipment_id) AS 'equipments_rented' FROM rents WHERE equipment_id IS NOT NULL
                AND (
                    rented_date > DATE_SUB(now(), INTERVAL ? MONTH) OR
                    rented_date > DATE_SUB(now(), INTERVAL ? YEAR) OR
                    rented_date > DATE_SUB(now(), INTERVAL ? DAY)
                )",
            [$period_months, $period_years, $period_days]
        )[0];

        $query['total_books_rented']  = DB::select(
            "SELECT COUNT(book_id) AS 'books_rented' FROM rents WHERE book_id IS NOT NULL
                AND (
                    rented_date > DATE_SUB(now(), INTERVAL ? MONTH) OR
                    rented_date > DATE_SUB(now(), INTERVAL ? YEAR) OR
                    rented_date > DATE_SUB(now(), INTERVAL ? DAY)
                )",
            [$period_months, $period_years, $period_days]
        )[0];

        // Returned Query
        $query['total_equipments_returned']  = DB::select(
            "SELECT COUNT(equipment_id) AS 'equipments_returned' FROM rents WHERE equipment_id IS NOT NULL
                AND is_returned = 1 AND (
                    date_returned > DATE_SUB(now(), INTERVAL ? MONTH) OR
                    date_returned > DATE_SUB(now(), INTERVAL ? YEAR) OR
                    date_returned > DATE_SUB(now(), INTERVAL ? DAY)
                )",
            [$period_months, $period_years, $period_days]
        )[0];

        $query['total_books_returned']  = DB::select(
            "SELECT COUNT(book_id) AS 'books_returned' FROM rents WHERE book_id IS NOT NULL
                AND is_returned = 1 AND (
                    date_returned > DATE_SUB(now(), INTERVAL ? MONTH) OR
                    date_returned > DATE_SUB(now(), INTERVAL ? YEAR) OR
                    date_returned > DATE_SUB(now(), INTERVAL ? DAY)
                )",
            [$period_months, $period_years, $period_days]
        )[0];

        $success['total_books_rented'] = $query['total_books_rented']->books_rented;
        $success['total_books_returned'] = $query['total_books_returned']->books_returned;
        $success['total_equipments_rented'] = $query['total_equipments_rented']->equipments_rented;
        $success['total_equipments_returned'] = $query['total_equipments_returned']->equipments_returned;

        return $success;
    }
}
