<?php
defined('BASEPATH') OR exit('');
?>

<?php echo isset($range) && !empty($range) ? "Showing ".$range : ""?>
<div class="panel panel-primary">
    <div class="panel-heading">COMPTES UTILISATEURS</div>
    <?php if($allAdministrators):?>
    <div class="table table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>NOM</th>
                    <th>E-MAIL</th>
                    <th>TELEPHONE</th>
                    <th>WORK</th>
                    <th>ROLE</th>
                    <th>DATE CREATION</th>
                    <th>DERNIERE CONNEXION</th>
                    <th>MODIFIER</th>
                    <th>ETAT </th>
                    <th>SUPPRIMER</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($allAdministrators as $get):?>
                    <tr>
                        <th><?=$sn?>.</th>
                        <td class="adminName"><?=$get->first_name ." ". $get->last_name?></td>
                        <td class="hidden firstName"><?=$get->first_name?></td>
                        <td class="hidden lastName"><?=$get->last_name?></td>
                        <td class="adminEmail"><?=mailto($get->email)?></td>
                        <td class="adminMobile1"><?=$get->mobile1?></td>
                        <td class="adminMobile2"><?=$get->mobile2?></td>
                        <td class="adminRole"><?=ucfirst($get->role)?></td>
                        <td><?=date('jS M, Y h:i:sa', strtotime($get->created_on))?></td>
                        <td>
                            <?=$get->last_login === "0000-00-00 00:00:00" ? "---" : date('jS M, Y h:i:sa', strtotime($get->last_login))?>
                        </td>
                        <?php if($get->id === $this->session->admin_id):?>
                        <td class="text-center editAdmin" id="edit-<?=$get->id?>">
                            <i class="fa fa-pencil pointer"></i>
                        </td>
                        <?php else: ?> <td>X</td> 
                        <?php endif; ?>
                    <?php if($this->session->admin_role === "Super"):?>
                        <td class="text-center suspendAdmin text-success" id="sus-<?=$get->id?>">
                            <?php if($get->account_status === "1"): ?>
                            <i class="fa fa-toggle-on pointer"></i>
                            <?php else: ?>
                            <i class="fa fa-toggle-off pointer"></i>
                            <?php endif; ?>
                        </td>
                    <?php else: ?> <td>Activé</td>       
                    <?php endif; ?>
                        <?php if($this->session->admin_role === "Super"):?>
                        <td class="text-center text-danger deleteAdmin" id="del-<?=$get->id?>">
                            <?php if($get->deleted === "1"): ?>
                            <a class="pointer">Annuler la Suppression</a>
                            <?php else: ?>
                            <i class="fa fa-trash pointer"></i>
                            <?php endif; ?>
                        </td>
						<?php else: ?> <td>X</td>
						<?php endif; ?>
                    </tr>
                    <?php $sn++;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php else:?>
    Aucun compte utilisateur
    <?php endif; ?>
</div>
<!-- Pagination -->
<div class="row text-center">
    <?php echo isset($links) ? $links : ""?>
</div>
<!-- Pagination ends -->