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
