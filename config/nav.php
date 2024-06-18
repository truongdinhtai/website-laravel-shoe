<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 4/30/23 .
 * Time: 12:46 AM .
 */


return [
    [
        'icon'    => 'home',
        'icon-v2' => 'uil-home-alt',
        'name'    => 'Tổng quan',
        'route'   => 'get_admin.home',
        'prefix'  => ['']
    ],
    [
        'icon'    => 'user-x',
        'icon-v2' => 'uil-box',
        'name'    => 'Nhà CC',
        'route'   => 'get_admin.supplier.index',
        'prefix'  => ['supplier']
    ],
    [
        'icon'    => 'list',
        'icon-v2' => 'uil-document-layout-center',
        'name'    => 'Danh mục',
        'route'   => 'get_admin.category.index',
        'prefix'  => ['category']
    ],
    [
        'icon'    => 'database',
        'icon-v2' => 'uil-window',
        'name'    => 'Option',
        'route'   => 'get_admin.product_option.index',
        'prefix'  => ['product-option']
    ],
    [
        'icon'    => 'database',
        'icon-v2' => 'uil-store',
        'name'    => 'Sản phẩm',
        'route'   => 'get_admin.product.index',
        'prefix'  => ['product']
    ],
//    [
//        'icon'    => 'list',
//        'icon-v2' => 'uil-list-ul',
//        'name'    => 'Menu',
//        'route'   => 'get_admin.menu.index',
//        'prefix'  => ['menu']
//    ],
//    [
//        'icon'    => 'tag',
//        'icon-v2' => 'uil-pricetag-alt',
//        'name'    => 'Tags',
//        'route'   => 'get_admin.tag.index',
//        'prefix'  => ['tag']
//    ],
//    [
//        'icon'    => 'edit-2',
//        'icon-v2' => 'uil-book-open',
//        'name'    => 'Bài viết',
//        'route'   => 'get_admin.article.index',
//        'prefix'  => ['article']
//    ],
    [
        'icon'    => 'user',
        'icon-v2' => 'uil-user-check',
        'name'    => 'User',
        'route'   => 'get_admin.user.index',
        'prefix'  => ['user']
    ],
    [
        'icon'    => 'shopping-cart',
        'icon-v2' => 'uil-shopping-cart-alt',
        'name'    => 'Order',
        'route'   => 'get_admin.order.index',
        'prefix'  => ['order']
    ],
    [
        'icon'    => 'sliders',
        'icon-v2' => 'uil-sliders-v-alt',
        'name'    => 'Slide',
        'route'   => 'get_admin.slide.index',
        'prefix'  => ['slide']
    ],
    [
        'icon'    => 'layout',
        'icon-v2' => 'uil-copy-alt',
        'name'    => 'Page',
        'route'   => 'get_admin.page.index',
        'prefix'  => ['page']
    ],
    [
        'icon'    => 'airplay',
        'icon-v2' => 'uil-folder-plus',
        'name'    => 'Warehouse',
        'route'   => 'get_admin.warehouse.index',
        'prefix'  => ['warehouse']
    ],
    [
        'icon'    => 'key',
        'icon-v2' => 'uil-store',
        'name'    => 'Permission',
        'route'   => 'get_admin.permission.index',
        'prefix'  => ['permission']
    ],
    [
        'icon'    => 'layers',
        'icon-v2' => 'uil-key-skeleton',
        'name'    => 'role',
        'route'   => 'get_admin.role.index',
        'prefix'  => ['role']
    ],
    [
        'icon'    => 'settings',
        'icon-v2' => 'uil-wrench',
        'name'    => 'Setting',
        'route'   => 'get_admin.setting',
        'prefix'  => ['setting']
    ],
];
