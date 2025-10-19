<?php
	use CodeIgniter\Router\RouteCollection;

	$routes->get('/', 'Home::index');
	$routes->get('/all-products', 'Home::all_products');
	$routes->get('/load-all-products', 'Home::load_all_products');
	$routes->get('/about-us', 'Home::about_us');
	$routes->get('/contact-us', 'Home::contact_us');
	$routes->post('/submit-inquiry', 'Home::submit_inquiry');
	$routes->get('/return-policy', 'Home::return_policy');
	$routes->get('/privacy-policy', 'Home::privacy_policy');
	$routes->get('/term-conditions', 'Home::term_conditions');
	$routes->get('/shipping-policy', 'Home::shipping_policy');
	$routes->get('/all-faqs', 'Home::all_faqs');
	$routes->get('/product/(:any)', 'Home::search/$1');
	$routes->get('/category/(:any)', 'Home::category_search/$1');
	$routes->get('/brand/(:any)', 'Home::brand_search/$1');
	$routes->get('/recently-visited', 'Home::recently_visited');
	$routes->get('/all-categories', 'Home::all_categories');
	
	// Customer auth routes
	$routes->get('/sign-in', 'Auth::sign_in');
	$routes->post('/submit-customer-signin', 'Auth::submit_customer_signin');
	$routes->get('/verify-email', 'Auth::verify_email');
	$routes->get('/forgot-password', 'Auth::forgot_password');
	$routes->post('/submit-forgot-password', 'Auth::submit_forgot_password');
	$routes->get('/reset-password', 'Auth::reset_password');
	$routes->post('/submit-reset-password', 'Auth::submit_reset_password');
	$routes->get('/sign-up', 'Auth::sign_up');
	$routes->post('/submit-signup', 'Auth::submit_signup');

	// Customer after sign in routes
	$routes->get('/my-dashboard', 'CustomerDashboard::index', ['filter' => 'customerauth']);
	$routes->post('/update-myprofile', 'CustomerDashboard::update_myprofile', ['filter' => 'customerauth']);
	$routes->post('/change-password', 'CustomerDashboard::change_password', ['filter' => 'customerauth']);
	$routes->get('/my-orders', 'CustomerDashboard::my_orders', ['filter' => 'customerauth']);
	$routes->get('/my-wishlist', 'CustomerDashboard::my_wishlist', ['filter' => 'customerauth']);
	$routes->get('/my-cart', 'CustomerDashboard::my_cart', ['filter' => 'customerauth']);
	$routes->get('/checkout', 'CustomerDashboard::checkout', ['filter' => 'customerauth']);
	$routes->get('/track-order', 'CustomerDashboard::track_order', ['filter' => 'customerauth']);
	$routes->get('/my-logout', 'Auth::my_logout', ['filter' => 'customerauth']);
	$routes->post('/add-to-favourite', 'CustomerDashboard::add_to_favourite');
	$routes->post('/remove-from-favourite', 'CustomerDashboard::remove_from_favourite', ['filter' => 'customerauth']);
	$routes->post('/remove-from-cart', 'CustomerDashboard::remove_from_cart', ['filter' => 'customerauth']);
	$routes->post('/add-to-cart', 'CustomerDashboard::add_to_cart');
	$routes->get('/my-cart-items', 'CustomerDashboard::my_cart_item', ['filter' => 'customerauth']);
	$routes->post('/update-cart', 'CustomerDashboard::update_cart', ['filter' => 'customerauth']);
	$routes->post('/place-order', 'CustomerDashboard::place_order', ['filter' => 'customerauth']);
	$routes->post('/cancel-order', 'CustomerDashboard::cancel_order', ['filter' => 'customerauth']);
	$routes->post('/view-order-items', 'CustomerDashboard::view_order_items', ['filter' => 'customerauth']);
	$routes->get('/view-order/(:any)', 'CustomerDashboard::view_order/$1', ['filter' => 'customerauth']);
	$routes->get('/my-refunds', 'CustomerDashboard::my_refunds', ['filter' => 'customerauth']);
	$routes->get('/my-payment-requests', 'CustomerDashboard::my_payment_requests', ['filter' => 'customerauth']);
	$routes->get('/my-returned-orders', 'CustomerDashboard::my_returned_orders', ['filter' => 'customerauth']);
	$routes->get('/pay-payment-requests/(:any)', 'CustomerDashboard::pay_payment_requests/$1', ['filter' => 'customerauth']);
	$routes->post('/return-order', 'CustomerDashboard::return_order', ['filter' => 'customerauth']);
	$routes->post('/submit-return-order', 'CustomerDashboard::submit_return_order', ['filter' => 'customerauth']);
	$routes->get('/view-returned-order-items', 'CustomerDashboard::view_returned_order_items', ['filter' => 'customerauth']);
	$routes->get('/my-logout', 'Auth::my_logout');

	// ADMIN routes
	$routes->get('/admin-panel', 'Auth::index');
	$routes->post('/submit-signin', 'Auth::submit_signin');

	$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
	$routes->resource('banners', ['filter' => 'auth']);
	$routes->get('/inquiries', 'Dashboard::inquiries', ['filter' => 'auth']);
	$routes->get('/about-us-content', 'Dashboard::about_us');
	$routes->get('/tc-content', 'Dashboard::tc');
	$routes->get('/privacy-policy-content', 'Dashboard::privacy_policy');
	$routes->get('/return-policy-content', 'Dashboard::return_policy');
	$routes->get('/shipping-policy-content', 'Dashboard::shipping_policy');
	$routes->post('/submit-page-settings', 'Dashboard::submit_page_settings', ['filter' => 'auth']);
	$routes->get('/load-revenue', 'Dashboard::load_revenue', ['filter' => 'auth']);
	$routes->get('/general-settings', 'Dashboard::general_settings', ['filter' => 'auth']);
	$routes->post('/submit-general-settings', 'Dashboard::submit_general_settings', ['filter' => 'auth']);
	$routes->resource('brands', ['filter' => 'auth']);
	$routes->resource('categories', ['filter' => 'auth']);
	$routes->resource('sub_categories', ['filter' => 'auth']);
	$routes->get('/fetch-sub-categories', 'CommonController::fetch_sub_categories');
	$routes->resource('faqs', ['filter' => 'auth']);
	$routes->resource('customers', ['filter' => 'auth']);
	$routes->get('/load-customers', 'Customers::load');
	$routes->resource('products', ['filter' => 'auth']);
	$routes->get('/load-products', 'Products::load');	
	$routes->get('/set-product-photo/(:any)/(:any)', 'Products::set_product_photo/$1/$2');
	$routes->get('/remove-product-photo/(:any)/(:any)', 'Products::remove_product_photo/$1/$2');
	$routes->resource('orders', ['filter' => 'auth']);
	$routes->get('/new-orders', 'Orders::new_orders');
	$routes->get('/returned-orders', 'Orders::returned_orders');
	$routes->get('/load-orders', 'Orders::load');
	$routes->get('/get-order-items', 'Orders::get_order_items');
	$routes->get('/download-invoice/(:any)', 'Orders::download_invoice/$1');
	$routes->get('/get-returned-order-items', 'Orders::get_returned_order_items');
	$routes->post('/update-order-item-quantity', 'Orders::update_order_item_quantity');
	$routes->get('/update-returned-order-item-quantity', 'Orders::update_returned_order_item_quantity');
	$routes->post('/raise-payment-request', 'Orders::raise_payment_request');
	$routes->resource('reports', ['filter' => 'auth']);
	$routes->get('/load-reports', 'Reports::load');
	$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);
	$routes->get('/lookup/(:any)', 'Home::lookup/$1');

	$routes->get('/paypal/success', 'Paypal::success');
	$routes->get('/paypal/cancel', 'Paypal::cancel');
	$routes->get('/paypal/payment-request-success', 'Paypal::payment_request_success');
	$routes->get('/paypal/payment-request-cancel', 'Paypal::payment_request_cancel');
