<?php
class CVModel extends PostgresModel
{
  private static $instance = null;
  private static function getInstance()
  {
    if (CVModel::$instance == null) {
      CVModel::$instance = new CVModel();
    }
    return CVModel::$instance;
  }

  public static function update(array $postData, int $cvId)
  {
    foreach ($postData as &$ele) {
      $ele = "'" . $ele . "'";
    }
    $UserID = $_SESSION['id'];
    $Name = $postData['name'];
    $Phone = $postData['phone'];
    $Mail = $postData['mail'];
    $Web = $postData['web'];
    $Place = $postData['place'];
    $About = $postData['about'];
    $company1 = $postData['company1'];
    $period1 = $postData['period1'];
    $role1 = $postData['role1'];
    $companydes1 = $postData['companydes1'];
    $company2 = $postData['company2'];
    $period2 = $postData['period2'];
    $role2 = $postData['role2'];
    $companydes2 = $postData['companydes2'];
    $company3 = $postData['company3'];
    $period3 = $postData['period3'];
    $role3 = $postData['role3'];
    $companydes3 = $postData['companydes3'];
    $_1 = $postData['skill1'];
    $_2 = $postData['skill2'];
    $_3 = $postData['skill3'];
    $_4 = $postData['skill4'];
    $_5 = $postData['skill5'];
    $_6 = $postData['skill6'];
    $slide1 = $postData['slide1'];
    $slide2 = $postData['slide2'];
    $slide3 = $postData['slide3'];
    $slide4 = $postData['slide4'];
    $slide5 = $postData['slide5'];
    $slide6 = $postData['slide6'];
    $hobbies = $postData['hobbies'];

    $query = 'UPDATE templates SET name = ' . $Name . ' , phone = ' . $Phone . ', mail = ' . $Mail . ', web = ' . $Web . ', place = ' . $Place . ', about = ' . $About . ',	company1 = ' . $company1 . ', period1 = ' . $period1 . ', role1 = ' . $role1 . ', companydes1 = ' . $companydes1 . ', company2 = ' . $company2 . ', period2 = ' . $period2 . ', role2 = ' . $role2 . ', companydes2 = ' . $companydes2 . ', company3 = ' . $company3 . ', period3 = ' . $period3 . ', role3 = ' . $role3 . ', companydes3 = ' . $companydes3 . ', skill1 = ' . $_1 . ', skill2 = ' . $_2 . ', skill3 = ' . $_3 . ', skill4 = ' . $_4 . ', skill5 = ' . $_5 . ', skill6 = ' . $_6 . ', slide1 = ' . $slide1 . ', slide2 = ' . $slide2 . ', slide3 = ' . $slide3 . ', slide4 = ' . $slide4 . ', slide5 = ' . $slide5 . ', slide6 = ' . $slide6 . ', hobbies = ' . $hobbies . ', UserID =' . $UserID . ' WHERE id = ' . $cvId . '';
    CVModel::getInstance()->run($query);
    $response = new ModelResponse();
    $response->message = "OK";
    return $response;
  }

  public static function insert(array $postData)
  {
    foreach ($postData as &$ele) {
      if ($ele == '') $ele = 'None';
      $ele = "'" . $ele . "'";
    }
    $UserID = $_SESSION['id'];
    $Name = $postData['name'];
    $Phone = $postData['phone'];
    $Mail = $postData['mail'];
    $Web = $postData['web'];
    $Place = $postData['place'];
    $About = $postData['about'];
    $company1 = $postData['company1'];
    $period1 = $postData['period1'];
    $role1 = $postData['role1'];
    $companydes1 = $postData['companydes1'];
    $company2 = $postData['company2'];
    $period2 = $postData['period2'];
    $role2 = $postData['role2'];
    $companydes2 = $postData['companydes2'];
    $company3 = $postData['company3'];
    $period3 = $postData['period3'];
    $role3 = $postData['role3'];
    $companydes3 = $postData['companydes3'];
    $_1 = $postData['skill1'];
    $_2 = $postData['skill2'];
    $_3 = $postData['skill3'];
    $_4 = $postData['skill4'];
    $_5 = $postData['skill5'];
    $_6 = $postData['skill6'];
    $slide1 = $postData['slide1'];
    $slide2 = $postData['slide2'];
    $slide3 = $postData['slide3'];
    $slide4 = $postData['slide4'];
    $slide5 = $postData['slide5'];
    $slide6 = $postData['slide6'];
    $hobbies = $postData['hobbies'];

    $query = 'INSERT INTO templates (name, phone, mail, web, place, about, company1, period1, role1, companydes1, company2, period2, role2, companydes2, company3,	period3, role3,	companydes3, skill1, skill2, skill3, skill4, skill5, skill6, slide1, slide2, slide3, slide4, slide5, slide6, hobbies, owner_id) VALUES (' . $Name . ', ' . $Phone . ', ' . $Mail . ', ' . $Web . ', ' . $Place . ', ' . $About . ', ' . $company1 . ', ' . $period1 . ', ' . $role1 . ', ' . $companydes1 . ', ' . $company2 . ', ' . $period2 . ', ' . $role2 . ', ' . $companydes2 . ', ' . $company3 . ', ' . $period3 . ', ' . $role3 . ', ' . $companydes3 . ', ' . $_1 . ', ' . $_2 . ', ' . $_3 . ', ' . $_4 . ', ' . $_5 . ', ' . $_6 . ', ' . $slide1 . ', ' . $slide2 . ', ' . $slide3 . ', ' . $slide4 . ', ' . $slide5 . ', ' . $slide6 . ', ' . $hobbies . ', ' . $UserID . ');';
    print($query);
    CVModel::getInstance()->run($query);
    $response = new ModelResponse();
    $response->message = "OK";
    return $response;
  }

  public static function all()
  {
    $response = new ModelResponse();
    $result = CVModel::getInstance()->run("SELECT name, templates.id, users.username FROM templates LEFT JOIN users ON templates.owner_id = users.id");
    // $result = CVModel::getInstance()->run("SELECT * FROM templates WHERE cvID = " . $id . "");
    $response->query_result = $result;
    return $response;
  }
}
