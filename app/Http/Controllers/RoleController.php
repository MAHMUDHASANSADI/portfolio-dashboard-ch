<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB, DataTables;
use Dotenv\Util\Str;


class RoleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            return DataTables::of(
                Role::query()
            )
            ->addIndexColumn()
            ->addColumn('actions', function($role){
                
                return 
                
                '<a href="'.url('role-permissions').'?role_id='.$role->id.'" class="btn btn-success btn-sm">Permission </a>'.view('actions', [
                    'object' => $role,
                    'route' => 'roles',
                ])->render();
            })
            
            
            ->rawColumns(['actions'])
            ->toJson();
        }
        return view('role-permission.role.index', [
            'title' => 'Role',
            'headerColumns' => headerColumns('role')
        ]);
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        $names = array_map('trim', explode(',', $request->name));

        DB::beginTransaction();
        try {
            foreach ($names as $name) {
                if (Role::where('name', $name)->exists()) {
                    throw new \Exception("The name '{$name}' already exists.");
                }
                Role::create([
                    'name' => $name,
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Roles created successfully',
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
        return view('role-permission.role.show', [
            'role' => Role::findOrFail($id)
        ]);
    }


    public function edit(String $id)
    {
        return view('role-permission.role.edit', [
            'role' => Role::findOrFail($id)
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        $names = array_map('trim', explode(',', $request->name));

        DB::beginTransaction();
        try {
            foreach ($names as $name) {
                if (Role::where('name', $name)->exists()) {
                    throw new \Exception("The name '{$name}' already exists.");
                }
            Role::findOrFail($id)->update($request->only('name'));
            }
            

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Roles created successfully',
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

            Role::findOrFail($id)->delete();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Roles deleted successfully.'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function addRoletoPermission(Request $request, string $id)
    {

    }
}
