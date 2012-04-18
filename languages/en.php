<?php 

	$english = array(
		'group_multiple_admins' => "Group multiple admins",
		
		// views
		// group tool option
		'group_multiple_admin:group_tool_option' => "Enable group admins to assign other group admins",	
	
		// profile actions
		'group_multiple_admin:profile_actions:remove' => "Remove group admin",
		'group_multiple_admin:profile_actions:add' => "Add group admin",
		
		// group admins
		'group_multiple_admins:group_admins' => "Group admins",
		
		// actions
		// toggle admin
		'group_multiple_admins:action:toggle_admin:error:input' => "Invalid input to perform this action",
		'group_multiple_admins:action:toggle_admin:error:group' => "The given input doesn't result in a group or you can't edit this group of the user is not a member",
		'group_multiple_admins:action:toggle_admin:error:remove' => "An unknown error occured while removing the user as a group admin",
		'group_multiple_admins:action:toggle_admin:error:add' => "An unknown error occured while adding the user as a group admin",
		'group_multiple_admins:action:toggle_admin:success:remove' => "The user was successfully removed as a group admin",
		'group_multiple_admins:action:toggle_admin:success:add' => "The user was successfully added as a group admin",
		
	);
	
	add_translation("en", $english);

?>