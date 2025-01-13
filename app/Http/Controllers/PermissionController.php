<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB, DataTables;
use Dotenv\Util\Str;


class PermissionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Permission::query()
            )
            ->addIndexColumn()
            ->addColumn('actions', function($permission){
                return view('actions', [
                    'object' => $permission,
                    'route' => 'permissions',
                ])->render();
            })
            
            
            ->rawColumns(['actions'])
            ->toJson();
        }
        return view('role-permission.permission.index', [
            'title' => 'Permission',
            'headerColumns' => headerColumns('permission')
        ]);
    }

    public function create()
    {
        $data = [
            'modules' =>Permission::groupBy('module')->pluck('module')->toArray(),
        ];
    
        return view('role-permission.permission.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
            ]

        ]);

        $names = array_map('trim', explode(',', $request->name));

        DB::beginTransaction();
        try {
            foreach ($names as $name) {
                if (Permission::where('name', $name)->exists()) {
                    throw new \Exception("The name '{$name}' already exists.");
                }
                Permission::create([
                    'name' => $name,
                    'module' => trim($request->module),
                    'guard_name' => 'web'
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Permissions created successfully',
            ]);
        }
        catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function show(string $id)
    {
        return view('role-permission.permission.show', [
            'permission' => Permission::findOrFail($id)
        ]);
    }


    public function edit(String $id)
    {
        return view('role-permission.permission.edit', [
            'permission' => Permission::findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
            ]
        ]);

        $names = array_map('trim', explode(',', $request->name));

        DB::beginTransaction();
        try {
            foreach ($names as $name) {
                if (Permission::where('name', $name)->exists()) {
                    throw new \Exception("The name '{$name}' already exists.");
                }
            Permission::findOrFail($id)->update($request->only('name'));
            } 

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Permissions created successfully',
            ]);
        }
        catch (\Throwable $th) {
            DB::rollback();

            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try{

            Permission::findOrFail($id)->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
