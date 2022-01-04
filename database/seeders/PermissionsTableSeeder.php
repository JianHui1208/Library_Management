<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
                'type'  => 'Management'
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
                'type'  => 'Permission'
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
                'type'  => 'Permission'
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
                'type'  => 'Permission'
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
                'type'  => 'Permission'
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
                'type'  => 'Permission'
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
                'type'  => 'Role'
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
                'type'  => 'Role'
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
                'type'  => 'Role'
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
                'type'  => 'Role'
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
                'type'  => 'Role'
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
                'type'  => 'User'
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
                'type'  => 'User'
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
                'type'  => 'User'
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
                'type'  => 'User'
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
                'type'  => 'User'
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
                'type'  => 'Management'
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
                'type'  => 'Management'
            ],
            [
                'id'    => 19,
                'title' => 'book_category_create',
                'type'  => 'BookCategory'
            ],
            [
                'id'    => 20,
                'title' => 'book_category_edit',
                'type'  => 'BookCategory'
            ],
            [
                'id'    => 21,
                'title' => 'book_category_show',
                'type'  => 'BookCategory'
            ],
            [
                'id'    => 22,
                'title' => 'book_category_delete',
                'type'  => 'BookCategory'
            ],
            [
                'id'    => 23,
                'title' => 'book_category_access',
                'type'  => 'BookCategory'
            ],
            [
                'id'    => 24,
                'title' => 'book_management_menu_access',
                'type'  => 'BookList'
            ],
            [
                'id'    => 25,
                'title' => 'book_list_create',
                'type'  => 'BookList'
            ],
            [
                'id'    => 26,
                'title' => 'book_list_edit',
                'type'  => 'BookList'
            ],
            [
                'id'    => 27,
                'title' => 'book_list_show',
                'type'  => 'BookList'
            ],
            [
                'id'    => 28,
                'title' => 'book_list_delete',
                'type'  => 'BookList'
            ],
            [
                'id'    => 29,
                'title' => 'book_list_access',
                'type'  => 'BookList'
            ],
            [
                'id'    => 30,
                'title' => 'book_tag_create',
                'type'  => 'BookTag'
            ],
            [
                'id'    => 31,
                'title' => 'book_tag_edit',
                'type'  => 'BookTag'
            ],
            [
                'id'    => 32,
                'title' => 'book_tag_show',
                'type'  => 'BookTag'
            ],
            [
                'id'    => 33,
                'title' => 'book_tag_delete',
                'type'  => 'BookTag'
            ],
            [
                'id'    => 34,
                'title' => 'book_tag_access',
                'type'  => 'BookTag'
            ],
            [
                'id'    => 35,
                'title' => 'system_setting_create',
                'type'  => 'SystemSetting'
            ],
            [
                'id'    => 36,
                'title' => 'system_setting_edit',
                'type'  => 'SystemSetting'
            ],
            [
                'id'    => 37,
                'title' => 'system_setting_show',
                'type'  => 'SystemSetting'
            ],
            [
                'id'    => 38,
                'title' => 'system_setting_delete',
                'type'  => 'SystemSetting'
            ],
            [
                'id'    => 39,
                'title' => 'system_setting_access',
                'type'  => 'SystemSetting'
            ],
            [
                'id'    => 40,
                'title' => 'question_create',
                'type'  => 'Question'
            ],
            [
                'id'    => 41,
                'title' => 'question_edit',
                'type'  => 'Question'
            ],
            [
                'id'    => 42,
                'title' => 'question_show',
                'type'  => 'Question'
            ],
            [
                'id'    => 43,
                'title' => 'question_delete',
                'type'  => 'Question'
            ],
            [
                'id'    => 44,
                'title' => 'question_access',
                'type'  => 'Question'
            ],
            [
                'id'    => 45,
                'title' => 'profile_password_edit',
                'type'  => 'Management'
            ],
            [
                'id'    => 46,
                'title' => 'laravel_passport_create', 
                'type'  => 'Laravel Passport'
            ],
            [
                'id'    => 47,
                'title' => 'laravel_passport_edit', 
                'type'  => 'Laravel Passport'
            ],
            [
                'id'    => 48,
                'title' => 'laravel_passport_show', 
                'type'  => 'Laravel Passport'
            ],
            [
                'id'    => 49,
                'title' => 'laravel_passport_delete', 
                'type'  => 'Laravel Passport'
            ],
            [
                'id'    => 50,
                'title' => 'laravel_passport_access', 
                'type'  => 'Laravel Passport'
            ],
            [
                'id'    => 51,
                'title' => 'book_loan_create',
                'type'  => 'book_loan'
            ],
            [
                'id'    => 52,
                'title' => 'book_loan_edit',
                'type'  => 'book_loan'
            ],
            [
                'id'    => 53,
                'title' => 'book_loan_show',
                'type'  => 'book_loan'
            ],
            [
                'id'    => 54,
                'title' => 'book_loan_delete',
                'type'  => 'book_loan'
            ],
            [
                'id'    => 55,
                'title' => 'book_loan_access',
                'type'  => 'book_loan'
            ],
            [
                'id'    => 56,
                'title' => 'content_management_create',
                'type'  => 'content_management'
            ],
            [
                'id'    => 57,
                'title' => 'content_management_edit',
                'type'  => 'content_management'
            ],
            [
                'id'    => 58,
                'title' => 'content_management_show',
                'type'  => 'content_management'
            ],
            [
                'id'    => 59,
                'title' => 'content_management_delete',
                'type'  => 'content_management'
            ],
            [
                'id'    => 60,
                'title' => 'content_management_access',
                'type'  => 'content_management'
            ],
        ];

        Permission::insert($permissions);
    }
}
