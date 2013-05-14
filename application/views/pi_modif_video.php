  <style>
	.pop-in{width:510px;height:349px;background:#eff4f3;padding:31px 0 75px;border:1px solid #bbbbbb;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;}
	.pop-in p{margin:0 15px 31px;float:left;font-size:18px;color:#4e4e4e;}
	.pop-in img{margin-left:315px;float:left}
	.content-pi {background:#fafafa;width:510px;height:233px;padding: 25px 0;border:1px solid #e0e4e6;border-left:none;border-right:none;clear:both;}
	.content-pi .label {width:123px;padding:0 12px 0 0;float:left;margin:15px 0 0 0;text-align:right;font-size:16px;color:#4e4e4e;}
	.content-pi .label img{width:85px;height:73px;margin-left:40px;}
	.content-pi .champs {width:306px;float:left;margin:15px 0 0 12px;}
	.content-pi .champs input{width:296px;padding:0 5px;outline:none}
	.content-pi .champs select{width:296px;padding:0 0 0 5px;outline:none}
	.content-pi .champs .descript-vid{width:296px;padding:0 5px;height:73px;outline:none;word-break:break-word;}
	.content-pi input[type="submit"]{clear:both;width: 80px;height: 30px;margin: 10px 145px;background:url('bt-rouge.png');color:white;}
  </style>
<div class="pop-in">
  <p> Modifier la video </p>
  <img src="pop_close.png" alt="Fermer" />
  <div class="content-pi">
    <form>
		<div class="label">
			<label>URL de la video </label>
		</div>
		<div class="champs">
			<input type="text">
		</div>
		<div class="label">
			<label>Album</label>
		</div>
		<div class="champs">
			<select>
			<option value="1">1</option>
		</select>
		</div>
		<div class="label">
			<img src="apercu_vid.png" alt="visuel video" />
		</div>
		<div class="champs">
			<input type="textarea" class="descript-vid" maxlength="110">
		</div>
		<input type="submit" value="valider">
	</form>
  </div>
</div>