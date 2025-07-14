<?php
// Simple test script to verify banner checkout functionality

// Test data similar to what the banner form would send
$testData = [
    'product_type' => 'banner',
    'banner_type' => 'x_banner',
    'banner_material' => 'flexi_korea',
    'banner_size' => '80x200',
    'banner_finishing' => 'laminating',
    'quantity' => 2,
    'customer_name' => 'John Doe',
    'customer_email' => 'john@example.com',
    'customer_phone' => '081234567890',
    'customer_address' => 'Jl. Test Address No. 123',
    'shipping_method' => 'local',
    'notes' => 'Urgent order for banner',
    'promo_code' => 'HEMAT10',
    'total_price' => 150000
];

echo "Test Banner Form Data:\n";
echo "======================\n";
foreach ($testData as $key => $value) {
    echo sprintf("%-20s: %s\n", $key, $value);
}

echo "\nThis data should be sent to /checkout.store route via POST request\n";
echo "Expected behavior: Redirect to /checkout with calculated pricing\n";
?>
