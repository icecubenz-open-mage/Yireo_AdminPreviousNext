# Yireo AdminPreviousNext (fork)

This extension for Magento 1 and OpenMage adds "Previous" and "Next" buttons to the product / customer / order / shipment / invoice and credit memo view pages for ease of navigation between records.

Installation is possible via Composer:

` composer require icecube/magento1-adminpreviousnext`

All credit for original code goes to Yireo: https://www.yireo.com/software/magento-extensions/adminpreviousnext and https://github.com/yireo/Yireo_AdminPreviousNext

## Changes from Original Extension

* Removed jQuery dependency, replaced with Prototype to avoid an extra framework being loaded.
* Changed CSS to be more compatible with OpenMage admin theme.
* Added support for shipment, invoice and credit memo views.
* Changed composer package name to avoid conflict with original.
