<?php

error_reporting(- 1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("TESTING", true);

require_once dirname(__DIR__) . '/vendor/autoload.php';

// Those loadings are necessary to do a single file test
// Load root class
require_once __DIR__ . '/BaseTest.php';

// Load Base classes and traits
require_once __DIR__ . '/Elements/BaseElementTest.php';
require_once __DIR__ . '/Elements/BrandTrait.php';
require_once __DIR__ . '/Elements/ProductTrait.php';
require_once __DIR__ . '/Elements/OrderTrait.php';
require_once __DIR__ . '/Elements/AddressTrait.php';
require_once __DIR__ . '/Elements/CustomerTrait.php';
require_once __DIR__ . '/Elements/ShipbackTrait.php';
require_once __DIR__ . '/Elements/ItemTrait.php';
require_once __DIR__ . '/Elements/WarehouseTrait.php';
require_once __DIR__ . '/Elements/ReturnedItemTrait.php';
require_once __DIR__ . '/Elements/CompanyTrait.php';
require_once __DIR__ . '/Elements/AccountTrait.php';

require_once __DIR__ . '/Elements/Nested/BaseNestedTest.php';
require_once __DIR__ . '/Elements/Mocker/BaseMockerTest.php';
require_once __DIR__ . '/Elements/Api/BaseApiTest.php';

// --------------------------------------------------------------------------------------
// FOR THE FOLOWING, SOME LOADS ARE REQUIRED FOR SOME ISOLATED TESTS BUT WILL FAIL OTHERS
// --------------------------------------------------------------------------------------

// Needed to test ProductTest
// Will fail BrandTest
// require_once __DIR__ . '/Elements/Mocker/BrandTest.php';
// require_once __DIR__ . '/Elements/Api/BrandTest.php';

// Needed to test ShipbackTest
// Will fail OrderTest
// require_once __DIR__ . '/Elements/Mocker/OrderTest.php';
// require_once __DIR__ . '/Elements/Api/OrderTest.php';
