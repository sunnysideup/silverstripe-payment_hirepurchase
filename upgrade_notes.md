2020-07-06 12:52

# running php upgrade upgrade see: https://github.com/silverstripe/silverstripe-upgrader
cd /c/Users/PC/Documents/www/upgrades/payment_hirepurchase
php /c/Users/PC/Documents/www/upgrades/upgrader_tool/vendor/silverstripe/upgrader/bin/upgrade-code upgrade /c/Users/PC/Documents/www/upgrades/payment_hirepurchase/payment_hirepurchase  --root-dir=/c/Users/PC/Documents/www/upgrades/payment_hirepurchase --write -vvv
Writing changes for 2 files
Running upgrades on "/c/Users/PC/Documents/www/upgrades/payment_hirepurchase/payment_hirepurchase"
[2020-07-06 12:52:33] Applying RenameClasses to HirePurchasePayment.php...
[2020-07-06 12:52:33] Applying ClassToTraitRule to HirePurchasePayment.php...
[2020-07-06 12:52:33] Applying RenameClasses to PaymentHirePurchaseTest.php...
[2020-07-06 12:52:33] Applying ClassToTraitRule to PaymentHirePurchaseTest.php...
[2020-07-06 12:52:33] Applying RenameClasses to _config.php...
[2020-07-06 12:52:33] Applying ClassToTraitRule to _config.php...
modified:	src/HirePurchasePayment.php
@@ -2,12 +2,20 @@

 namespace Sunnysideup\PaymentHirePurchase;

-use EcommercePayment;
-use Config;
-use EcommercePaymentSuccess;
-use FieldList;
-use LiteralField;
-use HiddenField;
+
+
+
+
+
+
+use SilverStripe\Core\Config\Config;
+use Sunnysideup\PaymentHirePurchase\HirePurchasePayment;
+use Sunnysideup\Ecommerce\Money\Payment\PaymentResults\EcommercePaymentSuccess;
+use SilverStripe\Forms\LiteralField;
+use SilverStripe\Forms\HiddenField;
+use SilverStripe\Forms\FieldList;
+use Sunnysideup\Ecommerce\Model\Money\EcommercePayment;
+


 /**
@@ -25,7 +33,7 @@
     public function processPayment($data, $form)
     {
         $this->Status = 'Pending';
-        $this->Message = Config::inst()->get("HirePurchasePayment", "custom_message_for_hire_purchase_payment");
+        $this->Message = Config::inst()->get(HirePurchasePayment::class, "custom_message_for_hire_purchase_payment");
         $this->write();
         return EcommercePaymentSuccess::create();
     }

modified:	tests/PaymentHirePurchaseTest.php
@@ -1,4 +1,6 @@
 <?php
+
+use SilverStripe\Dev\SapphireTest;
 class PaymentHirePurchaseTest extends SapphireTest
 {
     protected $usesDatabase = false;

Writing changes for 2 files
✔✔✔