<?
include_once("config.inc.php");

$sql = new SQLSelect();
$sql->AddField("prods.id");
$sql->AddField("prods.name");
$sql->AddTable("prods");
$sql->AddJoin("left","screenshots","screenshots.prod = prods.id");
$sql->AddWhere("prods.rank < 1000");
$sql->AddWhere("screenshots.id is not null");
$sql->AddWhere("find_in_set('bbstro',type)=0");
$sql->AddWhere("find_in_set('demotool',type)=0");
$sql->AddOrder("rand()");
$prod = SQLLib::SelectRow( $sql->GetQuery() );
$prod->screenshot = POUET_CONTENT_URL . find_screenshot($prod->id);

header("Content-type: application/json");
echo json_encode(array("prod"=>$prod));
?>
