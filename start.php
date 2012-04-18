<?php 

	function group_multiple_admin_init(){
		// extend css
		elgg_extend_view("css", "group_multiple_admin/css");
		
		// add group option
		add_group_tool_option("group_multiple_admin_allow", elgg_echo("group_multiple_admin:group_tool_option"), false);
	}

	function group_multiple_admin_pagesetup(){
		
		if($user = get_loggedin_user()){
			$page_owner = page_owner_entity();
			
			if(($page_owner instanceof ElggGroup)){
				// extend group members sidebar list
				elgg_extend_view("groups/members", "group_multiple_admin/group_admins", 400);
				
				// remove group tool options for group admins
				if(($page_owner->getOwner() != $user->getGUID()) && !$user->isAdmin()){
					remove_group_tool_option("group_multiple_admin_allow");
				}
				
				// add user actions
				if(($page_owner->getOwner() == $user->getGUID()) || ($page_owner->group_multiple_admin_allow_enable == "yes" && $page_owner->canEdit())){
					elgg_extend_view("profile/menu/actions", "group_multiple_admin/profile_actions");
				}
			}
		}
	}
	
	function group_multiple_admin_can_edit_hook($hook, $type, $return_value, $params){
		$result = $return_value;
		
		if(!empty($params) && is_array($params) && !$result){
			if(array_key_exists("entity", $params) && array_key_exists("user", $params)){
				$entity = $params["entity"];
				$user = $params["user"];
				
				if(($entity instanceof ElggGroup) && ($user instanceof ElggUser)){
					if($entity->isMember($user) && check_entity_relationship($user->getGUID(), "group_admin", $entity->getGUID())){
						$result = true;
					}
				}
			}
		}
		
		return $result;
	}
	
	function group_multiple_admin_group_leave($event, $type, $params){
		
		if(!empty($params) && is_array($params)){
			if(array_key_exists("group", $params) && array_key_exists("user", $params)){
				$entity = $params["group"];
				$user = $params["user"];
				
				if(($entity instanceof ElggGroup) && ($user instanceof ElggUser)){
					if(check_entity_relationship($user->getGUID(), "group_admin", $entity->getGUID())){
						return remove_entity_relationship($user->getGUID(), "group_admin", $entity->getGUID());
					}
				}
			}
		}
	}

	//register default Elgg events
	register_elgg_event_handler("init", "system", "group_multiple_admin_init"); 
	register_elgg_event_handler("pagesetup", "system", "group_multiple_admin_pagesetup"); 

	// register plugin hooks
	register_plugin_hook("permissions_check", "group", "group_multiple_admin_can_edit_hook");
	
	// register event handlers
	register_elgg_event_handler("leave", "group", "group_multiple_admin_group_leave");

	// register actions
	register_action("group_multiple_admin/toggle_admin", false, dirname(__FILE__) . "/actions/toggle_admin.php");
	
?>