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
class Checkout{

    private $products = [['sku'=>'ipd','name'=>'Super iPad','price'=>549.99],['sku'=>'mbp','name'=>'MacBook Pro','price'=>1399.99],['sku'=>'atv','name'=>'Apple TV','price'=>109.50],['sku'=>'vga','name'=>'VGA adapter','price'=>30]];
    public $scannedProducts = [];
    public $pricingRules = [];
    public function __construct(array $rules) {		
			$this->pricingRules = $rules;		
		}	
    private function isValidproduct($sku){
    $isProdFound = FALSE;
    foreach($this->products as $product){
         if($product['sku']==$sku){
    $isProdFound=TRUE;
    break;
         }
     }
     return $isProdFound;
    }
    private function getPrice($sku){
    $price= 0;
        foreach($this->products as $product){
         if($product['sku']==$sku){
         $price= round($product['price'],2);
         break;
         }
     }
     return $price;
    }
    public function scan($sku){
        if($this->isValidproduct($sku)){
            $this->scannedProducts[]=$sku;
        }
    }
    public function total(){
    $totalPrice=0.00;
    $products= array_count_values($this->scannedProducts);
    foreach($products as $product =>$count){
       if(isset($this->pricingRules[$product])){
           $rule = $this->pricingRules[$product];
           switch (key($rule)) {
            case "for":
                if($count > key($rule['for'])){
                $price= $this->getPrice($product);
                $totalPrice+=($price  * $count/key($rule['for'])*current($rule['for']))+($price * ($count%key($rule['for'])));
                }else{
                     $totalPrice+= $this->getPrice($product) * $count;
                }
                break;
            case "bulk":
               if($count > key($rule['bulk'])){
                  //echo current($rule['bulk']); 
                  $totalPrice+= current($rule['bulk']) * $count;
               }else{
                 $totalPrice+= $this->getPrice($product) * $count;
               }
                break;
            case "free":
                $totalPrice+= $this->getPrice($product) * $count;
                if(isset($products[$rule['free']])){
                    if($products[$rule['free']]>=$count){
                        $totalPrice-= $this->getPrice($rule['free']) * $count;
                    }else{
                        $totalPrice-= $this->getPrice($rule['free']) * $products[$rule['free']];
                    }
                }
                break;
            default:
                $totalPrice+= $this->getPrice($product) * $count;
        }
       }else{
        $totalPrice+= $this->getPrice($product)*$count;    
       }
    }
    //print_r($products);
    // let's print the international format for the en_US locale
    setlocale(LC_MONETARY, 'en_US');
    echo money_format("Total price is %i", $totalPrice);
    }
    public function __destruct(){
      $this->pricingRules =[];  
    } 

}
