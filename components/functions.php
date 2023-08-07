
<!-- To prompt error messages -->

<?php
function prompt($prompt){
   $html = '';
   if (!empty($prompt) && is_array($prompt)) {
      foreach($prompt as $message){
         $html .= '
            <div class="panel green padding-15">
               <h3>'.$message.'
               <i class="fas fa fa-times pointer " style="margin-left:80%"  onclick="this.parentElement.remove();">X</i>
            </div>
         ';
      }
   }
   return $html;
}

$prompt = isset($prompt) ? $prompt : [];

?>