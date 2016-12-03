<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once("PostgreSQL.php");
$pgsql = new PostgreSQL;
session_start();
$fb = new Facebook\Facebook([
  'app_id' => getenv('ID'), // Replace getenv('ID') with your app id
  'app_secret' => getenv('SECRET'),
  'default_graph_version' => 'v2.7',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    /*echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
    */
   echo "アクセスが拒否されました";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId(getenv('ID')); // Replace getenv('ID') with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');

$tokenMetadata->validateExpiration();

echo $accessToken->isLongLived();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  echo '<h3>Long-lived</h3>';
  var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,gender,age_range', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

/*echo 'gender: ' . $user['gender'];
echo 'id: ' . $user['id'];
echo 'age_range: ' . $user['age_range']['min'];
var_dump($user['age_range']);
*/
if($accessToken!=NULL){
  $usr_id =hash("sha256",$user['id']);
  $age = $user['age_range']['min'];
  $gender = $user['gender'];
  $array = array($usr_id);
  $pgsql->query("SELECT no,gender,age,anq FROM test WHERE id=$1",$array);
  $row = $pgsql->fetch();
  if(isset($row)){
    $_SESSION["my_no"] = $row["no"];
    $_SESSION["gender"] = $row["gender"];
    $_SESSION["age"] = $age;
    $_SESSION["anq"] = $row["anq"];
    $flag = 1;
  }else{
    $pgsql->query_null("SELECT MAX(no) AS no FROM test");
    if ($pgsql->rows()>0) {
      $row = $pgsql->fetch();
      $no = $row['no'];
      $no++;
    }
  //--------------------------------------------
  // □ 会員情報テーブル(friendinfo)に登録
  //--------------------------------------------
    if (!empty($usr_id)) {
      // データを追加する
      $_SESSION["my_no"] = $no;
      $_SESSION["gender"] = $gender;
      $_SESSION["age"] = $age;
      $_SESSION["anq"] = 0;
      $flag = 0;
      $sql = "INSERT INTO test(no,id,anq,age,gender) VALUES($1,$2,$3,$4,$5)";
      $array = array($no,$usr_id,0,$age,$gender);
      $pgsql->query($sql,$array);
    }
  }
}

if($flag==1){
  //header('Location: https://study-yokohama-sightseeing.herokuapp.com/index.php');
  //exit;
}else{
  //header('Location: https://https://study-yokohama-sightseeing.herokuapp.com/fb_register.php');
  //exit;
}
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>