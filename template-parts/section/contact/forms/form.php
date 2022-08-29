<?php
/**
 * Name file: form
 * Description: show form on contact section
 * Important : use hooks get_locale()
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */
?>


<?php if(get_locale() === 'fr_FR') : // Partie FR =============== ?>
   <div>
       <input type="text">
       <button>Envoyer</button>
   </div>
<?php elseif(get_locale() === 'en_GB') : // Partie EN =========== ?>
    <div>
       <input type="text">
       <button>Envoyer</button>
   </div>
<?php elseif(get_locale() === 'it_IT') : // Partie IT =========== ?>
    <div>
       <input type="text">
       <button>Envoyer</button>
   </div>
<?php endif; ?>