# Installing the Module

## 1. Create your own ShopRunBack account

	First of all, you must create your own ShopRunBack account here. [here](https://sso.shoprunback.com/en/users/sign_up)

	For your store configuration, please contact your account manager who will guide you through the process 

## 2. How to get the Module

	Contact the ShopRunBack Team to get the source code of the module or you can download from [here](https://github.com/shoprunback/magento2-module/releases/tag/v1.0)

First, you should copy it’s code to the required directory (project_name/app/code):
The left panel shows here the basic listing of the file with a module. The right panel — Magento 2 codebase.. 

Basically, the Install folder content should be copied to the app/code/ directory


![image](https://belvg.com/blog/wp-content/uploads/2016/08/%5EAAB2CD8364D709EABAC56F6D46C334E233134F1A7072C1CD0A%5Epimgpsh_fullsize_distr.png)

## 3. Install Command line

Magento CLI provides a large number of useful console commands to manage the store. And you can get the list of these commands by running: php bin/magento. But now we need to use only one:

php bin/magento setup:upgrade

### FOR LOCAL DEVELOPMENT

Copy module code to to the required directory: (app/code/ ) and run following command 

php -dmemory_limit=20G bin/magento setup:upgrade

php -dmemory_limit=20G bin/magento setup:di:compile

php -dmemory_limit=20G bin/magento setup:static-content:deploy -f

php bin/magento cache:flush && php bin/magento cache:clean (For clean catch)
