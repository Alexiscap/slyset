<link rel="stylesheet" type="text/css" href="<?php echo css_url('slyset') ?>" media="screen" />

<script  src="<?php echo js_url('jquery-1.8.3.min') ?>" media="screen" ></script>

<script  src="<?php echo js_url('slyset') ?>" media="screen" ></script>


<div class="pop-in_ta pop_in3 pop-in_center">
  <div class="elem_center">
  <span class="info">Informations</span><span  class="paiement">Paiement</span><span  class="telechargement et_active">Téléchargements</span>
  <div class="content-pi">
    <h2>Transaction réussie, merci d’avoir choisi Slyset !</h2>
	<div class="remercier">
		<p>Nous souhaitons seulement vous faire savoir... que votre <span>commande n°<?php echo $numero_cmd ?> a bien été prise en compte</span> ! Vous pouvez désormais télécharger et apprécier vos nouvelles acquisitions.</p>
		<p>Vous manquez de temps ? Rassurez-vous, vous pourrez télécharger vos morceaux, vos albums et vos partitions dans la rubrique <a href="<?php echo base_url('index.php/my-shopping/'.$this->session->userdata('uid')) ?>">Mes achats</a>.</p>
		<p>Vous recevrez sous peu un <span>email de confirmation</span> comprenant tout le détail de votre commande.</p>
		<p>L'équipe Slyset vous remercie de votre confiance et vous souhaite une bonne écoute !</p>
	</div>
	<div class="clear"></div>
	<h2>Téléchargez vos morceaux</h2>
	<div class="titre_achete">
		     <form class="last_tunnel" action="" method="post" accept-charset="utf-8">          

			<!--<table>
				<tr>
					<th class="article-checkbox checkbox-style2">
                        <input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all">
                        <label for="article-all">

                        </label>
                    </th>
					<th class="le_titre">Titre</th>
					<th class="artiste">Artiste</th>
					<th class="type">Type</th>
					<th class="dwl">Télécharger</th>
				</tr>

			<?php 
				$all_id = "";
				foreach($cmd_download as $dwld_cmd): ?>
				<tr>
					<td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="<?php echo $dwld_cmd->id_info ?>" id="article-<?php echo $dwld_cmd->id_info ?>" class="checkbox-article"><label for="article-<?php echo $dwld_cmd->id_info ?>"></label></td>



					<td class="le_titre"><?php echo $dwld_cmd->nom ?></td>
					<td class="artiste"><?php echo $dwld_cmd->user_login ?></td>
					<td class="type"><?php echo $dwld_cmd->type ?></td>
					<td class="dwl">
						<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid').'/'.$dwld_cmd->id_info,' <img src="'.img_url("common/telecharge.png").'" alt="Telecharger" />',array('class'=>'ctr_dnw')); ?>

						
					</td>
				</tr>
				
				<?php 
				$all_id .= $dwld_cmd->id_info."%20";
				endforeach;?>
			</table>-->
			<div id="articles-tab">
           
                <form action="http://127.0.0.1/slyset/index.php/admin_articles/delete_multi_article" method="post" accept-charset="utf-8" class="historiq_dwld">          
                    <table id="tablesorter-cb">
                        <thead>
                            <tr class="tab-head odd row-color-2">
                                <th class="article-checkbox checkbox-style2"><input type="checkbox" name="article-all" value="all" class="check_all checkbox-article" id="article-all"><label for="article-all"><span class="piste"></span></label></th>
                                <th class="article-title header">Titre<!--<span id="titre" class="filter filter-bottom"></span>--></th>
                                <th class="article-artiste header">Artiste<!--<span id="titre" class="filter filter-bottom"></span>--></th>
                                <th class="article-type header">Type<!--<span id="titre" class="filter filter-bottom"></span>--></th>
                                <th class="article-prix header">Télécharger<!--<span id="created" class="filter filter-bottom"></span>--></th>
                            </tr>
                        </thead>
                        <tbody>
                                                                <tr class="row-color-5 odd">
                                        <td class="article-checkbox checkbox-style2"><input type="checkbox" name="checkarticle[]" value="5" id="article-5" class="checkbox-article"><label for="article-5"><span class="piste"></span></label></td>
                                                                                    <td class="article-title"><a href="http://127.0.0.1/slyset/index.php/mc_musique/player/1/album/album one/3" class="play_achat open_player"><img src="http://127.0.0.1/slyset/assets/images/common/btn_play2.png" alt="Bouton play historique"></a>

                                        test</td>
                                        <td class="article-artiste">slyset</td>
                                        <td class="article-type">morceau</td>
                                        <td class="article-prix"><?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid').'/'.$dwld_cmd->id_info,' <img src="'.img_url("common/telecharge.png").'" alt="Telecharger" class="bt_dl_achat"/>',array('class'=>'ctr_dnw')); ?></td>
                                    </tr>
                                                            </tbody>
                    </table>
                </form>
            </div>
			</form>
	</div>
	<div class="clear"></div>
	<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid'),'<input type="submit" value="Télécharger" class="dl_black"/>',array('class'=>'ctr_dnw_part')); ?>

	<?php echo anchor('melo_achats/download_file/'.$this->session->userdata('uid').'/'.$all_id,'<input type="submit" value="Tout télécharger" class="dl_red"/>',array('class'=>'ctr_dnw')); ?>

	
	<div class="clear"></div>
  </div>
</div>
</div>