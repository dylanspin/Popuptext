
<?php

class ModMelding {

  function checkManager()
  {
    $user = JFactory::getUser();
    $groups = $user->groups;

    if (in_array(6, $groups)) {
       return true;
    } elseif ($user->get('isRoot')) {
       return true;
    } else {
       return false;
    }
  }

  public function select($id){

     $db = JFactory::getDbo();
     $query = $db->getQuery(true);
     $query->select('*');
     $query->from($db->quoteName('#__melding'));
     $query->where($db->quoteName('id')." = ".$db->quote($id));

     $db->setQuery($query);
     $result = $db->loadRow();

     if ($result) {
        return new Data($result[0],$result[1], true);
     } else {
        return new Data(0,'',false);
     }
  }

  public function update($id, $value){

     $db = JFactory::getDbo();

     $query = $db->getQuery(true);

     $fields = array(
        $db->quoteName('bericht') . ' = ' . $db->quote($value),
        $db->quoteName('id') . ' = ' . $id
     );

     $conditions = array(
        $db->quoteName('id') . ' = ' . $id
     );

     $query->update($db->quoteName('#__melding'))->set($fields)->where($conditions);

     $db->setQuery($query);

     $result = $db->execute();
  }

  function refresh(){
    echo "<script>
              if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
                location.reload(true);
              }
            </script>";
  }

}

class Data {
   public $id;
   public $bericht;

   public function __construct($id,$bericht = "",$succes = false) {
      $this->id = $id;
      $this->bericht = $bericht;
      $this->succes = $succes;
   }
}
 ?>
