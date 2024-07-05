<?php
// $root, $conn은 부모에서 불러와야 함

class User {

  public $uid;
  public $name;
  public $desc;
  public $password;
  public $email;

  // 기본
  public function __construct($user_uid, $user_name, $user_desc, $user_password, $user_email) {
    $this->uid = $user_uid;
    $this->name = $user_name;
    $this->desc = $user_desc;
    $this->password = $user_password; // 해시 값으로 가져와야 함
    $this->email = $user_email;
  }

  // 회원가입
  public function mod_user_signup() {
    global $conn, $root;

    $sql = "INSERT INTO users (uid, name, password, email, description) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $this->uid, $this->name, $this->password, $this->email, $this->desc);
    if ($stmt->execute()) {
      $_SESSION["user_is_signin"] = true;
      $_SESSION["user_uid"] = $this->uid;
      $_SESSION["user_name"] = $this->name;
      $stmt->close();
      header("Location: {$root}/");
      exit();
    }
    $stmt->close();
    return false;
  }

  // 로그인: /client/pages/auth/signin.php 담당
  static public function mod_user_signin($uid, $password) {
    // 작성할 계획 없음
  }

  // 찾기
  static public function mod_user_find($uid) {
    if (!$uid) {
      return false;
    }

    global $conn;
    $user_data = [];

    $sql = "SELECT * FROM users WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uid);
    if ($stmt->execute()) {
      $stmt->bind_result($bind_user_id, $bind_user_uid, $bind_user_name, $bind_user_password_hashed, $bind_user_email, $bind_user_desc, $bind_user_joinedAt, $bind_user_isAdmin);
      $user_data = [
        "user_id" => $bind_user_id,
        "user_uid" => $bind_user_uid,
        "user_name" => $bind_user_name,
        "user_password_hashed" => $bind_user_password_hashed,
        "user_email" => $bind_user_email,
        "user_desc" => $bind_user_desc,
        "user_joinedAt" => $bind_user_joinedAt,
        "user_isAdmin" => $bind_user_isAdmin,
      ];
      $stmt->close();
      return $user_data;
    }
    $stmt->close();
    return false;
  }

  // 삭제
  static public function mod_user_delete($uid) {
    if (!$uid) {
      return false;
    }

    global $conn;

    $sql = "DELETE FROM users WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uid);
    if ($stmt->execute()) {
      $stmt->close();
      return true;
    }
    $stmt->close();
    return false;
  }

  /**
   * 수정:
   * editUser(uid, ["name"=>"", "password"=>"", "email"=>"", "description"=>""])
   */
  static public function mod_user_edit($uid, $user_data = []) {
    if (!($uid && $user_data)) {
      return false;
    }

    global $conn;

    $sets = "";
    $index = 0;
    foreach ($user_data as $key => $data) {
      $sets .= "{$key} = \"{$data}\"";
      if ($index < count($user_data)-1) {
        $sets .= ", ";
      }
      $index ++;
    }

    // id, uid, joined_at, is_admin는 금지 불가
    // name, password, email, description
    $sql = "UPDATE users SET {$sets} WHERE uid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $uid);
    if ($stmt->execute()) {
      echo "updated!";
    }
  }
  
}
?>