<?php
// List User Group
$sql_list = "SELECT
                    *                    
           FROM tmp_etl_facebook";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?>
<p class="text-muted font-13 m-b-30">Facebook reports </p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive  bulk_action data-table" id="table_<?= $Config['page'] ?>">
    <thead>
        <tr>
            <th>TaxInvoice</th>
            <th>LogIDX</th>
            <th>CSN</th>
            <th>UID</th>
            <th>PUserNo</th>
            <th>PUserID</th>
            <th>GUserNo</th>
            <th>FacebookID</th>
            <th>PGCode</th>
            <th>TransactionID</th>
            <th>Currency</th>
            <th>ExchangeRate</th>
            <th>Price</th>
            <th>Commission</th>
            <th>TDEShare</th>
            <th>Unit</th>
            <th>FXRateTHB</th>
            <th>PriceExcludVAT</th>
            <th>VAT</th>
            <th>PriceTHB</th>
            <th>CommTHB</th>
            <th>TDEShareTHB</th>
            <th>Amount</th>
            <th>ExtraAmount</th>
            <th>TotalAmount</th>
            <th>UseState</th>
            <th>PurchaseDate</th>
            <th>CreateDate</th>
            <th>SettleDate</th>
            <th>UpdateDate</th>
            <th>RefundDate</th>
            <th>Country</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td><?= $rs_list[$i]['TaxInvoice'] ?></td>
                <td><?= $rs_list[$i]['LogIDX'] ?></td>
                <td><?= $rs_list[$i]['CSN'] ?></td>
                <td><?= $rs_list[$i]['UID'] ?></td>
                <td><?= $rs_list[$i]['PUserNo'] ?></td>
                <td><?= $rs_list[$i]['PUserID'] ?></td>
                <td><?= $rs_list[$i]['GUserNo'] ?></td>
                <td><?= $rs_list[$i]['FacebookID'] ?></td>
                <td><?= $rs_list[$i]['PGCode'] ?></td>
                <td><?= $rs_list[$i]['TransactionID'] ?></td>
                <td><?= $rs_list[$i]['Currency'] ?></td>
                <td><?= $rs_list[$i]['ExchangeRate'] ?></td>
                <td><?= $rs_list[$i]['Price'] ?></td>
                <td><?= $rs_list[$i]['Commission'] ?></td> 
                <td><?= $rs_list[$i]['TDEShare'] ?></td>
                <td><?= $rs_list[$i]['Unit'] ?></td>
                <td><?= $rs_list[$i]['FXRateTHB'] ?></td>
                <td><?= $rs_list[$i]['PriceExcludVAT'] ?></td>
                <td><?= $rs_list[$i]['VAT'] ?></td>
                <td><?= $rs_list[$i]['PriceTHB'] ?></td>
                <td><?= $rs_list[$i]['CommTHB'] ?></td>
                <td><?= $rs_list[$i]['TDEShareTHB'] ?></td>
                <td><?= $rs_list[$i]['Amount'] ?></td>
                <td><?= $rs_list[$i]['ExtraAmount'] ?></td>
                <td><?= $rs_list[$i]['TotalAmount'] ?></td>
                <td><?= $rs_list[$i]['UseState'] ?></td>
                <td><?= $rs_list[$i]['PurchaseDate'] ?></td>
                <td><?= $rs_list[$i]['CreateDate'] ?></td>
                <td><?= $rs_list[$i]['SettleDate'] ?></td>
                <td><?= $rs_list[$i]['UpdateDate'] ?></td>
                <td><?= $rs_list[$i]['RefundDate'] ?></td>
                <td><?= $rs_list[$i]['Country'] ?></td>               
            </tr>
        <?php } // End For  ?>
    </tbody>
</table>
<?= MainWeb::closeTemplate(); ?>
<script src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script>