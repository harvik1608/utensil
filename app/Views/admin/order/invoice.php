<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
                font-family: Arial, sans-serif;
                font-size: 14px;
            }
            th, td {
                border: 1px solid #000;
                padding: 6px;
                text-align: left;
            }
            .no-border {
                border: none;
            }
            .header-table td {
                border: 1px solid #000;
            }
        </style>
    </head>
    <body>

        <h2><img src="<?php echo $app_logo; ?>" style="width: 75px;height: 75px;" /><a style="float: right;">Invoice</a></h2>

        <table class="header-table" width="100%">
            <tr>
                <td rowspan="3" width="60%">
                    <b><?php echo $app_name; ?></b><br>
                    <?php echo $app_address; ?>
                </td>
                <td style="text-align: right;"><b>Date:</b><?php echo format_date($order['order_date']); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;"><b>Invoice #:</b> INV-<?php echo $order['id']; ?></td>
            </tr>
            <tr>
                <td style="text-align: right;"><b>Customer ID #:</b> <?php echo $order['customer_id']; ?></td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width="5%"><b>To</b></td>
                <td>
                    <b><?php echo $order_shipping['shipping_fname']." ".$order_shipping['shipping_lname']; ?></b><br>
                    <?php echo $order_shipping['shipping_address']; ?>,
                    <?php echo $order_shipping['shipping_city']; ?>,
                    <?php echo $order_shipping['shipping_region']; ?> - <?php echo $order_shipping['shipping_postcode']; ?>, <?php echo $order_shipping['shipping_country']; ?>.<br>
                    <?php echo $order_shipping['shipping_phone']; ?>
                </td>
            </tr>
        </table>

        <table width="100%">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="55%">Description</th>
                    <th width="15%">Qty.</th>
                    <th width="15%">Unit Price</th>
                    <th width="10%" style="text-align: right;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if($order_items) {
                        foreach($order_items as $key => $val) {
                            $price = $val['product_discount_amt'] > 0 ? $val['product_discount_amt'] : $val['product_amt']; 
                            $total = $val['quantity']*$price;
                ?>
                            <tr>
                                <td><?php echo $key+1; ?></td>
                                <td><?php echo $val['name']; ?></td>
                                <td><?php echo $val['quantity']; ?></td>
                                <td><?php echo currency()."".$price; ?></td>
                                <td style="text-align: right;"><?php echo currency()."".number_format($total,2); ?></td>
                            </tr>
                <?php
                        }
                    } 
                ?>
                <tr>
                    <td colspan="4" style="text-align:right"><b>SUBTOTAL</b></td>
                    <td style="text-align: right;"><?php echo currency().$order['amount']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right"><b>SHIPPING CHARGE</b></td>
                    <td style="text-align: right;"><?php echo currency().$order['shipping_cost']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right"><b>VAT CHARGE</b></td>
                    <td style="text-align: right;"><?php echo currency().$order['vat_charge']; ?></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align:right"><b>TOTAL</b></td>
                    <td style="text-align: right;"><b><?php echo currency().number_format($order['amount']+$order['shipping_cost']+$order['vat_charge'],2); ?></b></td>
                </tr>
            </tbody>
        </table>
        <table class="header-table" width="100%">
            <tr>
                <td width="60%">
                    <b>Company's Bank Details</b><br>
                    <?php echo $bank_name; ?><br>
                    Sort Code <?php echo $bank_code; ?><br>
                    Account No. - <?php echo $bank_account_no; ?><br>
                    IBAN <?php echo $bank_iban; ?><br>
                    BIC - <?php echo $bank_bic; ?>
                </td>
                <td>
                    Company Registration Number<br>
                    <?php echo $company_registration_number; ?><br><hr>
                    VAT Registration Number<br>
                    <?php echo $vat_registration_number; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="text-align: center;"><b>Thank you for your business.</b></td>
            </tr>
        </table>
    </body>
</html>