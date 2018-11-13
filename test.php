<?php
/**
 * @author: Digi-X
 * @created: 13 Nov, 2018
 * @createdBy: Gautam Thakur
 * @modified: 13 Nov, 2018
 * @modifiedBy: Gautam Thakur
 * @purpose: To test the Checkout system is working properly or not.
 *  * */

include_once 'Checkout.php';

    $pricingRules=['atv'=>['for'=>[3=>2]],'ipd'=>['bulk'=>[4=>499.99]],'mbp'=>['free'=>'vga']];
    $co  = new Checkout($pricingRules);
    $co->scan('atv');
    $co->scan('atv');
    $co->scan('atv');
    $co->scan('vga');
    $co->total(); // Total price is USD 249.00
    
    $co1  = new Checkout($pricingRules);
    $co1->scan('atv');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->scan('atv');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->scan('ipd');
    $co1->total(); // Total price is USD 2,718.95
    
    $co2  = new Checkout($pricingRules);
    $co2->scan('mbp');
    $co2->scan('vga');
    $co2->scan('ipd');
    $co2->total(); // Total price is USD 1,949.98
