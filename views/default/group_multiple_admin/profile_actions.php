<?php 

	$user = $vars["entity"];
	$page_owner = page_owner_entity();

	if($page_owner instanceof ElggGroup){
		if($page_owner->canEdit() && $page_owner->isMember($user) && ($page_owner->getOwner() != $user->getGUID())){
			if(check_entity_relationship($user->getGUID(), "group_admin", $page_owner->getGUID())){
				$text = elgg_echo("group_multiple_admin:profile_actions:remove");
			} else {
				$text = elgg_echo("group_multiple_admin:profile_actions:add");
			}
			
			echo elgg_view("output/confirmlink", array("href" => $vars["url"] . "action/group_multiple_admin/toggle_admin?group_guid=" . $page_owner->getGUID() . "&user_guid=" . $user->getGUID(), "text" => $text));
		}
	}

?>