/*browser:true*/
/*global define*/
define(
   [
       'Magento_Checkout/js/view/payment/default'
   ],
   function (Component) {
       'use strict';
       return Component.extend({
           defaults: {
               template: 'Foggyline_Paybox/payment/paybox'
           },
           getMailingAddress: function () {
               return window.checkoutConfig.payment.
                 paybox.mailingAddress;
           },
           getPayableTo: function () {
               return window.checkoutConfig.payment.
                 paybox.payableTo;
           }
        }); 
    }
);