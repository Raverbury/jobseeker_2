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
  private function __construct()
  {
    parent::__construct();
  }
  public static function update(array $post_data, string $cvId)
  {
    $response = new ModelResponse();
    try {
      foreach ($post_data as &$ele) {
        $ele = "'" . htmlspecialchars($ele, ENT_QUOTES) . "'";
      }

      $user_id = $_SESSION['id'];
      $title = $post_data['name'];
      $phone = $post_data['phone'];
      $mail = $post_data['mail'];
      $web = $post_data['web'];
      $place = $post_data['place'];
      $about = $post_data['about'];
      $company_1 = $post_data['company1'];
      $period_1 = $post_data['period1'];
      $role_1 = $post_data['role1'];
      $company_description_1 = $post_data['companydes1'];
      $company_2 = $post_data['company2'];
      $period_2 = $post_data['period2'];
      $role_2 = $post_data['role2'];
      $company_description_2 = $post_data['companydes2'];
      $company_3 = $post_data['company3'];
      $period_3 = $post_data['period3'];
      $role_3 = $post_data['role3'];
      $company_description_3 = $post_data['companydes3'];
      $skill_1 = $post_data['skill1'];
      $skill_2 = $post_data['skill2'];
      $skill_3 = $post_data['skill3'];
      $skill_4 = $post_data['skill4'];
      $skill_5 = $post_data['skill5'];
      $skill_6 = $post_data['skill6'];
      $slide_1 = $post_data['slide1'];
      $slide_2 = $post_data['slide2'];
      $slide_3 = $post_data['slide3'];
      $slide_4 = $post_data['slide4'];
      $slide_5 = $post_data['slide5'];
      $slide_6 = $post_data['slide6'];
      $hobbies = $post_data['hobbies'];

      $query = "UPDATE templates SET name = {$title}, phone = {$phone}, mail = {$mail}, web = {$web}, place = {$place}, about = {$about},	company1 = {$company_1}, period1 = {$period_1}, role1 = {$role_1}, companydes1 = {$company_description_1}, company2 = {$company_2}, period2 = {$period_2}, role2 = {$role_2}, companydes2 = {$company_description_2}, company3 = {$company_3}, period3 = {$period_3}, role3 = {$role_3}, companydes3 = {$company_description_3}, skill1 = {$skill_1}, skill2 = {$skill_2}, skill3 = {$skill_3}, skill4 = {$skill_4}, skill5 = {$skill_5}, skill6 = {$skill_6}, slide1 = {$slide_1}, slide2 = {$slide_2}, slide3 = {$slide_3}, slide4 = {$slide_4}, slide5 = {$slide_5}, slide6 = {$slide_6}, hobbies = {$hobbies}, owner_id = {$user_id} WHERE id = {$cvId}";
      CVModel::getInstance()->run($query);
      $response->message = "OK";
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
    }
    return $response;
  }

  public static function insert(array $post_data)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      foreach ($post_data as &$ele) {
        if ($ele == '') $ele = 'None';
        $ele = "'" . htmlspecialchars($ele, ENT_QUOTES) . "'";
      }
      $user_id = $_SESSION['id'];
      $name = $post_data['name'];
      $phone = $post_data['phone'];
      $mail = $post_data['mail'];
      $web = $post_data['web'];
      $place = $post_data['place'];
      $about = $post_data['about'];
      $company_1 = $post_data['company1'];
      $period_1 = $post_data['period1'];
      $role_1 = $post_data['role1'];
      $company_description_1 = $post_data['companydes1'];
      $company_2 = $post_data['company2'];
      $period_2 = $post_data['period2'];
      $role_2 = $post_data['role2'];
      $company_description_2 = $post_data['companydes2'];
      $company_3 = $post_data['company3'];
      $period_3 = $post_data['period3'];
      $role_3 = $post_data['role3'];
      $company_description_3 = $post_data['companydes3'];
      $skill_1 = $post_data['skill1'];
      $skill_2 = $post_data['skill2'];
      $skill_3 = $post_data['skill3'];
      $skill_4 = $post_data['skill4'];
      $skill_5 = $post_data['skill5'];
      $skill_6 = $post_data['skill6'];
      $slide_1 = $post_data['slide1'];
      $slide_2 = $post_data['slide2'];
      $slide_3 = $post_data['slide3'];
      $slide_4 = $post_data['slide4'];
      $slide_5 = $post_data['slide5'];
      $slide_6 = $post_data['slide6'];
      $hobbies = $post_data['hobbies'];

      $query = 'INSERT INTO templates (name, phone, mail, web, place, about, company1, period1, role1, companydes1, company2, period2, role2, companydes2, company3,	period3, role3,	companydes3, skill1, skill2, skill3, skill4, skill5, skill6, slide1, slide2, slide3, slide4, slide5, slide6, hobbies, owner_id) VALUES (' . $name . ', ' . $phone . ', ' . $mail . ', ' . $web . ', ' . $place . ', ' . $about . ', ' . $company_1 . ', ' . $period_1 . ', ' . $role_1 . ', ' . $company_description_1 . ', ' . $company_2 . ', ' . $period_2 . ', ' . $role_2 . ', ' . $company_description_2 . ', ' . $company_3 . ', ' . $period_3 . ', ' . $role_3 . ', ' . $company_description_3 . ', ' . $skill_1 . ', ' . $skill_2 . ', ' . $skill_3 . ', ' . $skill_4 . ', ' . $skill_5 . ', ' . $skill_6 . ', ' . $slide_1 . ', ' . $slide_2 . ', ' . $slide_3 . ', ' . $slide_4 . ', ' . $slide_5 . ', ' . $slide_6 . ', ' . $hobbies . ', ' . $user_id . ');';
      CVModel::getInstance()->run($query);
      $response->message = "OK";
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function all(string $search_key = "")
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $search_key = ($search_key == '') ? '%' : $search_key;
      $result = CVModel::getInstance()->run("SELECT name, templates.id, users.username FROM templates LEFT JOIN users ON templates.owner_id = users.id WHERE name LIKE '%{$search_key}%'");
      $response->message = "OK";
      $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function byId(string $id)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $result = CVModel::getInstance()->run("SELECT * FROM templates WHERE id = " . $id . "");
      if (count($result) <= 0) {
        throw new ExplicitException("Cannot find a CV with such ID.");
      } else {
        $response->message = "OK";
        $result = $result[0];
        $response->query_result = $result;
      }
    } catch (ExplicitException $e) {
      $response->message = $e->getMessage();
      TransactionModel::rollback();
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }

  public static function byOwnerId(string $id)
  {
    $response = new ModelResponse();
    TransactionModel::begin();
    try {
      $result = CVModel::getInstance()->run("SELECT * FROM templates WHERE owner_id = " . $id . "");
      $response->message = "OK";
      $result = $result;
      $response->query_result = $result;
    } catch (Exception $e) {
      $response->message = "Something went wrong. {$e->getMessage()}";
      TransactionModel::rollback();
    }
    TransactionModel::commit();
    return $response;
  }
}
