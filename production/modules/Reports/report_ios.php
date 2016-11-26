<?php
// List User Group
$sql_list = "SELECT
                    *                    
           FROM tmp_etl_ios";
$rs_list = $db->GetAll($sql_list);
?>
<?= MainWeb::openTemplate(); ?>
<p class="text-muted font-13 m-b-30">iOs reports </p>
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
            </tr>
        <?php } // End For  ?>
    </tbody>
</table>
<?= MainWeb::closeTemplate(); ?>
<script src="./modules/<?= $Config['modules'] ?>/<?= $Config['page'] ?>.js"></script>