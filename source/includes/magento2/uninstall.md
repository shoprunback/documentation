# Uninstall the Module


HERE IS THE STEP BY STEP GUIDE TO UNINSTALL

***Step 1:*** Remove the module SRB_Shoprunback from **app/etc/config.php**

**Step 2:** Drop module tables or columns from database, please check **app/code/SRB/shoprunback/Module/Setup** folder for more information

**Step 3:** Remove the folder **app/code/SRB/**

![image](images/magento2/uninstall.png)

**Step 4:** Remove PHP library from directory **magento_root/lib/shoprunback-php**

**Step 5:** Remove module configuration settings from core_config_data table by running the following query

``` DELETE FROM core_config_data WHERE path LIKE 'SRB%';```

**Step 6:** Remove module from setup_module table by running the following query

``` DELETE FROM setup_module WHERE module LIKE 'SRB_%'; ```

**Step 7:** Run the following command 

``` php bin/magento setup:upgrade ```

# Enable or Disable your Module
<aside class="warning">
	NOTE: If you dont want to uninstall the module you can disable the module and enable back when you want to use it
</aside>


***Step 1:*** Enter the following in the command line:

***For Enable:*** 

```bin/magento module:enable --clear-static-content SRB_Shoprunback```

***For Disable:***

```bin/magento module:disable --clear-static-content SRB_Shoprunback```

```bin/magento setup:upgrade```

```bin/magento cache:clean```

***Step 2:*** Check that the component is enabled/disabled:

```bin/magento module:status Module_name```