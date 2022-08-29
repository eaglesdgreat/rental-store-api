<?php

namespace App\Http\Controllers\Equipments;

use Validator;
use Carbon\Carbon;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Http\Resources\EquipmentsResource;
use App\Http\Controllers\BaseController;

class EquipmentsController extends BaseController
{
    /**
     * Display list of all equipments resources
     *
     * @return \Illuminate\Http\Response
     */
    public function listEquipments() {
        $equipments = Equipment::with('rented')->get();

        return $this->sendResponse(EquipmentsResource::collection($equipments), 'Equipments retrieved successfully.');
    }

    /**
     * Get an equipment resources
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getEquipment($id) {
        $equipment = Equipment::where('id', $id)->with('rented')->firstOrFail();

        return $this->sendResponse(new EquipmentsResource($equipment), 'Equipment data retrieved successfully.');
    }

    /**
     * Create a new equipment resource in storage
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'type' => 'required|string',
            'condition' => 'nullable|string',
            'weight' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $equipment = Equipment::create($input);

        return $this->sendResponse(new EquipmentsResource($equipment), 'Equipment created successfully.', 201);
    }

    /**
     * Update an equipment resource in storage
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'color' => 'required|string',
            'type' => 'required|string',
            'condition' => 'nullable|string',
            'weight' => 'nullable|string',
            'is_rented' => 'nullable|boolean',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $equipment = Equipment::find($id);

        $equipment->name = $input['name'];
        $equipment->color = $input['color'];
        $equipment->type = $input['type'];
        $equipment->condition = $input['condition'] ? $input['condition'] : $equipment->condition;
        $equipment->weight = $input['weight'] ? $input['weight'] : $equipment->weight;
        $equipment->is_rented = $input['is_rented'] ? $input['is_rented'] : $equipment->is_rented;
        $equipment->updated_at = Carbon::now();
        $equipment->save();

        return $this->sendResponse(new EquipmentsResource($equipment), 'Equipment updated successfully.');
    }

    /**
     * Remove the specified equipment resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment, $id)
    {
        $equipment::where('id', $id)->delete();

        return $this->sendResponse([], 'Equipment deleted successfully.');
    }
}
