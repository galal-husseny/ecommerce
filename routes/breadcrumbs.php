<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('الصفحة الرئيسية', route('dashboard'));
});


Breadcrumbs::macro('resource', function (string $name, string $title) {
    // Home > Blog
    Breadcrumbs::for("{$name}.index", function (BreadcrumbTrail $trail) use ($name, $title) {
        $trail->parent('dashboard');
        $trail->push($title, route("{$name}.index"));
    });

    // Home > Blog > New
    Breadcrumbs::for("{$name}.create", function (BreadcrumbTrail $trail) use ($name,$title) {
        $trail->parent("{$name}.index");
        $trail->push("انشاء {$title}", route("{$name}.create"));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("{$name}.edit", function (BreadcrumbTrail $trail,$model) use ($name) {
        $trail->parent("{$name}.index");
        $trail->push("تعديل {$model->name}", route("{$name}.edit", $model->id));
    });

});

Breadcrumbs::macro('nested_resource', function (string $name, string $title) {
    // Home > Blog
    $parent = explode('.',$name)[0]; // users
    $parentTitle = explode('.',$title)[0]; // المستخدمين
    $child = explode('.',$name)[1]; // addresses
    $childTitle = explode('.',$title)[1]; // العناوين

    Breadcrumbs::for("{$parent}.{$child}.index", function (BreadcrumbTrail $trail,$model) use ($parent,$child,$childTitle) {
        $trail->parent("{$parent}.edit",$model);
        $trail->push("{$childTitle}", route("{$parent}.{$child}.index",$model->id));
    });

    Breadcrumbs::for("{$parent}.{$child}.create", function (BreadcrumbTrail $trail,$model) use ($parent,$child,$childTitle) {
        $trail->parent("{$parent}.{$child}.index",$model);
        $trail->push("انشاء {$childTitle}", route("{$parent}.{$child}.create",$model->id));
    });

    Breadcrumbs::for("{$parent}.{$child}.edit", function (BreadcrumbTrail $trail,$model,$nestedModel) use ($parent,$child,$childTitle) {
        $trail->parent("{$parent}.{$child}.index",$model);
        $trail->push("تعديل {$childTitle}", route("{$parent}.{$child}.edit",[$model->id,$nestedModel->id]));
    });

});
Breadcrumbs::for("products.show", function (BreadcrumbTrail $trail,$model) {
    $trail->parent("products.index",$model);
    $trail->push("{$model->name}", route("products.show",$model->id));
});
Breadcrumbs::for("reviews.index", function (BreadcrumbTrail $trail,$model) {
    $trail->parent("products.show",$model);
    $trail->push("التقيمات", route("reviews.index",$model->id));
});

Breadcrumbs::resource('brands','العلامات التجارية');
Breadcrumbs::resource('models','الموديلات');
Breadcrumbs::resource('cities','المدن');
Breadcrumbs::resource('regions','المناطق');
Breadcrumbs::resource('admins','المُشرفين');
Breadcrumbs::resource('roles','الوظائف');
Breadcrumbs::resource('categories','ألاقسام');
Breadcrumbs::resource('products','المنتجات');
Breadcrumbs::resource('shops','المحلات');
Breadcrumbs::resource('sellers','التجار');
Breadcrumbs::resource('specs','المُواصفات');
Breadcrumbs::resource('users','المستخدمين');
Breadcrumbs::resource('offers','العروض');
Breadcrumbs::resource('coupons','أكواد الخصم');

Breadcrumbs::nested_resource('users.addresses','المستخدمين.العناوين');
