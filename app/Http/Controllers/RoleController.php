<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function syncPermissions(Request $request, $roleId)
    {
        $role = Role::findOrFail($roleId);

        // Validação para garantir que as permissões foram enviadas corretamente
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Sincronizar as permissões da role
        $role->permissions()->sync($request->permissions);

        return response()->json(['message' => 'Permissões atualizadas com sucesso', 'role' => $role]);
    }
}
