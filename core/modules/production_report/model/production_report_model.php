<?php
use \core\libs as core;

class Production_Report_Model extends core\Model {
		
	 function __construct() {
		 parent::__construct();
	 }
	
	public function getFacultyList () {
		return $this->db->select('SELECT id, shortname, longname FROM production_report_faculty');
	}
	
	public function getStatusList () {
		return $this->db->select('SELECT id, status, description FROM production_report_status');
	}

	public function getUnitStatusList () {
		return $this->db->select('SELECT prus.status_date, prus.faculty_id, prus.status_id, prf.shortname, prs.status, no_units, percent FROM production_report_unit_status prus INNER JOIN production_report_faculty prf ON prus.faculty_id = prf.id INNER JOIN production_report_status prs ON prus.status_id = prs.id ORDER BY prus.status_date, prf.shortname ASC');
	}
	
	public function createUnitStatus ($data) {
	
		//GetData 
		$postData =  array (
			'status_date' => $data['status_date'],
			'faculty_id' => $data['faculty_id'],
			'status_id' => $data['status_id'],
			'no_units' => $data['no_units'],
			'percent' => $data['percent']
		);
		
		foreach ($postData as $key => $value) {
			if (empty($value)&& $value != '0') {
				unset($postData[$key]);
			}
		}
		
		$this->db->insert('production_report_unit_status', $postData);
	
	}
	
	public function editSave ($data) {

		$postData = array (
			'status_date' => $data['status_date'],
			'faculty_id' => $data['faculty_id'],
			'status_id' => $data['status_id'],
			'unit_no' => $data['unit_no'],
			'percentage' => $data['percentage']
		);
		
		// If the field is left empty - do not update it ((should be specific to password only - UPDATE THIS))
		foreach ($postData as $key => $value) {
			if (empty($value)&& $value != '0') {
				unset($postData[$key]);
			}
		}
		
		$this->db->update('production_report_unit_status', $postData ,"`user_id` = {$data['user_id']}");

	}
	
	public function deleteFaculty($id) {
		
		/* Don't delete admin
		$r = $this->db->select1('SELECT permission_level FROM or_users WHERE id = :id',array(':id' => $id));
				
		if ($r['permission_level']==0) {
			return false;
		}
		*/
		$this->db->delete('production_report_faculty',"id = $id");
	}
	public function deleteStatus($id) {
		
		/* Don't delete admin
		$r = $this->db->select1('SELECT permission_level FROM or_users WHERE id = :id',array(':id' => $id));
				
		if ($r['permission_level']==0) {
			return false;
		}
		*/
		$this->db->delete('production_report_status',"id = $id");
	}
	public function deleteUnitStatus($status_date, $faculty_id, $status_id) {
		
		/* Don't delete admin
		$r = $this->db->select1('SELECT permission_level FROM or_users WHERE id = :id',array(':id' => $id));
				
		if ($r['permission_level']==0) {
			return false;
		}
		*/
		$this->db->delete('production_report_unit_status',"($status_date,$faculty_id,$status_id) in (status_date,faculty_id,status_id)");
	}
}
