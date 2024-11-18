<?php

function userColumnVisibilities()
{
    $columnVisibilities = \App\Models\UserColumnVisibility::where([
        'user_id' => auth()->user()->id,
        'url' => request()->fullUrl()
    ])->first();
    if (isset($columnVisibilities->id)) {
        $columns = (!empty($columnVisibilities->columns) && is_array(json_decode($columnVisibilities->columns, true)) ? json_decode($columnVisibilities->columns, true) : []);
        $hidden = [];
        if (isset($columns[0])) {
            foreach ($columns as $key => $column) {
                if ($column == "false") {
                    array_push($hidden, $key);
                }
            }
        }

        return $hidden;
    }

    return [];
}

function pleaseSortMe($query, $order, $orderByQuery)
{
    return $query->when($order == 'asc', function ($query) use ($orderByQuery) {
        return $query->orderBy($orderByQuery);
    })
        ->when($order == 'desc', function ($query) use ($orderByQuery) {
            return $query->orderByDesc($orderByQuery);
        });
}

