<?php

use App\Models\Category;

// Update all categories to have is_active = true if null
Category::whereNull('is_active')->update(['is_active' => true]);

echo "Categories updated successfully!\n";

// Show all categories
$categories = Category::all(['name', 'is_active']);
foreach ($categories as $category) {
    echo "{$category->name}: " . ($category->is_active ? 'Active' : 'Inactive') . "\n";
}
