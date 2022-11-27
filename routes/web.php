<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\DefaultController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', function () {
//     return view('auth.login');
// });
Route::controller(DemoController::class)->group(function () {
    Route::get('/about', 'Index')->name('about.page')->middleware('check');
    Route::get('/contact', 'ContactMethod')->name('cotact.page');
});

Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');

    // Admin All Route
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');

    });
    // Supplier All Route
    Route::controller(SupplierController::class)->group(function () {
        Route::get('/supplier/all', 'supplier_all')->name('supplier.all');
        Route::get('/supplier/add', 'supplier_add')->name('supplier.add');
        Route::post('/supplier/store', 'supplier_store')->name('supplier.store');
        Route::get('/supplier/edit/{id}', 'supplier_edit')->name('supplier.edit');
        Route::get('/supplier/delete/{id}', 'supplier_delete')->name('supplier.delete');

    });
// Customer All Route
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer/all', 'customer_all')->name('customer.all');
        Route::get('/customer/add', 'customer_add')->name('customer.add');
        Route::post('/customer/store', 'customer_store')->name('customer.store');
        Route::get('/customer/edit/{id}', 'customer_edit')->name('customer.edit');
        Route::get('/customer/delete/{id}', 'customer_delete')->name('customer.delete');
        Route::get('/credit/customer', 'CreditCustomer')->name('credit.customer');

        Route::get('/credit/customer/print/pdf', 'CreditCustomerPrintPdf')->name('credit.customer.print.pdf');

        Route::get('/customer/edit/invoice/{invoice_id}', 'CustomerEditInvoice')->name('customer.edit.invoice');

        Route::post('/customer/update/invoice/{invoice_id}', 'CustomerUpdateInvoice')->name('customer.update.invoice');

        Route::get('/customer/invoice/details/{invoice_id}', 'CustomerInvoiceDetails')->name('customer.invoice.details.pdf');

        Route::get('/paid/customer', 'PaidCustomer')->name('paid.customer');

        Route::get('/paid/customer/print/pdf', 'PaidCustomerPrintPdf')->name('paid.customer.print.pdf');
        Route::get('/customer/wise/report', 'CustomerWiseReport')->name('customer.wise.report');
        Route::get('/customer/wise/credit/report', 'CustomerWiseCreditReport')->name('customer.wise.credit.report');
        Route::get('/customer/wise/paid/report', 'CustomerWisePaidReport')->name('customer.wise.paid.report');

    });
// Unit All Route
    Route::controller(UnitController::class)->group(function () {
        Route::get('/unit/all', 'unit_all')->name('unit.all');
        Route::get('/unit/add', 'unit_add')->name('unit.add');
        Route::post('/unit/store', 'unit_store')->name('unit.store');
        Route::get('/unit/edit/{id}', 'unit_edit')->name('unit.edit');
        Route::get('/unit/delete/{id}', 'unit_delete')->name('unit.delete');

    });
// Category All Route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category/all', 'category_all')->name('category.all');
        Route::get('/category/add', 'category_add')->name('category.add');
        Route::post('/category/store', 'category_store')->name('category.store');
        Route::get('/category/edit/{id}', 'category_edit')->name('category.edit');
        Route::get('/category/delete/{id}', 'category_delete')->name('category.delete');

    });

// Product All Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('/product/all', 'product_all')->name('product.all');
        Route::get('/product/add', 'product_add')->name('product.add');
        Route::post('/product/store', 'product_store')->name('product.store');
        Route::get('/product/edit/{id}', 'product_edit')->name('product.edit');
        Route::get('/product/delete/{id}', 'product_delete')->name('product.delete');

    });
// Purchase All Route
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('/purchase/all', 'purchase_all')->name('purchase.all');
        Route::get('/purchase/add', 'purchase_add')->name('purchase.add');
        Route::post('/purchase/store', 'purchase_store')->name('purchase-store');
        Route::get('/purchase/delete/{id}', 'purchase_delete')->name('purchase.delete');
        Route::get('/purchase/pending', 'purchase_pending')->name('purchase.pending');
        Route::get('/purchase/approve/{id}', 'purchase_approve')->name('purchase.approve');
        Route::get('/daily/purchase/report', 'DailyPurchaseReport')->name('daily.purchase.report');
        Route::get('/daily/purchase/pdf', 'DailyPurchasePdf')->name('daily.purchase.pdf');

    });

// Invoice All Route
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/all', 'invoice_all')->name('invoice.all');
        Route::get('/invoice/add', 'invoice_add')->name('invoice.add');
        Route::post('/invoice/store', 'invoice_store')->name('invoice-store');
        Route::get('/invoice/delete/{id}', 'invoice_delete')->name('invoice.delete');
        Route::get('/invoice/pending/list', 'pending_list')->name('invoice.pending.list');
        Route::get('/invoice/approve/{id}', 'invoice_approve')->name('invoice.approve');
        Route::post('/approval/store/{id}', 'approval_store')->name('approval.store');
        Route::get('/print/invoice/list', 'print_invoice_list')->name('print.invoice.list');
        Route::get('/print/invoice/{id}', 'print_invoice')->name('print.invoice');
        Route::get('/daily/invoice/report', 'daily_invoice_report')->name('daily.invoice.report');

        Route::get('/daily/invoice/pdf', 'DailyInvoicePdf')->name('daily.invoice.pdf');
    });
// Stock All Route
    Route::controller(StockController::class)->group(function () {
        Route::get('/stock/report', 'stock_report')->name('stock.report');
        Route::get('/stock/report/pdf', 'StockReportPdf')->name('stock.report.pdf');
        Route::get('/stock/supplier/wise', 'StockSupplierWise')->name('stock.supplier.wise');
        Route::get('/supplier/wise/pdf', 'SupplierWisePdf')->name('supplier.wise.pdf');
        Route::get('/product/wise/pdf', 'ProductWisePdf')->name('product.wise.pdf');
    });

// Default All Route
    Route::controller(DefaultController::class)->group(function () {
        Route::get('/get-category', 'GetCategory')->name('get-category');
        Route::get('/get-product', 'GetProduct')->name('get-product');
        Route::get('/check-product', 'GetStock')->name('check-product-stock');

    });
}); // End Group Middleware

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

// Route::get('/contact', function () {
//     return view('contact');
// });
