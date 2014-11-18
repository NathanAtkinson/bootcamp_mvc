<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Main Sections
Router::add('/', '/app/controllers/home.php');

// Users
Router::add('/users', '/app/controllers/users/list.php');
Router::add('/users/register', '/app/controllers/users/register/form.php');
Router::add('/users/register/process_form/', '/app/controllers/users/register/process_form.php');
Router::add('/users/edit_user/', '/app/controllers/users/register/edit_user.php');
Router::add('/users/remove_user/', '/app/controllers/users/register/remove_user.php');


//Invoices
Router::add('/invoices', '/app/controllers/invoices/invoices.php');
Router::add('/new_invoice', '/app/controllers/invoices/new_invoice.php');
Router::add('/invoice_details', '/app/controllers/invoices/invoice_details.php');
Router::add('/invoices/process_invoice', '/app/controllers/invoices/invoice_process_form.php');


// Inventory
Router::add('/inventory', '/app/controllers/inventory.php');


// //for examples
// Router::add('/new_customer', '/app/controllers/new_customer.php');
// Router::add('/customer/form', '/app/controllers/customer_process_form.php');
// Router::add('/customer/process_form', '/app/controllers/process_form.php');
// Router::add('/customer/list', '/app/controllers/customer_list.php');
// Router::add('/customer/remove', '/app/controllers/remove_customer.php');



// Router::add('/login', '/app/controllers/login_form.php');
// Router::add('/logout', '/app/controllers/login_form.php');
// Router::add('/process_login', '/app/controllers/process_login.php');
// Router::add('/account', '/app/controllers/logged_in.php');
// Router::add('/delete_invoice', '/app/controllers/delete_invoice.php');



// Issue Route
Router::route();