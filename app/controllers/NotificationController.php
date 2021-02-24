<?php
/*
* MyUCP
*/

class NotificationController extends Controller {

	/*
	$data = [
		'not_title'			=>	'TITLE|Test Notification For Group 0',
		'not_text'			=>	'TEXT|Test Notification For Group 0',
		'not_created_by'	=>	 IsOnline()->user_id,
	];
	*/
	public function notify($data = NULL, $groupid = NULL, $id = [5,6]) {
		model('Notification','User');
		if(!empty($groupid) && empty($id))
		{
			#Notify All Group Users from $groupid array
			foreach ($groupid as $k => $item) {
				$user = $this->UserModel->getUser($item,'user_group');
				foreach($user as $item)
					$GroupUsers[] = $item['user_id'];
			}
			foreach ($GroupUsers as $k => $item) {
					$data['user_id'] = (empty($item['user_id'])) ? $item : $item['user_id'];
					$this->NotificationModel->SendNotification($data);
			}
		}	
		elseif(empty($groupid) && empty($id))
		{
			#NotifyAllUsers (expect 0 group)
			$users = Builder::table('users')->where('user_group','>=', "1")->get();
			foreach ($users as $k => $item) 
			{
				$data['user_id'] = (empty($item['user_id'])) ? $item : $item['user_id'];
				$this->NotificationModel->SendNotification($data);
			}
		}
		elseif(empty($groupid) && !empty($id))
		{
			#NotifyAllFrom $id array
			foreach($id as $data['user_id'])
				$this->NotificationModel->SendNotification($data);

		}
	}

	public function getNotifications($userid = session('user_id'))
	{
		model('Notification');
		return $this->NotificationModel->getNotifications($userid);
	}
}