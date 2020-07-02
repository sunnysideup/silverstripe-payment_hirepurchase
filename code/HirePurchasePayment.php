<?php

/**
 * Payment object representing an Hire Purchase Payment (order online and then complete HP application externally).
 * @author Nicolaas [at] sunnysideup.co.nz
 * @package payment
 */
class HirePurchasePayment extends EcommercePayment
{
    private static $custom_message_for_in_store_payment = "";

    /**
     * Process the In Store payment method
     */
    public function processPayment($data, $form)
    {
        $this->Status = 'Pending';
        $this->Message = Config::inst()->get("HirePurchasePayment", "custom_message_for_hire_purchase_payment");
        $this->write();
        return EcommercePayment_Success::create();
    }

    public function getPaymentFormFields($amount = 0, $order = null)
    {
        return new FieldList(
            new LiteralField(
                'HirePurchasePayment_BeforeMessage',
                '<div id="HirePurchasePayment_BeforeMessage"><img src="https://www.creditcapable.co.nz/ccl.png" alt="Online Finance provided by credit capable"></div>'
            ),
            new HiddenField("HirePurchase", "HirePurchase", 0)
        );
    }

    public function getPaymentFormRequirements()
    {
        return null;
    }
}
