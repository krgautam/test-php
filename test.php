<?php
/**
 * @author: Digi-X
 * @classname:Checkout
 * @created: 13 Nov, 2018
 * @createdBy: Gautam Thakur
 * @modified: 13 Nov, 2018
 * @modifiedBy: Gautam Thakur
 * @purpose: To Create An Interface for Simple Checkout system for daily Deals And Offers
 * @uses It can be used by implementors to calculate billing price of scanned devices.
 *  * */

include_once 'Checkout.php';

    $pricingRules=['atv'=>['for'=>[3=>2]],'ipd'=>['bulk'=>[4=>499.99]],'mbp'=>['free'=>'vga']];
    $co  = new Checkout($pricingRules);
    $co->scan('atv');
    $co->scan('atv');
    $co->scan('atv');
    $co->scan('vga');
    $co->total();
    
    $co1  = new Checkout($pricingRules);
    $co1->scan('atv');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->scan('atv');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->total();
    
    $co2  = new Checkout($pricingRules);
    $co2->scan('mbp');
    $co2->scan('vga');
    $co2->scan('ipd');
    $co2->total();
