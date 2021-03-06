<?php 
/**
* TERMINAL MAIN CLASS
*/
class terminal extends database
{	
	function __construct()
	{
		parent::__construct();
	}

	// Terminal List Function
	public function terminal_list()
	{
		if (!isset($_SESSION['terminal_list'])) {
			$_SESSION['terminal_list'] = array();
		}
	}

	
	// Update Quantity for Select Item (Edit or Change Button Function)
	public function update_qty_item($itemqty, $arrayDelete){
			foreach ($_SESSION['terminal_list'][$arrayDelete] as $key => $value) {
				$_SESSION['terminal_list'][$arrayDelete][$key]['quantity'] = $itemqty;
			}
			return 'sucess';	
	}

	
	// Delete Product for Terminal List Item (Delete Button Function)
	public function delete_item_list($product_id){
			unset($_SESSION['terminal_list'][$product_id]);
			return 'sucess';
	}


	// New Item Add
	public function add_item_list($product_qty){
		$_SESSION['barcode_detail']['quantity'] = $product_qty;
		// Add new scan Session with update quantity
		$latest_product_add_detail = array ( $_SESSION['barcode'] => $_SESSION['barcode_detail'] );

		// Complete Scan Terminal List
		$_SESSION['terminal_list'][] = $latest_product_add_detail;

		$count = count($_SESSION['terminal_list']);
		$price 	= $_SESSION['barcode_detail']['price'];
		$qty 	= $_SESSION['barcode_detail']['quantity'];
		$price1 = number_format((float)$price, 2, '.', '');
		$total 	= $price * $qty; 
		$total1 = number_format((float)$total, 2, '.', '');
		$id = end(array_keys($_SESSION['terminal_list']));

		echo '<li class="col-md-12 nopadding product_list">
			<div class="product" id="row_'.($count).'">
			    <div class="col-md-1 nopadding alignCenter">'.($count+1).'</div>
			    <div class="col-md-5 ">'. $_SESSION['barcode_detail']['name'] .'<a class="itemDelete" href="ajex.php?delete='. $id .'" style="color:#fff;"><span class="glyphicon glyphicon-trash floatRight" aria-hidden="true"></span></a><input type="hidden" class="rowdelete" value="'. $id .'"/></div>
			    <div class="col-md-2 alignRight paddingright30 productPrice">'. $price1 .'</div>
			    <div class="col-md-2 alignCenter"><lable>'. $qty .'</lable></div>
			    <div class="col-md-2 alignRight paddingright30"><span class="subtotalAmtSpan">'. $total1.'</span><input type="hidden" class="subtotalAmt" value="'. $total1.'" /></div>
			    <div class="clearfix"></div>
			</div>
			<div class="productoffer">
				<div class="col-md-5 col-md-offset-1">Free Pencil</div>
			    <div class="col-md-6 nopadding"></div>
			    <div class="clearfix"></div>
			</div>
		</li>';
		return 'sucess';
	}


	

}// end of class
?>