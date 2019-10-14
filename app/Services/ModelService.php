<?php

namespace App\Services;

class ModelService
{
    public $className;

    /**
     * Get a model instance by ID. Models must have the $className property set
     * via a construct method for this to work.
     *
     * @param int|array|mixed $modelIds
     * @return void
     */
    public function getById($modelIds)
    {
        if (!is_iterable($modelIds)) {
            $modelIds = [$modelIds];
        }

        $modelRecords = collect();

        foreach ($modelIds as $modelId) {
            $modelRecords->push($this->className::where('id', $modelId)->first());
        }

        if (count($modelRecords) > 1) {
            return $modelRecords;
        }

        return $modelRecords->first();
    }

    public function all()
    {
        $records = $this->className::all()->sortBy('name');

        return $records;
    }

    public function deleteById($modelIds)
    {
        if (!is_iterable($modelIds)) {
            $modelIds = [$modelIds];
        }

        $modelRecords = collect();

        foreach ($modelIds as $modelId) {
            $record = $this->className::where('id', $modelId)->first();

            if ($record) {
                $modelRecords->push($record);
                $record->delete();
            }
        }

        if (count($modelRecords) > 1) {
            return $modelRecords;
        }

        return $modelRecords->first();
    }

    public function update($request)
    {
        $newName = $request->input('name');
        $newContent = $request->input('content');
        $modelId = $request->input('record_id');

        $record = $this->className::where('id', $modelId)->first();

        $record->name = $newName;
        $record->content = $newContent;

        $record->save();
    }
}
