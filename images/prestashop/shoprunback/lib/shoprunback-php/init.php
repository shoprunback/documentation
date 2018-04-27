<?php

// Load root files
require dirname(__FILE__) . '/lib/Shoprunback.php';
require dirname(__FILE__) . '/lib/RestClient.php';
require dirname(__FILE__) . '/lib/RestResponse.php';
require dirname(__FILE__) . '/lib/ElementIterator.php';
require dirname(__FILE__) . '/lib/ElementManager.php';
require dirname(__FILE__) . '/tests/RestMocker.php';

// Load Traits
require dirname(__FILE__) . '/lib/Elements/traits/Retrieve.php';
require dirname(__FILE__) . '/lib/Elements/traits/All.php';
require dirname(__FILE__) . '/lib/Elements/traits/Update.php';
require dirname(__FILE__) . '/lib/Elements/traits/Create.php';
require dirname(__FILE__) . '/lib/Elements/traits/Delete.php';

// Load Elements
require dirname(__FILE__) . '/lib/Elements/Element.php';
require dirname(__FILE__) . '/lib/Elements/Brand.php';
require dirname(__FILE__) . '/lib/Elements/Product.php';
require dirname(__FILE__) . '/lib/Elements/Item.php';
require dirname(__FILE__) . '/lib/Elements/Address.php';
require dirname(__FILE__) . '/lib/Elements/Customer.php';
require dirname(__FILE__) . '/lib/Elements/Order.php';
require dirname(__FILE__) . '/lib/Elements/Shipback.php';
require dirname(__FILE__) . '/lib/Elements/ReturnedItem.php';
require dirname(__FILE__) . '/lib/Elements/Warehouse.php';
require dirname(__FILE__) . '/lib/Elements/Company.php';
require dirname(__FILE__) . '/lib/Elements/Account.php';

// Load Utils
require dirname(__FILE__) . '/lib/Util/Container.php';
require dirname(__FILE__) . '/lib/Util/Inflector.php';
require dirname(__FILE__) . '/lib/Util/Logger.php';

// Load Errors
require dirname(__FILE__) . '/lib/Error/Error.php';
require dirname(__FILE__) . '/lib/Error/ElementCannotBeCreated.php';
require dirname(__FILE__) . '/lib/Error/ElementCannotBeUpdated.php';
require dirname(__FILE__) . '/lib/Error/ElementCannotGetAll.php';
require dirname(__FILE__) . '/lib/Error/ElementIndexDoesntExists.php';
require dirname(__FILE__) . '/lib/Error/NotFoundError.php';
require dirname(__FILE__) . '/lib/Error/RestClientError.php';
require dirname(__FILE__) . '/lib/Error/UnknownApiToken.php';
require dirname(__FILE__) . '/lib/Error/UnknownElement.php';
