<?php defined('BASEPATH') OR exit('') ?>

<div class='col-sm-6'>
    <?= isset($range) && !empty($range) ? $range : ""; ?>
</div>

<div class='col-sm-6 text-right'><b>Produits Total des prix:</b> FCFA <?=$cum_total ? number_format($cum_total, 2) : '0.00'?></div>

<div>
    <div class='col-xs-12'>
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">Produits</div>
            <?php if($allItems): ?>
            <div class="table table-responsive">
                <table class="table table-bordered table-striped" style="background-color: #f5f5f5">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>NOM</th>
                            <th>CODE</th>
                            <th>DESCRIPTION</th>
                            <th>QTE EN STOCK</th>
                            <th>PRIX UNIT.</th>
                            <th>TOTAL VENDU</th>
                            <th>TOTAL VENDU SUR LE PDT</th>
                            <th class = "hidden-print">MODIFIER QTE</th>
                            <th class = "hidden-print">MODIFIER</th>
                            <th class = "hidden-print">SUPPRIMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allItems as $get): ?>
                        <tr>
                            <input type="hidden" value="<?=$get->id?>" class="curItemId">
                            <th class="itemSN"><?=$sn?>.</th>
                            <td><span id="itemName-<?=$get->id?>"><?=$get->name?></span></td>
                            <td><span id="itemCode-<?=$get->id?>"><?=$get->code?></td>
                            <td>
                                <span id="itemDesc-<?=$get->id?>" data-toggle="tooltip" title="<?=$get->description?>" data-placement="auto">
                                    <?=word_limiter($get->description, 15)?>
                                </span>
                            </td>
                            <td class="<?=$get->quantity <= 10 ? 'bg-danger' : ($get->quantity <= 25 ? 'bg-warning' : '')?>">
                                <span id="itemQuantity-<?=$get->id?>"><?=$get->quantity?></span>
                            </td>
                            <td>FCFA <span id="itemPrice-<?=$get->id?>"><?=number_format($get->unitPrice, 2)?></span></td>
                            <td><?=$this->genmod->gettablecol('transactions', 'SUM(quantity)', 'itemCode', $get->code)?></td>
                            <td>
                                FCFA <?=number_format($this->genmod->gettablecol('transactions', 'SUM(totalPrice)', 'itemCode', $get->code), 2)?>
                            </td>
                            <td class="hidden-print"><a class="pointer updateStock" id="stock-<?=$get->id?>">Modifier Quantité</a></td>
                            <td class="text-center text-primary hidden-print">
                                <span class= "editItem" id="edit-<?=$get->id?>"><i class="fa fa-pencil pointer"></i> </span>
                            </td>
                            <td class="text-center hidden-print"><i class="fa fa-trash text-danger delItem pointer"></i></td>
                        </tr>
                        <?php $sn++; ?>
                        <?php endforeach; ?>
                        
                        <?php $sn = 1; ?>
                    </tbody>
                </table>
            </div>
            <!-- table div end-->
            <?php else: ?>
            <ul><li>Pas de produits</li></ul>
            <?php endif; ?>
        </div>
        <!--- panel end-->
    </div>
</div>
<div class="row hidden-print">
    <div class="col-sm-12">
        <div class="text-center">
           <!-- <button type="button" id ="PrintItemsBtn" class="btn btn-primary ptr"> -->
                <button type="button" class="btn btn-primary" id="PrintItemsBtn" onclick="imprimerProduits();">   
                <i class="fa fa-print"></i> Imprimer Liste Produits
            </button>
        </div>
    </div>
</div>
<!---Pagination div-->
<div class="col-sm-12 text-center">
    <ul class="pagination">
        <?= isset($links) ? $links : "" ?>
    </ul>
</div>

<div id="produitsListe" class=" text-center hidden">
Liste des produits WANDJI-CHICHA le <?=date('d-m-Y h:i:s') ?>
    <div class='col-xs-12'>
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading"></div>
            <?php if($allItems): ?>
            <div class="table table-responsive">
                <table class="table table-bordered table-striped" style="background-color: #f5f5f5;">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>NOM</th>
                            <th>QTE EN STOCK</th>
                            <th>PRIX UNIT.</th>
                            <th>TOTAL VENDU</th>
                            <th>TOTAL VENDU SUR LE PDT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allItems as $get): ?>
                        <tr>
                            <input type="hidden" value="<?=$get->id?>" class="curItemId">
                            <th class="itemSN"><?=$sn?>.</th>
                            <td><span id="itemName-<?=$get->id?>"><?=$get->name?></span></td>
                            <td class="<?=$get->quantity <= 10 ? 'bg-danger' : ($get->quantity <= 25 ? 'bg-warning' : '')?>">
                                <span id="itemQuantity-<?=$get->id?>"><?=$get->quantity?></span>
                            </td>
                            <td> <span id="itemPrice-<?=$get->id?>"><?=number_format($get->unitPrice, 2)?></span> FCFA</td>
                            <td><?=$this->genmod->gettablecol('transactions', 'SUM(quantity)', 'itemCode', $get->code)?></td>
                            <td>
                                 <?=number_format($this->genmod->gettablecol('transactions', 'SUM(totalPrice)', 'itemCode', $get->code), 2)?> FCFA
                            </td>
                        </tr>
                        <?php $sn++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- table div end-->
            <?php else: ?>
            <ul><li>Pas de produits</li></ul>
            <?php endif; ?>
        </div>
        <!--- panel end-->
    </div>
</div>
<script type = "text/javascript">
    function imprimerProduits() {
        var divToPrint=document.getElementById("produitsListe");
        newWin= window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }
</script>
