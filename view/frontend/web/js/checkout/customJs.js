/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define(
    [
        'ko',
        'jquery',
        'uiComponent',
        'mage/url'
    ],
    /**
     *
     * @param ko
     * @param $
     * @param Component
     * @param url
     */
    function (ko, $, Component,url) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'Sprinix_PurchaseOrderExt/checkout/customPoNumber',
            },
            /**
             *
             * @returns {*}
             */
            initObservable: function () {
                this._super();
                this.purchaseOrderNo = ko.observable('');
                // window.purchaseOrderNo = this?.purchaseOrderNo();
                return this;
            },
            /**
             *
             * @param data
             * @param event
             */
            handleInputChange: function (data, event) {
                let updatedValue = event.target.value;
                this.purchaseOrderNo(updatedValue);
            },
        });
    }
);
