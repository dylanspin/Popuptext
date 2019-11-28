<script>
  var check = true;
  function close_(){
    document.getElementById('melding_').classList.add('melding_none');
    // document.getElementById('melding_').style.display = "none";
  }
  function editBericht(){
    if(check){
      check = false
      document.getElementById('melding_form').style.display = "block";
    }
    else{
      document.getElementById('melding_form').style.display = "none";
      check = true;
    }
  }
</script>
<?php
  //params
  $achtergrond = $params->get('module_kleur');
  $kleurText = $params->get('text_kleur');
  $hoogte = $params->get('module_hoogte');
  $text = $params->get('text');
  $font = $params->get('font');
  $check = $params->get('berichtcheck');

  $helper = new ModMelding();
  $data = $helper->select(1);
  $berichtDB = $data->bericht;

  $doc = JFactory::getDocument();
  $modulePath = JURI::base() . 'modules/mod_melding/';
  $doc->addStyleSheet($modulePath.'css/style.css');
  // $doc->addScript('modules/mod_melding/js/javascript.js');

  $css = "
    .melding_{
      height:".$hoogte."px;
      background-color:".$achtergrond.";
      color:".$kleurText."
    }
  	.melding_close_ ,  .melding_edit_ , .melding_{
      color:".$kleurText.";
    }
    .melding_text_{
      font-size:".$font."px;
    }
  ";

  $checklogin =  $helper->checkManager();
  $doc->addStyleDeclaration($css);//add de css aan style.css

  if(strlen($berichtDB) > 0){
    $current =   $berichtDB;
  }
  else{
    $current = $text;
  }

  if (isset($_POST["UpdateBericht"])) {
        $textUpdate = $_POST['BerichtInhoud'];
        $helper->update(1, $textUpdate);
        $helper->refresh();
  }

  if($check){
 ?>
 <div class="melding_form" id="melding_form">
   <h1 class="melding_form_kop">Bericht</h1>
   <button class="melding_close_form" onclick="editBericht()">
         <i class="fa fa-times"></i>
   </button>
   <form class="" method="post">
     <textarea type="text" name="BerichtInhoud" placeholder="Bericht..." class="melding_textarea" rows="5" cols="40">
<?php echo $current;?>
     </textarea>
     <button type="submit" name="UpdateBericht" class="melding_submit">Sla op</button>
   </form>
 </div>
   <div class="melding_" id="melding_">
     <div class="melding_text_">
       <?php
         if (isset($_POST["UpdateBericht"])) {
           echo $current;
         }
         else{
          echo $current;
         }
        ?>
     </div>
    <button class="melding_close_ melding_button" type="button" name="button" id="close" onclick="close_()">
      <i class="fa fa-times"></i>
    </button>
    <?php
      if($checklogin){
        echo "<button class='melding_edit_ melding_button' type='button' name='button' id='edit' onclick='editBericht()'>
                <i class='fa fa-pencil'></i>
              </button>";
      }
     ?>
   </div>
<?php
  }
?>
