<title>Scores Practical</title>
<link rel="stylesheet" href="/assignment/style.css">
<style>
  * {
    margin: 0;
    padding: 0;
    outline: none;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
  }
  form {
    padding: 10px;
    background: #293837;
    width: 35vw;
    margin: 20px auto;
    border-radius: 8px;
  }
  div {
    display: grid;
    grid-template-columns: 1fr 1fr;
  }
  input, button, select {
    display: block;
    border: 1px solid #000;
    border-radius: 4px;
    height: 40px;
  }
  input, select {
    width: 80%;
    margin: 15px auto;
  }
  button {
    width: 40%;
    margin: 15px auto;
  }
  table {
    padding: 2rem;
    margin: 1rem auto;
    width: 80vw;
    border-collapse: collapse;
  }
  thead {
    background: #2e3838;
    color: #fff;
  }
  th, td {
    margin: 5px;
    padding: 0.9rem;
  }
  table, th, td {
    border: 1px solid #000;
  }
  tbody tr:hover {
    background: #ff9;
  }
  tbody tr:nth-child(even){
    background-color: #f31;
  }
</style>
<form method="post">
  <div>
    <!--<input type="text" name="team" placeholder="Team Name" required />-->
    <select name="team" required>
      <option value="" selected disabled>Team</option>
      <option value="Arsenal FC">Arsenal FC</option>
      <option value="Chelsea FC">Chelsea FC</option>
      <option value="Liverpool FC">Liverpool FC</option>
      <option value="Manchester City">Man City</option>
      <option value="Manchester United FC">Man Utd FC</option>
      <option value="Tottenham Hotspur">Tottenham Hotspur</option>
    </select>
    <!--<input type="text" name="outcome" placeholder="Match Outcome" required />-->
    <select name="outcome" required>
      <option value="" selected disabled>Match Outcome</option>
      <option value="win">Win</option>
      <option value="draw">Draw</option>
      <option value="loss">Loss</option>
    </select>
    <!--<input type="number" name="win" placeholder="Games Won" required />
    <input type="number" name="loss" placeholder="Games Losed" required />
    <input type="number" name="draw" placeholder="Games Drawn" required />-->
    <input type="number" name="GF" placeholder="Goals Scored" min="0" required />
    <input type="number" name="GC" placeholder="Goals Conceded" min="0" required />
    <!--<input type="number" name="GD" placeholder="Goals Difference" required />
    <input type="number" name="pts" placeholder="Points" required />-->
  </div>
  <button type="submit" name="btn">Update</button>
</form>

<?php



$con = new mysqli('localhost', 'root', '', 'inventory');
if(!$con){
  die("Connection Failed".mysqli_connect_error());
}


if(isset($_POST['btn'])){
  $team = mysqli_real_escape_string($con, $_POST['team']);

  $get = "SELECT * FROM scores WHERE team_name='$team'";
  $res = mysqli_query($con, $get);
  $tab = mysqli_fetch_array($res);

  echo $tab['team_name']."<br/>";
  $outcome = mysqli_real_escape_string($con, $_POST['outcome']);
  function Scores($mt_outcome){
    if($mt_outcome == "win"){
      $score = 3;
      return $score;
    }elseif($mt_outcome == "draw"){
      $score = 1;
      return $score;
    }else {
      $score = 0;
      return $score;
    }
  }
  $potd = Scores($outcome);


  $np = $tab['played'] + 1;
  //echo $np;
  
  function win($points){
    global $tab;
    if($points == 3){
      return 1;
    }else{
      return 0;
    }
  }
  $win = win($potd);
  $nwin = $tab['wins'] + $win;

  function draw($points){
    global $tab;
    if($points == 1){
      return 1;
    }else{
      return 0;
    }
  }
  $draw = draw($potd);
  $ndraw = $tab['draw'] + $draw;

  function lose($points){
    global $tab;
    if($points == 0){
      return 1;
    }else{
      return 0;
    }
  }
  $lose = lose($potd);
  $nloss = $tab['loss'] + $lose;

  //$loss = mysqli_real_escape_string($con, $_POST['loss']);
  //$draw = mysqli_real_escape_string($con, $_POST['draw']);
  $gf = mysqli_real_escape_string($con, $_POST['GF']);
  $ngf = $tab['goals'] + $gf;
  $gc = mysqli_real_escape_string($con, $_POST['GC']);
  $ngc = $tab['conceded'] + $gc;
  $ngd = $ngf - $ngc;
  $pts = $tab['pts'] + $potd;
  //echo $pts;
  
  
    $sql = "UPDATE scores SET played='$np', wins='$nwin', loss='$nloss', draw='$ndraw', goals='$ngf', conceded='$ngc', goal_aggr='$ngd', pts='$pts' where team_name='$team'";
    if(mysqli_query($con, $sql)){
      echo "SUCCESSFUL!<br/>";
    }else{
      echo "FAILED!: ".mysqli_error($con);
    }
}


