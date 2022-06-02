<?php

class viewCVModel extends Model
{
  private $ID;

  public function loadParams($id)
  {
    $this->ID = $id;
  }

  public function executeQuery()
  {
    // get all users
    $query = "SELECT * FROM templates WHERE cvID = " . $this->ID . "";
    if ($statement = $this->dbInstance->prepare($query)) {
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
    $arr = array();
    if ($statement->execute()) {
      $statement->store_result();
      $statement->bind_result($cvID, $UserID, $Name, $Phone, $Mail, $Web, $Place, $About, $company1, $period1, $role1, $companydes1, $company2, $period2, $role2, $companydes2, $company3, $period3, $role3,  $companydes3, $skill1, $skill2, $skill3, $skill4, $skill5, $skill6, $slide1, $slide2, $slide3, $slide4, $slide5, $slide6, $hobbies);
      if ($statement->num_rows < 1) {
        $this->result['message'] = 'Cannot find a CV with such ID.';
        return;
      }
      while ($statement->fetch()) {
        $arr['cvID'] = $cvID;
        $arr['UserID'] = $UserID;
        $arr['Name'] = $Name;
        $arr['Phone'] = $Phone;
        $arr['Mail'] = $Mail;
        $arr['Web'] = $Web;
        $arr['Place'] = $Place;
        $arr['About'] = $About;
        $arr['company1'] = $company1;
        $arr['period1'] = $period1;
        $arr['role1'] = $role1;
        $arr['companydes1'] = $companydes1;
        $arr['company2'] = $company2;
        $arr['period2'] = $period2;
        $arr['role2'] = $role2;
        $arr['companydes2'] = $companydes2;
        $arr['company3'] = $company3;
        $arr['period3'] = $period3;
        $arr['role3'] = $role3;
        $arr['companydes3'] = $companydes3;
        $arr['skill1'] = $skill1;
        $arr['skill2'] = $skill2;
        $arr['skill3'] = $skill3;
        $arr['skill4'] = $skill4;
        $arr['skill5'] = $skill5;
        $arr['skill6'] = $skill6;
        $arr['slide1'] = $slide1;
        $arr['slide2'] = $slide2;
        $arr['slide3'] = $slide3;
        $arr['slide4'] = $slide4;
        $arr['slide5'] = $slide5;
        $arr['slide6'] = $slide6;
        $arr['hobbies'] = $hobbies;
      }
      $this->result['data'] = [$arr];
      $this->result['message'] = 'OK';
      return;
    } else {
      $this->result['message'] = 'Something went wrong. Please try again later.';
      return;
    }
  }
}
