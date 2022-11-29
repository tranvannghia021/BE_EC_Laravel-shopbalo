<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        sleep(1);
        $permission = DB::table('permissions')->get()->toArray();

        $data = [
            [
                'id' => 1,
                'name' => 'Admin',
                'permission_id' => []

            ],
            [
                'id' => 2,
                'name' => 'WareHouses',
                'permission_id' => []

            ],
        ];
        if (!is_null($permission)) {
            foreach ($data as $key => $item) {
                foreach ($permission as $per) {

                    if (strpos($per->name, 'Admin') !== false && $item['name'] == 'Admin') {

                        array_push($data[$key]['permission_id'], $per->id);
                    } else if (strpos($per->name, 'Client') !== false && $item['name'] == 'Client') {

                        array_push($data[$key]['permission_id'], $per->id);
                    } else if ($item['name'] == 'User' || $item['name'] == '') {
                        array_push($data[$key]['permission_id'], $per->id);
                    }
                }
            }
        }
        foreach ($data as $item) {
            $roleId = DB::table('roles')->insertGetId([
                'name' => $item['name'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            foreach ($item['permission_id'] as $role) {
                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'permission_id' => $role,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
