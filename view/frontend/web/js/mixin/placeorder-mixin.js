/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_CheckoutAgreements/js/model/agreements-assigner',
    'mage/url'
], function ($, wrapper, agreementsAssigner, url) {
    'use strict';
    return function (placeOrderAction) {
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, messageContainer) {
            agreementsAssigner(paymentData);
            let puchaseOrderNo = $("#purchaseOrderNo").val();
            var linkUrl = url.build('purchaseorder/index/SaveShippingData');
            $.ajax({
                url : linkUrl,
                data: {shippingdata: puchaseOrderNo},
                dataType: 'json',
                type: 'POST',
            }).success(
                function (response) {
                    if (response.responseType !== 'error') {
                        console.log(response);
                    }
                }
            );
            return originalAction(paymentData, messageContainer);
        });
    };
});
