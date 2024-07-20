<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'الاسم',
            'title_helper'      => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'permissions'        => 'الصلاحيات',
            'permissions_helper' => ' ',
            'title'             => 'الاسم',
            'title_helper'      => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
        ],
    ],
    'user' => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'الاسم',
            'name_helper'              => ' ',
            'email'                    => 'البريد الالكتروني',
            'email_helper'             => ' ',
            'email_verified_at'        => 'تم تفعيل البريد الاكتروني في',
            'email_verified_at_helper' => ' ',
            'password'                 => 'كلمة المرور',
            'password_helper'          => ' ',
            'roles'                    => 'المجموعات',
            'roles_helper'             => ' ',
            'remember_token'           => 'كود التذكر',
            'remember_token_helper'    => ' ',
            'locale'                   => 'اللغة',
            'locale_helper'            => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        ],
    ],
    'shippingManagement' => [
        'title'          => 'إدارة الشحن',
        'title_singular' => 'إدارة الشحن',
    ],
    'country' => [
        'title'          => 'الدول',
        'title_singular' => 'الدولة',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'iso'                  => 'Iso',
            'iso_helper'           => ' ',
            'currency_code'        => 'العملة',
            'currency_code_helper' => ' ',
            'flag'                 => 'العلم',
            'flag_helper'          => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        ],
    ],
    'government' => [
        'title'          => 'المحافظات',
        'title_singular' => 'المحافظة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'country'           => 'الدولة',
            'country_helper'    => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
            'shipping_cost'             => 'تكلفة الشحن',
            'shipping_cost_helper'      => ' ',

        ],
    ],
    'productManagement' => [
        'title'          => 'إدارة المنتجات',
        'title_singular' => 'إدارة المنتجات',
    ],
    'category' => [
        'title'          => 'التصنيفات',
        'title_singular' => 'التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'slug'              => 'الرابط',
            'slug_helper'       => ' ',

            'icon'              => 'الايقونه',
            'icon_helper'       => ' ضع ايقونة من icons.getbootstrap.com مثال : <i class="bi bi-1-circle"></i> ',


            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'color' => [
        'title'          => 'الألوان',
        'title_singular' => 'اللون',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'hex'               => 'Hex',
            'hex_helper'        => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        
        ],
    ],
    'size' => [
        'title'          => 'المقاسات',
        'title_singular' => 'المقاس',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'size'              => 'المقاس',
            'size_helper'       => ' ',

            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
            
        ],
    ],
    'product' => [
        'title'          => 'المنتجات',
        'title_singular' => 'المنتج',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'category_id'              => 'التصنيف',
            'category'              => 'التصنيف',
            'category_helper'       => ' ',
            'country'               => 'الدولة',
            'country_id'               => 'الدولة',
            'country_helper'        => ' ',
            'price'                 => 'السعر',
            'price_helper'          => ' ',
            'slug'                  => 'الرابط',
            'slug_helper'           => ' ',
            'product_code'          => 'كود المنتج',
            'product_code_helper'   => ' ملحوظة : لا يمكن تغير الكود فيما بعد ، اذا تركت الحقل فارغ سيتم توليد كود تلقائي ',
            'colors'                => 'الالوان',
            'colors_helper'         => ' ',

            'preview_image_product'                 => 'الصورة المصغرة',
            'preview_image_product_helper'          => ' ',

            'sizes'                 => 'المقاسات',
            'sizes_helper'          => ' ',

            'features'              => 'المميزات', 
            'features_helper'       => ' ',
            'supplier'                 => 'المورد',
            'supplier_helper'          => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        

        ],
    ],
    'merchant' => [
        'title'          => 'التجار',
        'title_singular' => 'التاجر',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'first_name'           => 'الاسم الاول',
            'first_name_helper'    => ' ',
            'last_name'            => 'الاسم التاني',
            'last_name_helper'     => ' ',
            'email'                => 'البريد الإلكتروني',
            'email_helper'         => ' ',
            'phone'                => 'الهاتف',
            'phone_helper'         => ' ',
            'referral_code'        => 'كود الإحالة',
            'referral_code_helper' => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'merchantManagement' => [
        'title'          => 'ادارة التجار',
        'title_singular' => 'ادارة التجار',
    ],
    'penalty' => [
        'title'          => 'الغرامات',
        'title_singular' => 'الغرامة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'merchant'          => 'التاجر',
            'merchant_helper'   => ' ',
            'reason'            => 'سبب الغرامة',
            'reason_helper'     => ' ',
            'amount'            => 'قيمة الغرامة',
            'amount_helper'     => ' ',

            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        

            'country'           => 'العملة',
            'country_helper'    => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'الاعدادات',
        'title_singular' => 'الاعدادات',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'app_name'              => 'اسم الموقع',
            'app_name_helper'       => ' ',
            'logo'                  => 'الشعار',
            'logo_helper'           => ' ',
            'twitter_handle'        => 'معرف تويتر',
            'twitter_handle_helper' => ' ',
            'twitter_url'           => 'رابط تويتر',
            'twitter_url_helper'    => ' ',
            'facebook_url'          => 'رابط فيسبوك',
            'facebook_url_helper'   => ' ',
            'youtube_url'           => 'رابط يوتيوب',
            'youtube_url_helper'    => ' ',
            'tiktok_url'            => 'رابط تيكتوك',
            'tiktok_url_helper'     => ' ',
            'custom_url'            => 'رابط مخصص',
            'custom_url_helper'     => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        

        ],
    ],
    'faqManagement' => [
        'title'          => 'ادارة الاسئلة الشائعة',
        'title_singular' => 'ادارة الاسئلة الشائعة',
    ],
    'faqCategory' => [
        'title'          => 'التصنيفات',
        'title_singular' => 'التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'التصنيف',
            'category_helper'   => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        
        ],
    ],
    'faqQuestion' => [
        'title'          => 'الاسئلة',
        'title_singular' => 'السؤال',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'category'          => 'التصنيف',
            'category_helper'   => ' ',
            'question'          => 'السؤال',
            'question_helper'   => ' ',
            'answer'            => 'الإجابة',
            'answer_helper'     => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'contactManagement' => [
        'title'          => 'ادارة التواصل',
        'title_singular' => 'ادارة التواصل',
    ],
    'contactCompany' => [
        'title'          => 'الشركات',
        'title_singular' => 'الشركة',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'company_name'           => 'اسم الشركة',
            'company_name_helper'    => ' ',
            'company_address'        => 'العنوان',
            'company_address_helper' => ' ',
            'company_website'        => 'الموقع الالكتروني',
            'company_website_helper' => ' ',
            'company_email'          => 'البريد الالكتروني',
            'company_email_helper'   => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'contactContact' => [
        'title'          => 'التوصل',
        'title_singular' => 'التوصل',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'company'                   => 'الشركة',
            'company_helper'            => ' ',
            'contact_first_name'        => 'الاسم الاول',
            'contact_first_name_helper' => ' ',
            'contact_last_name'         => 'الاسم الثاني',
            'contact_last_name_helper'  => ' ',
            'contact_phone_1'           => 'رقم الهاتف الاساسي',
            'contact_phone_1_helper'    => ' ',
            'contact_phone_2'           => 'رقم الهاتف الاحطياتي',
            'contact_phone_2_helper'    => ' ',
            'contact_email'             => 'البريد الالكتروني',
            'contact_email_helper'      => ' ',
            'contact_skype'             => 'سكايب',
            'contact_skype_helper'      => ' ',
            'contact_address'           => 'العنوان',
            'contact_address_helper'    => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'contentManagement' => [
        'title'          => 'ادارة المحتوى',
        'title_singular' =>  'ادارة المحتوى',
    ],
    'contentCategory' => [
        'title'          => 'التصنيفات',
        'title_singular' => 'التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'slug'              => 'Slug',
            'slug_helper'       => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'contentTag' => [
        'title'          => 'الوسوم',
        'title_singular' => 'الوسم',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'slug'              => 'الرابط',
            'slug_helper'       => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        

        ],
    ],
    'contentPage' => [
        'title'          => 'الصفحات',
        'title_singular' => 'الصفحة',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'title'                 => 'الاسم',
            'title_helper'          => ' ',
            'category'              => 'الصنيفات',
            'category_helper'       => ' ',
            'tag'                   => 'الوسوم',
            'tag_helper'            => ' ',
            'page_text'             => 'النص بالكامل',
            'page_text_helper'      => ' ',
            'excerpt'               => 'المختصر',
            'excerpt_helper'        => ' ',
            'featured_image'        => 'الصورة الرئيسية',
            'featured_image_helper' => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'userAlert' => [
        'title'          => 'تنبيهات المستخدمين',
        'title_singular' => 'تنبيهات المستخدم',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'message'           => 'الرسالة',
            'message_helper'    => ' ',
            'link'              => 'الرابط',
            'link_helper'       => ' ',
            'users'             => 'المستخدمين',
            'users_helper'      => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'order' => [
        'title'          => 'الطلبات',
        'title_singular' => 'الطلب',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'subtotal'              => 'المجموع الفرعي',
            'subtotal_helper'       => ' ',
            'shipping_cost'               => 'تكلفة الشحن',
            'shipping_cost_helper'        => ' ',
            'grand_total'        => 'إجمالي سعر',
            'grand_total_helper' => ' ',
            'merchant'                    => 'التاجر',
            'merchant_helper'             => ' ',
            'country'                     => 'الدولة',
            'country_helper'              => ' ',
            'city'                        => 'المدينة',
            'city_helper'                 => ' ',
            'address'                     => 'العنوان 1',
            'address_helper'              => ' ',
            'address_2'                   => 'العنوان 2',
            'address_2_helper'            => ' ',
            'notes'                       => 'الملاحظات',
            'notes_helper'                => ' ',
            'status'                      => 'الحالة',
            'status_helper'               => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',      
            'paid'                              => 'الدفع',
            'in_store'                          => 'مصدر الطلب',
            'payment_method'                    => 'وسيلة الدفع',
          
        ],
    ],
    'settingsManagement' => [
        'title'          => 'الاعدادات العامة',
        'title_singular' => 'الاعدادات العامة',
    ],
    'bonu' => [
        'title'          => 'العلاوات',
        'title_singular' => 'العلاوة',
        'fields'         => [
            'id'                          => 'ID',
            'id_helper'                   => ' ',
            'min_orders'                  => 'الحد الادنى للطلبات',
            'min_orders_helper'           => ' ',
            'minimum_order_amount'        => 'الحد الادنى لقيمة الطلب',
            'minimum_order_amount_helper' => ' ',
            'bonus'                       => 'قيمة العلاوة',
            'bonus_helper'                => ' ',
            'country'                     => 'العملة',
            'country_helper'              => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'trainingManagement' => [
        'title'          => 'ادارة التدريب',
        'title_singular' => 'ادارة التدريب',
    ],
    'trainingCategory' => [
        'title'          => 'التصنيفات',
        'title_singular' => 'التصنيف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'slug'              => 'الرابط',
            'slug_helper'       => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'training' => [
        'title'          => 'التدريب',
        'title_singular' => 'التدريب',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'category'              => 'التصنيف',
            'category_helper'       => ' ',
            'slug'                  => 'الرابط',
            'slug_helper'           => ' ',
            'type'                  => 'النوع',
            'type_helper'           => ' ',
            'video_iframe'          => 'رابط التضمين',
            'video_iframe_helper'   => ' ',
            'uploaded_video'        => 'ارفع فيديو',
            'uploaded_video_helper' => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'ticketManagement' => [
        'title'          => 'ادارة التذاكر',
        'title_singular' => 'ادارة التذاكر',
    ],
    'ticketCategory' => [
        'title'          => 'تصنيفات التذاكر',
        'title_singular' => 'تصنيفات التذاكر',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'icon'              => 'الايقونة',
            'icon_helper'       => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
    'ticket' => [
        'title'          => 'التذكر',
        'title_singular' => 'تذكرة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'merchant'          => 'التاجر',
            'merchant_helper'   => ' ',
            'category'          => 'التصنيف',
            'category_helper'   => ' ',
            'status'            => 'الحالة',
            'status_helper'     => ' ',
            'message'           => 'الرسالة',
            'message_helper'    => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',
            'type_helper'       => ' ',
            'type'              => 'النوع',

        ],
    ],
    'supplier' => [
        'title'          => 'الموردين',
        'title_singular' => 'المورد',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'الاسم',
            'name_helper'       => ' ',
            'email'             => 'البريد الالكتروني',
            'email_helper'      => ' ',
            'phone'             => 'الهاتف',
            'phone_helper'      => ' ',
            'created_at'        => 'الإنشاء',
            'created_at_helper' => ' ',
            'updated_at'        => 'اخر تحديث',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'تم الحذف في',
            'deleted_at_helper' => ' ',        
        ],
    ],
];
