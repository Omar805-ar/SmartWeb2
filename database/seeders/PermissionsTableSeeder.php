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
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'shipping_management_access',
            ],
            [
                'id'    => 19,
                'title' => 'country_create',
            ],
            [
                'id'    => 20,
                'title' => 'country_edit',
            ],
            [
                'id'    => 21,
                'title' => 'country_show',
            ],
            [
                'id'    => 22,
                'title' => 'country_delete',
            ],
            [
                'id'    => 23,
                'title' => 'country_access',
            ],
            [
                'id'    => 24,
                'title' => 'government_create',
            ],
            [
                'id'    => 25,
                'title' => 'government_edit',
            ],
            [
                'id'    => 26,
                'title' => 'government_show',
            ],
            [
                'id'    => 27,
                'title' => 'government_delete',
            ],
            [
                'id'    => 28,
                'title' => 'government_access',
            ],
            [
                'id'    => 29,
                'title' => 'product_management_access',
            ],
            [
                'id'    => 30,
                'title' => 'category_create',
            ],
            [
                'id'    => 31,
                'title' => 'category_edit',
            ],
            [
                'id'    => 32,
                'title' => 'category_show',
            ],
            [
                'id'    => 33,
                'title' => 'category_delete',
            ],
            [
                'id'    => 34,
                'title' => 'category_access',
            ],
            [
                'id'    => 35,
                'title' => 'color_create',
            ],
            [
                'id'    => 36,
                'title' => 'color_edit',
            ],
            [
                'id'    => 37,
                'title' => 'color_show',
            ],
            [
                'id'    => 38,
                'title' => 'color_delete',
            ],
            [
                'id'    => 39,
                'title' => 'color_access',
            ],
            [
                'id'    => 40,
                'title' => 'size_create',
            ],
            [
                'id'    => 41,
                'title' => 'size_edit',
            ],
            [
                'id'    => 42,
                'title' => 'size_show',
            ],
            [
                'id'    => 43,
                'title' => 'size_delete',
            ],
            [
                'id'    => 44,
                'title' => 'size_access',
            ],
            [
                'id'    => 45,
                'title' => 'product_create',
            ],
            [
                'id'    => 46,
                'title' => 'product_edit',
            ],
            [
                'id'    => 47,
                'title' => 'product_show',
            ],
            [
                'id'    => 48,
                'title' => 'product_delete',
            ],
            [
                'id'    => 49,
                'title' => 'product_access',
            ],
            [
                'id'    => 50,
                'title' => 'merchant_create',
            ],
            [
                'id'    => 51,
                'title' => 'merchant_edit',
            ],
            [
                'id'    => 52,
                'title' => 'merchant_show',
            ],
            [
                'id'    => 53,
                'title' => 'merchant_delete',
            ],
            [
                'id'    => 54,
                'title' => 'merchant_access',
            ],
            [
                'id'    => 55,
                'title' => 'merchant_management_access',
            ],
            [
                'id'    => 56,
                'title' => 'penalty_create',
            ],
            [
                'id'    => 57,
                'title' => 'penalty_edit',
            ],
            [
                'id'    => 58,
                'title' => 'penalty_show',
            ],
            [
                'id'    => 59,
                'title' => 'penalty_delete',
            ],
            [
                'id'    => 60,
                'title' => 'penalty_access',
            ],
            [
                'id'    => 61,
                'title' => 'setting_create',
            ],
            [
                'id'    => 62,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 63,
                'title' => 'setting_show',
            ],
            [
                'id'    => 64,
                'title' => 'setting_delete',
            ],
            [
                'id'    => 65,
                'title' => 'setting_access',
            ],
            [
                'id'    => 66,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 67,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 68,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 69,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 70,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 71,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 72,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 73,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 74,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 75,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 76,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 77,
                'title' => 'contact_management_access',
            ],
            [
                'id'    => 78,
                'title' => 'contact_company_create',
            ],
            [
                'id'    => 79,
                'title' => 'contact_company_edit',
            ],
            [
                'id'    => 80,
                'title' => 'contact_company_show',
            ],
            [
                'id'    => 81,
                'title' => 'contact_company_delete',
            ],
            [
                'id'    => 82,
                'title' => 'contact_company_access',
            ],
            [
                'id'    => 83,
                'title' => 'contact_contact_create',
            ],
            [
                'id'    => 84,
                'title' => 'contact_contact_edit',
            ],
            [
                'id'    => 85,
                'title' => 'contact_contact_show',
            ],
            [
                'id'    => 86,
                'title' => 'contact_contact_delete',
            ],
            [
                'id'    => 87,
                'title' => 'contact_contact_access',
            ],
            [
                'id'    => 88,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 89,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 90,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 91,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 92,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 93,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 94,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 95,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 96,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 97,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 98,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 99,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 100,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 101,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 102,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 103,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 104,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 105,
                'title' => 'user_alert_edit',
            ],
            [
                'id'    => 106,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 107,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 108,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 109,
                'title' => 'order_create',
            ],
            [
                'id'    => 110,
                'title' => 'order_edit',
            ],
            [
                'id'    => 111,
                'title' => 'order_show',
            ],
            [
                'id'    => 112,
                'title' => 'order_delete',
            ],
            [
                'id'    => 113,
                'title' => 'order_access',
            ],
            [
                'id'    => 114,
                'title' => 'settings_management_access',
            ],
            [
                'id'    => 115,
                'title' => 'bonu_create',
            ],
            [
                'id'    => 116,
                'title' => 'bonu_edit',
            ],
            [
                'id'    => 117,
                'title' => 'bonu_show',
            ],
            [
                'id'    => 118,
                'title' => 'bonu_delete',
            ],
            [
                'id'    => 119,
                'title' => 'bonu_access',
            ],
            [
                'id'    => 120,
                'title' => 'training_management_access',
            ],
            [
                'id'    => 121,
                'title' => 'training_category_create',
            ],
            [
                'id'    => 122,
                'title' => 'training_category_edit',
            ],
            [
                'id'    => 123,
                'title' => 'training_category_show',
            ],
            [
                'id'    => 124,
                'title' => 'training_category_delete',
            ],
            [
                'id'    => 125,
                'title' => 'training_category_access',
            ],
            [
                'id'    => 126,
                'title' => 'training_create',
            ],
            [
                'id'    => 127,
                'title' => 'training_edit',
            ],
            [
                'id'    => 128,
                'title' => 'training_show',
            ],
            [
                'id'    => 129,
                'title' => 'training_delete',
            ],
            [
                'id'    => 130,
                'title' => 'training_access',
            ],
            [
                'id'    => 131,
                'title' => 'ticket_management_access',
            ],
            [
                'id'    => 132,
                'title' => 'ticket_category_create',
            ],
            [
                'id'    => 133,
                'title' => 'ticket_category_edit',
            ],
            [
                'id'    => 134,
                'title' => 'ticket_category_show',
            ],
            [
                'id'    => 135,
                'title' => 'ticket_category_delete',
            ],
            [
                'id'    => 136,
                'title' => 'ticket_category_access',
            ],
            [
                'id'    => 137,
                'title' => 'ticket_create',
            ],
            [
                'id'    => 138,
                'title' => 'ticket_edit',
            ],
            [
                'id'    => 139,
                'title' => 'ticket_show',
            ],
            [
                'id'    => 140,
                'title' => 'ticket_delete',
            ],
            [
                'id'    => 141,
                'title' => 'ticket_access',
            ],
            [
                'id'    => 142,
                'title' => 'supplier_create',
            ],
            [
                'id'    => 143,
                'title' => 'supplier_edit',
            ],
            [
                'id'    => 144,
                'title' => 'supplier_show',
            ],
            [
                'id'    => 145,
                'title' => 'supplier_delete',
            ],
            [
                'id'    => 146,
                'title' => 'supplier_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
