<?php

namespace Sunnysideup\PaymentHirePurchase;

use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HiddenField;
use SilverStripe\Forms\LiteralField;
use Sunnysideup\Ecommerce\Forms\OrderForm;
use Sunnysideup\Ecommerce\Model\Money\EcommercePayment;
use Sunnysideup\Ecommerce\Model\Order;
use Sunnysideup\Ecommerce\Money\Payment\PaymentResults\EcommercePaymentSuccess;

/**
 * Payment object representing an Hire Purchase Payment (order online and then complete HP application externally).
 *
 * @author Nicolaas [at] sunnysideup.co.nz
 */
class HirePurchasePayment extends EcommercePayment
{
    private static $custom_message_for_in_store_payment = '';

    /**
     * Process the In Store payment method.
     *
     * @param mixed $data
     */
    public function processPayment($data, OrderForm $form)
    {
        $this->Status = 'Pending';
        $this->Message = Config::inst()->get(HirePurchasePayment::class, 'custom_message_for_hire_purchase_payment');
        $this->write();

        return EcommercePaymentSuccess::create();
    }

    public function getPaymentFormFields(?float $amount = 0, ?Order $order = null): FieldList
    {
        return new FieldList(
            new LiteralField(
                'HirePurchasePayment_BeforeMessage',
                '<div id="HirePurchasePayment_BeforeMessage"><img src="https://www.creditcapable.co.nz/ccl.png" alt="Online Finance provided by credit capable"></div>'
            ),
            new HiddenField('HirePurchase', 'HirePurchase', 0)
        );
    }

    public function getPaymentFormRequirements(): array
    {
        return [];
    }
}
