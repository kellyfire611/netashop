<?php
use Illuminate\Support\Facades\DB;

/*
-- 1. Cổ điển: truy vấn SQL
-- 2. Gate: cổng kiểm tra
-- 3. Policy: phân quyền

-- RAW SQL Query
-- 1. Lấy các quyền theo vai trò
SELECT p.id, p.name
FROM acl_users u
	JOIN acl_user_has_roles uhr ON uhr.user_id = u.id
	JOIN acl_role_has_permissions rhp ON uhr.role_id = rhp.role_id
	JOIN acl_permissions p ON rhp.permission_id = p.id
WHERE email = 'bhunterj@ucsd.edu'
	AND p.`name` = 'shop_posts::view'

UNION ALL

-- 2. Lấy các quyền đặc thù
SELECT p.id, p.name
FROM acl_users u
	JOIN acl_user_has_permissions uhp ON uhp.user_id = u.id
	JOIN acl_permissions p ON uhp.permission_id = p.id
WHERE email = 'bhunterj@ucsd.edu'
	AND p.`name` = 'shop_posts::view';	
	

*/
function netaHasPermission($user, $permission)
{
  // dd($user, $permission);
  $result1 = 0;
  $result2 = 0;
  $result = 0;
  $email = $user->email;

  // 1. Lấy các quyền theo vai trò
  $result1 = DB::table('acl_users')
    ->join('acl_user_has_roles', 'acl_user_has_roles.user_id', '=', 'acl_users.id')
    ->join('acl_role_has_permissions', 'acl_user_has_roles.role_id', '=', 'acl_role_has_permissions.role_id')
    ->join('acl_permissions', 'acl_role_has_permissions.permission_id', '=', 'acl_permissions.id')
    ->where('acl_users.email', '=', $email)
    ->where('acl_permissions.name', '=', $permission)
    ->count();

  if ($result1 <= 0) {
    // 2. Lấy các quyền đặc thù
    $result2 = DB::table('acl_users')
      ->join('acl_user_has_permissions', 'acl_user_has_permissions.user_id', '=', 'acl_users.id')
      ->join('acl_permissions', 'acl_user_has_permissions.permission_id', '=', 'acl_permissions.id')
      ->where('acl_users.email', '=', $email)
      ->where('acl_permissions.name', '=', $permission)
      ->count();
  }

  $result = $result1 + $result2;

  $hasPermission = $result > 0;
  // dd($result, $hasPermission);
  return $hasPermission;
}
