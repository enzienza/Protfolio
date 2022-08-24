<?php
/**
 * Name file: API-index
 * Description: group all API files of the theme here
 *
 * @package WordPress
 * @subpackage MyPortfolio
 * @since 1.0.0
 */


/**
 * OP_Profile
 * group all profile files
 */
require_once ('OP_profile/01-personalDetails.php');
require_once ('OP_profile/02-media.php');
require_once ('OP_profile/03-network.php');
require_once ('OP_profile/04-aboutme.php');
require_once ('OP_profile/05-curriculum.php');


/**
 * OP_theme
 * group all custom theme files
 */
require_once ('OP_theme/01-customtheme.php');
require_once ('OP_theme/02-core.php');
require_once ('OP_theme/03-home.php');
require_once ('OP_theme/04-about.php');
require_once ('OP_theme/05-portfolio.php');