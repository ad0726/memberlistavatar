<?php
/**
*
* @package phpBB Extension - Nom Extension
* @copyright (c) 2015 Votre Pseudo
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace mazeltof\memberlistavatar\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
    static public function getSubscribedEvents()
    {
        return [
			'core.memberlist_team_modify_query'         => 'memberlist_team_modify_query',
			'core.memberlist_team_modify_template_vars' => 'memberlist_team_modify_template_vars'
        ];
	}

    public function memberlist_team_modify_query($event)
    {
		$sql_ary       	   = $event['sql_ary'];

		$sql_ary['SELECT'] = "u.user_id, u.group_id as default_group, u.username, u.username_clean, u.user_colour, u.user_type, u.user_rank, u.user_posts, u.user_allow_pm, u.user_avatar, g.group_id";

		$event['sql_ary']  = $sql_ary;
	}

	public function memberlist_team_modify_template_vars($event)
	{
		$row           = $event['row'];
		$template_vars = $event['template_vars'];

		$template_vars['AVATAR_IMG']    = $row['user_avatar'];
		$event['template_vars']		    = $template_vars;
	}
}
