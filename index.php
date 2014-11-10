<?php

// Init
include($_SERVER['DOCUMENT_ROOT'] . '/app/core/initialize.php');

// Main Sections
Router::add('/', '/app/controllers/home.php');

// Users
Router::add('/users', '/app/controllers/users/list.php');
Router::add('/users/register', '/app/controllers/users/register/form.php');
Router::add('/users/register/process_form/', '/app/controllers/users/register/process_form.php');


//Invoices
Router::add('/invoices', '/app/controllers/invoices/invoices.php');
Router::add('/newinvoice', '/app/controllers/invoices/newinvoice.php');
Router::add('/invoicedetails', '/app/controllers/invoices/invoicedetails.php');

// Inventory
Router::add('/inventory', '/app/controllers/inventory.php');


// Issue Route
Router::route();