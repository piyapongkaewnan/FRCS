<?php
// List User Group
$sql_list = "SELECT
                    *                    
           FROM tmp_etl_google";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?>
<p class="text-muted font-13 m-b-30">Google reports </p>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered compact dt-responsive  bulk_action data-table" id="table_<?= $Config['page'] ?>">
    <thead>
        <tr>
            <th>Provider</th>
            <th>ProviderCountry</th>
            <th>SKU</th>
            <th>Developer</th>
            <th>Title</th>
            <th>Version</th>
            <th>Units</th>
            <th>DeveloperProceeds</th>
            <th>BeginDate</th>
            <th>EndDate</th>
            <th>CustomerCurrency</th>
            <th>CountryCode</th>
            <th>CurrencyOfProceeds</th>
            <th>AppleIdentifier</th>
            <th>CustomerPrice</th>
            <th>Column1</th>
            <th>ParentIdentifier</th>
            <th>FXRate</th>
            <th>AppTran</th>
            <th>Total</th>
            <th>Commiss</th>
            <th>Column2</th>
            <th>Column3</th>
            <th>Column4</th>
            <th>TaxInvoiceNo</th>           
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($rs_list); $i++) { ?>
            <tr>
                <td><?= $rs_list[$i]['Provider'] ?></td>
                <td><?= $rs_list[$i]['ProviderCountry'] ?></td>
                <td><?= $rs_list[$i]['SKU'] ?></td>
                <td><?= $rs_list[$i]['Developer'] ?></td>
                <td><?= $rs_list[$i]['Title'] ?></td>
                <td><?= $rs_list[$i]['Version'] ?></td>
                <td><?= $rs_list[$i]['Units'] ?></td>
                <td><?= $rs_list[$i]['DeveloperProceeds'] ?></td>
                <td><?= $rs_list[$i]['BeginDate'] ?></td>
                <td><?= $rs_list[$i]['EndDate'] ?></td>
                <td><?= $rs_list[$i]['CustomerCurrency'] ?></td>
                <td><?= $rs_list[$i]['CountryCode'] ?></td>
                <td><?= $rs_list[$i]['CurrencyOfProceeds'] ?></td>
                <td><?= $rs_list[$i]['AppleIdentifier'] ?></td>
                <td><?= $rs_list[$i]['CustomerPrice'] ?></td>
                <td><?= $rs_list[$i]['Column1'] ?></td>
                <td><?= $rs_list[$i]['ParentIdentifier'] ?></td>
                <td><?= $rs_list[$i]['FXRate'] ?></td>
                <td><?= $rs_list[$i]['AppTran'] ?></td>
                <td><?= $rs_list[$i]['Total'] ?></td>
                <td><?= $rs_list[$i]['Commiss'] ?></td>
                <td><?= $rs_list[$i]['Column2'] ?></td>
                <td><?= $rs_list[$i]['Column3'] ?></td>
                <td><?= $rs_list[$i]['Column4'] ?></td>
                <td><?= $rs_list[$i]['TaxInvoiceNo'] ?></td>
            </tr>
        <?php } // End For  ?>
    </tbody>
</table>
<?= MainWeb::closeTemplate(); ?>
<script src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script>