/*$sql = "UPDATE scores SET played=0, wins=0, loss=0, draw=0, goals=0, conceded=0, goal_aggr=0, pts=0";
    if(mysqli_query($con, $sql)){
      echo "SUCCESSFUL!<br/>";
    }else{
      echo "FAILED!: ".mysqli_error($con);
    }*/

$fetch = "SELECT * FROM scores ORDER BY pts DESC, goal_aggr DESC, goals DESC, conceded ASC";
$result = mysqli_query($con, $fetch);

/*$row = mysqli_fetch_assoc($result);
sort($row);*/
$sn = 1
?>

<table>
    <thead>
      <tr>
        <th>Pos.</th>
        <th>Team</th>
        <th>P</th>
        <th>W</th>
        <th>D</th>
        <th>L</th>
        <th>GF</th>
        <th>GA</th>
        <th>GD</th>
        <th>Pts</th>
      </tr>
    </thead><?php

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){?>
    <tbody>
      <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $row['team_name']; ?></td>
        <td><?php echo $row['played']; ?></td>
        <td><?php echo $row['wins']; ?></td>
        <td><?php echo $row['draw']; ?></td>
        <td><?php echo $row['loss']; ?></td>
        <td><?php echo $row['goals']; ?></td>
        <td><?php echo $row['conceded']; ?></td>
        <td><?php echo $row['goal_aggr']; ?></td>
        <td><?php echo $row['pts']; ?></td>
      </tr><?php
  }
}


?>
</tbody>
</table>

<?php




/*$x = array("sense ", "una ", "no ", "get ");
$y = "at all";
echo $x[1].$x[2].$x[3].$x[0].$y;*/


/*echo 'jafar';
$t889xt=12;
$house='jafar<br>';
//echo $t889xt.$house;
$order="21 lessons for ";
//echo $order." the 21st century<br>";
$variable1="9";
$variable2=9;
/*echo $variable1+$variable2;

function computer() {
	global $house;
	$function="border";
echo	$GLOBALS["variable1"]+$GLOBALS["t889xt"];
 echo $house;
echo "<p>Hello!</p>";
}
computer();


Function green(){
	static $four=5;
	echo $four;

++$four;	
}
green();
green();
green();
green();
green();
green();
green();

$string =  "Are you technically bilingual if you programiing languages?";
echo strrev($string);


$start=array("are you ","bilingual ","if you know","technically ","programming languages ");
echo $start[0].$start[3].$start[1].$start[2]." ".$start[4];





define("enter","the brown fox jumped over the cat",true);
echo ENTER;
function f() {
	echo enTeR;
}
f();

 echo var_dump($variable1===$variable2);


$multi = array(array("Ahmad", 1.4, 16, array("Hausa", "English", "Arabic")), array("Yusuf", 1.47, 17), array("Hajara", 1.28, 12));

echo $multi[0][0]." is ".$multi[0][1]."metres tall "."and ".$multi[0][2]." years old. He Speaks ".$multi[0][3][1]."<br/>";
echo $multi[1][0]." is ".$multi[1][1]."metres tall "."and ".$multi[1][2]." years old.<br/>";
echo $multi[2][0]." is ".$multi[2][1]."metres tall "."and ".$multi[2][2]." years old.<br/>";

echo "<br/>The time is " . date("h:i:sa")."<br><br>";


$myFile = fopen("Sardauna photo embed.txt", "r") or die("Unable to open File...");
echo fgets($myFile, filesize("Sardauna photo embed.txt"));
fclose($myFile);
*/













?>