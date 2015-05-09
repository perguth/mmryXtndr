<?php session_start(); ?>
<html>
<?php
/*
030307
-added checkStandart
080906
-added help
080206
-updated highscore list code
070206
-replaced mt_rand() with rand()
-added make_seed() and srand(make_seed()) in genPCS()
060206
-fixed unset(pool) bug
-replaced rand() with mt_rand()
*/
if($_GET[d] == 1) session_destroy();

// seed with microseconds
function make_seed()
{
   list($usec, $sec) = explode(' ', microtime());
   return (float) $sec + ((float) $usec * 100000);
}

if( $_GET[standart] == 1)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[rmx] = 2;
	unset($_SESSION[rev]);
	$_SESSION[sizeU] = 9;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	$_SESSION[timerInf] = 1;
	$_SESSION[tries] = 6;
	unset($_SESSION[strings]);
	unset($_SESSION[randStrings]);
	$_SESSION[historyLength] = "i";
}

if( $_GET[standart] == 2)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[rmx] = "rmx";
	unset($_SESSION[rev]);
	$_SESSION[sizeU] = 9;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	unset( $_SESSION[timerInf]);
	$_SESSION[tries] = 6;
	unset($_SESSION[strings]);
	unset($_SESSION[randStrings]);		
	$_SESSION[historyLength] = 3;
}

if( $_GET[standart] == 3)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[rmx] = "rmx";
	$_SESSION[rev] = "rr";
	$_SESSION[sizeU] = 9;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	unset( $_SESSION[timerInf]);
	$_SESSION[tries] = 6;
	unset($_SESSION[strings]);
	unset($_SESSION[randStrings]);	
	$_SESSION[historyLength] = 3;
}

if( $_GET[standart] == 4)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[rmx] = "rmx";
	$_SESSION[rev] = "rr";
	$_SESSION[sizeU] = 9;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	unset( $_SESSION[timerInf]);
	$_SESSION[tries] = 6;
	$_SESSION[strings] = 2;
	unset($_SESSION[randStrings]);		
	$_SESSION[historyLength] = 3;
}

if( $_GET[standart] == 5)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[rmx] = "rmx";
	$_SESSION[rev] = "rr";
	$_SESSION[sizeU] = 9;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	unset( $_SESSION[timerInf]);
	$_SESSION[tries] = 6;
	$_SESSION[strings] = 2;
	$_SESSION[randStrings] = 1;
	$_SESSION[historyLength] = 3;
}

if( $_GET[standart] == 6)
{
	$_SESSION[nmbrs] = 1;
	$_SESSION[lttrs] = 1;
	$_SESSION[cps] = 1;
	$_SESSION[pics] = 1;
	$_SESSION[hist] = 1;
	$_SESSION[sizeU] = 25;
	$_SESSION[atOnce] = 2;
	$_SESSION[timer] = 2000;
	unset( $_SESSION[timerInf]);
	$_SESSION[tries] = 3;
	$_SESSION[historyLength] = 3;
}

function genPool($what)
{
	/*
	lttrs: 1 - 26
	imgs: 1 - 58
	*/

	$lw = rand(1,26);
	$cw = rand(1,26);
	$nw = rand(1,10);
	$pw = rand(1,30);
	$rw = rand(1,28);
	$l=$c=$n=$p=$r= 0;
	//unset($_SESSION[pool][$_SESSION[currentSession]]); tut nicht ... warum???
	for( $i = 0; $i < $_SESSION[size]; $i++)
	{
		echo "\n";
		switch(substr( $what, rand( 0, strlen( $what)-1), 1))
		{
			case "l":
				if( $l < 26)
				{
					$_SESSION[pool][$_SESSION[currentString]][$i] = "l".$lw++;
					$l++;
					if( $lw > 26) $lw = 1;
				}else{
					$what = explode("l",$what); //explode liefert die teile links und rechts von "l" als arrays
					if(count($what)>1)
						$what[0] .= $what[1];
					$what = $what[0];
					--$i;
				}
				break;

			case "c":
				if( $c < 26)
				{
					$_SESSION[pool][$_SESSION[currentString]][$i] = "c".$cw++;
					$c++;
					if( $cw > 26) $cw = 1;
				}else{
					$what = explode("c",$what);
					if(count($what)>1)
						$what[0] .= $what[1];
					$what = $what[0];
					--$i;
				}
				break;

			case "n":
				if( $n < 10)
				{
					$_SESSION[pool][$_SESSION[currentString]][$i] = "n".$nw++;
					$n++;
					if( $nw > 10) $nw = 1;
				}else{
					$what = explode("n",$what);
					if(count($what)>1)
						$what[0] .= $what[1];
					$what = $what[0];
					--$i;
				}
				break;

			case "p":
				if( $p < 30)
				{
					$_SESSION[pool][$_SESSION[currentString]][$i] = "p".$pw++;
					$p++;
					if( $pw > 30) $pw = 1;
				}else{
					$what = explode("p",$what);
					if(count($what)>1)
						$what[0] .= $what[1];
					$what = $what[0];
					--$i;
				}
				break;
				
			case "r":
				if( $r < 28)
				{
					$_SESSION[pool][$_SESSION[currentString]][$i] = "r".$rw++;
					$r++;
					if( $rw > 28) $rw = 1;
				}else{
					$what = explode("r",$what);
					if(count($what)>1)
						$what[0] .= $what[1];
					$what = $what[0];
					--$i;
				}
				break;
		}
	}
	genDrawPoolString();
}//180705

function genPCSelect()
{
// gen drawPCS - checkPCS - counter - finalUserSelection

	srand(make_seed());

	if( $_SESSION[strings] > 1)
		if(isset($_SESSION[randStrings]))
			$_SESSION[currentString] = rand(1, $_SESSION[strings]);
		else
			++$_SESSION[currentString];
	else
		$_SESSION[currentString] = 1;

	if( $_SESSION[currentString] > $_SESSION[strings])
		$_SESSION[currentString] = 1;

	for($i=0; $i < $_SESSION[atOnce]; $i++)
	{
		$drawPCS .= "\n";
		++$_SESSION[counter][$_SESSION[currentString]];

		if( $i%5 == 0)
			$drawPCS .= '<br>';

		$tmp = $_SESSION[pool][$_SESSION[currentString]][ rand( 0, count( $_SESSION[pool][$_SESSION[currentString]])-1)];
		
		//zum spaeteren vergleich mit der user eingabe
		$_SESSION[checkPCS][ $_SESSION[currentString] ][ $_SESSION[counter][$_SESSION[currentString]] ] = $tmp;

		$drawPCS .= "<img border=0 src=img/". $tmp. ".gif>";


		$tmp1 = "<img src=img/";
		$tmp1 .= $tmp. ".gif>";
	}
	echo $drawPCS; //ausgabe
	$_SESSION[x] = -1;
	unset( $_SESSION[selectionString]);


	if($_SESSION[rev] == "nr")
		$_SESSION[x2] = 0;

	if($_SESSION[rev] == "r")
		$_SESSION[x2] = $_SESSION[counter][$_SESSION[currentString]] + 1;

	if($_SESSION[rev] == "rr")
	{
		$_SESSION[rr] = rand(2,3); //wenn 1 dann reverse
		if($_SESSION[rr] == 2)
			$_SESSION[x2] = $_SESSION[counter][$_SESSION[currentString]] + 1;
		else
			$_SESSION[x2] = 0;
	}
}//010206

function buildSelectionString( $addInput = 1)
{
	if($_SESSION[x] != 0)
	{
		if( $addInput == 1)
		{
			$tmp .= " <img border=0 src=img/". strip_tags(key( $_POST[b])). ".gif>";
			if( $_SESSION[x]!=0 && $_SESSION[x]%5 == 0 && $_SESSION[historyLength] > 5 ) {
				$tmp .= '<br>';
				$tmp .= "\n";
			}
			$_SESSION[selectionString][] = $tmp;
			
			if ( $_SESSION[historyLength] != "i" && count($_SESSION[selectionString]) > $_SESSION[historyLength] && $_SESSION[historyLength] > 0 )
				$_SESSION[selectionString] = array_slice($_SESSION[selectionString], "-".$_SESSION[historyLength]."+1");
			
		}
		echo "<br><br>you've selected:<br>";
		foreach( $_SESSION[selectionString] as $key => $value )
			echo $value;
	}
}

function genDrawPoolString()
{
	unset($_SESSION[drawPool][$_SESSION[currentString]]);
	for( $i = 0; $i < $_SESSION[size]; $i++)
	{
		$_SESSION[drawPool][$_SESSION[currentString]] .= "\n";
		
		if( $i!=0 && $i%5 == 0)
			$_SESSION[drawPool][$_SESSION[currentString]] .= '<br>';
		
		$tmp = $_SESSION[pool][$_SESSION[currentString]][$i];
		
		$_SESSION[drawPool][$_SESSION[currentString]] .= "<input border=0 type=image name=b[". $tmp;
		$_SESSION[drawPool][$_SESSION[currentString]] .= "] src=img/". $tmp. ".gif>";
	}
}

function rmx()
{
	$c = count($_SESSION[pool][$_SESSION[currentString]]);
	$x = rand(0, $c-1);

	for($i = 0; $i < $c; $i++)
	{
		$tmp[$x++] = $_SESSION[pool][$_SESSION[currentString]][$i];
		if( $x >= $c) $x = 0;
	}
	$_SESSION[pool][$_SESSION[currentString]] = $tmp;
	genDrawPoolString();
}//310106

function checkTriesLeft()
{
	if( $_SESSION[tries2]-- > 0)
	{
		echo "the last selection was wrong!<br>";
		echo $_SESSION[drawPool][$_SESSION[currentString]];
		--$_SESSION[x];
		echo "<br>".$_SESSION[direction];
		if( $_SESSION[hist] != 2)
			buildSelectionString(0);
		echo "<br><br><b><div align=right>". ($_SESSION[tries2]+1);
		if( $_SESSION[tries2]+1 > 1)
			echo " tries";
		else
			echo " try";
		echo " left.</div></b>";
?>
		<input type=hidden name=hiddn value=3>
<?php
	}else{
echo "<table align=center width=120 cellpadding=0 cellspacing=0><tr><th>";
		echo "<table><tr><th align=left>no more tries left!<br>
		the correct choice<br> would have been:</th>";
		echo "<th><input border=0 type=image src=img/" 
			.$_SESSION[checkPCS][$_SESSION[currentString]][$_SESSION[x2]] .".gif></th></tr></table>";
echo "</th></tr></table>";
		?><script language=javascript>
			window.setTimeout("document.forms[0].submit()", <?php echo strip_tags($_SESSION[timer])?>);
		</script><?php
?>
		<input type=hidden name=hiddn value=4>
<?php
	}
}//010206

function natsort2d( &$arrIn, $index = null )
{
	$arrTemp = array();
	$arrOut = array();

	foreach ( $arrIn as $key=>$value ) {

		reset($value);
		$arrTemp[$key] = is_null($index)
			? current($value)
			: $value[$index];
	}

	natsort($arrTemp);

	foreach ( $arrTemp as $key=>$value ) {
		$arrOut[$key] = $arrIn[$key];
	}

	$arrIn = $arrOut;
}

function showHgh()
{
	$dat=fopen("hgh".$_SESSION[standart].".txt","r");
		$hgh = unserialize( fgets($dat));
	fclose($dat);
	
	if( is_array( $hgh))
	{
		foreach ( $hgh as $key=>$value ) 
			$tmp[ ++$i] = $value[2]." - ".$value[3]."<br>";
		
		for( $i= count( $tmp); $i > 0; $i--)
		{
			if( $i%2 == 0)
				echo $tmp[ $i];
			else
				echo "<font color=orange>".$tmp[ $i]."</font>";
		}
	}
}


?>
	<head>
		<title>
			mmryXtndr v080206 &#91;formaly known as  &#34;the geek game&#34;&#93;
		</title>
		
		<STYLE type=text/css>
			body            { font: 8pt Verdana, Arial, Helvetica, sans-serif;margin:0}
			th              { font: 8pt Verdana, Arial, Helvetica, sans-serif}
			fieldset        { background: white}
			a:link          { text-decoration: none; color: orange}
			a:visited       { text-decoration: none; color: orange}
			a:hover         { color: white; background-color:black; text-decoration: none}
			a:link.mode     { text-decoration: none; color: black}
			a:visited.mode  { text-decoration: none; color: black}
			a:hover.mode    { color: white; background-color:black; text-decoration: none}
		</STYLE>
	</head>
	
	<body><div align=center>
	
	<form method=post action=<?php echo $_SERVER[PHP_SELF]?>>
	<table cellpadding=0 cellspacing=0 width=201px border=0><tr><th>
<?php if(false){?>
	<fieldset><legend>
			<b><font size=2 color=orange>
				<a href=<?php echo $_SERVER[PHP_SELF]?>>
					mmryXtndr
				</a>
			</font>
			<font size=1 color=#999999>
				v.??????
			</font></b>
	</legend>
	<?php if(isset($_SESSION[mode])) { ?>
	<b>geeks with the<br>
	highest scores</b><br>
	<b>ipmb:</b> blahblah 12341<br>
	<b>wc:</b> blahblah 123123<br>
	<b>s:</b> blahblah 123123<br><br>
	<?php }?>
<?php }?><a href=<?php echo $_SERVER[PHP_SELF]?>><img src=1.gif border=0><br><img src=2.gif border=0></a><br>
	<?php if( !isset( $_POST[hiddn] ) || $_POST[hiddn] == 1){
	$_SESSION[mode] = "";
		?>
		
<!--preload >>-->
	<div style="display:none;">
	<?php
	for($i=1;$i<=30;$i++)
		echo "<img src=img/p".$i.".gif>";
	for($i=1;$i<=28;$i++)
		echo "<img src=img/r".$i.".gif>";
	for($i=1;$i<=26;$i++)
		echo "<img src=img/l".$i.".gif>";
	for($i=1;$i<=26;$i++)
		echo "<img src=img/c".$i.".gif>";
	for($i=1;$i<=10;$i++)
		echo "<img src=img/n".$i.".gif>";
	?>
	</div>
<!--preload <<-->
		
<!--index >>-->
<?php if(false){?>
		<fieldset>
		<legend><a class=mode href=<?php echo $_SERVER[PHP_SELF]?>?mode=1 >i pack my bag game</font></a></legend>

<?php }?>
<table align=center width=120 cellpadding=0 cellspacing=0><tr><th>

		<?php if( $_GET[mode]  == 1 || $_SESSION[mode] == 1 || !isset($_GET[mode]))
		{
		$_SESSION[mode] = 1;?>
			<div align=left>
			<br>
			<input type=submit name=d value="xtnd my mmry!" style=width:120px;>
			<div align=right>
			<?php if(isset($_GET[standart])) $_SESSION[standart] = $_GET[standart];?>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?mode=1&standart=5 
				<?php if($_SESSION[standart]==5) echo 'style="background-color:black;"';?>
				>NIGHTMARE!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?mode=1&standart=4
				<?php if($_SESSION[standart]==4) echo 'style="background-color:black;"';?>
				>HARDCORE!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?mode=1&standart=3
				<?php if($_SESSION[standart]==3) echo 'style="background-color:black;"';?>
				>HURT ME PLENTY!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?mode=1&standart=2
				<?php if($_SESSION[standart]==2||!isset($_SESSION[standart])) echo 'style="background-color:black;"';?>
				>BRING IT ON!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?mode=1&standart=1
				<?php if($_SESSION[standart]==1) echo 'style="background-color:black;"';?>
				>I CAN WIN!</a><br>
			</div>
			<a href="#" onmousedown="alert('Spielt sich wie &#34;ich packe meinen Koffer&#34;. Man sieht ein Baumbild und klickt danach das Baumbild an. Dann sieht man ein Apfelbild und klickt anschlie&szlig;end erst das Baumbild und dann das Apfelbild...Tricky: ab HURT ME PLENTY wechselt die Reihenfolge in der man wiedergeben muss zuf&auml;llig &#40;die Richtung wird durch einen kleinen Pfeil angegeben&#41; und ab Hardcore spielt man in &#34;zwei Klassen&#34; gleichzeitig &#40;die aktuelle &#34;Klasse&#34; wird durch &#34;string: n&#34; angezeigt&#41;');">help?!</a>
			<br><br>
			<br>
			<input type=checkbox name=numbers value=n
				<?php if(!isset($_SESSION[nmbrs]) || $_SESSION[nmbrs]!=2){?>checked=checked<?php }?>
				>numbers
			<br>
			
			<input type=checkbox name=letters value=l
				<?php if(!isset($_SESSION[lttrs]) || $_SESSION[lttrs]!=2){?>checked=checked<?php }?>
				>letters
			<br>
			
			<input type=checkbox name=capitals value=c
				<?php if(!isset($_SESSION[cps]) || $_SESSION[cps]!=2){?>checked=checked<?php }?>
				>capitals
			<br>
			
			<input type=checkbox name=pictures value=pr
				<?php if(!isset($_SESSION[pics]) || $_SESSION[pics]!=2){?>checked=checked<?php }?>
				>pictures
			<br><br>
			
			<input type=checkbox name=hist value=h
				<?php if(!isset($_SESSION[hist]) || $_SESSION[hist]!=2){?>checked=checked<?php }?>
				>show history
			<br>
			
			history lenght:<br>
			<input type=text size=3 name=historyLength value=
				<?php if(!isset($_SESSION[historyLength])){?>3<?php }
				elseif($_SESSION[historyLength] != "i"){?><?php echo strip_tags($_SESSION[historyLength])?><?php }?>
				>
			infinite
			<input type=checkbox name=historyLength value="i"
				<?php if($_SESSION[historyLength] == "i"){?>checked="checked"<?php }?>
				>
			<br>
			
			<input type=checkbox name=rmx value=rmx
				<?php if(!isset($_SESSION[rmx]) || $_SESSION[rmx]!=2){?>checked=checked<?php }?>
				>remix field
			<br>

			<input type=radio name=rev value=nr
				<?php if( !isset($_SESSION[rev]) || $_SESSION[rev]=="nr"){?>checked=checked<?php }?>
				>no reverse
			<br>
			
			<input type=radio name=rev value=r
				<?php if( $_SESSION[rev]=="r"){?>checked=checked<?php }?>
				>reverse
			<br>
			
			<input type=radio name=rev value=rr
				<?php if( $_SESSION[rev]=="rr"){?>checked=checked<?php }?>
				>rand. reverse
			<br>
			
			poolsize:<br>
			<input type=text size=3 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>9<?php }
				else echo strip_tags($_SESSION[sizeU]);?>
				>
			<br>
			
			items at once:<br>
			<input type=text size=3 name=itemsAtOnce value=
				<?php if(!isset($_SESSION[atOnce])){?>2<?php }
				else echo strip_tags($_SESSION[atOnce]);?>
				>
			<br>
			
			timer(ms):<br>
			<input type=text size=3 name=timer value=
				<?php if(!isset($_SESSION[timer])){?>2000<?php }
				else{?><?php echo strip_tags($_SESSION[timer])?><?php }?>
				>
			infinite
			<input type=checkbox name=timerInf value=1
				<?php if($_SESSION[timerInf]){?>checked="checked"<?php }?>
				>
			<br>
			
			tries:<br>
			<input type=text size=3 name=tries value=
				<?php if(!isset($_SESSION[tries])){?>6<?php }
				else{?><?php echo strip_tags($_SESSION[tries])?><?php }?>
				>
			<br>
			
			strings:<br>
			<input type=text size=3 name=strings value=
				<?php if(!isset($_SESSION[strings])){?>1<?php }
				else echo strip_tags($_SESSION[strings]);?>
				>
			random
			<input type=checkbox name=randStrings value=1
				<?php if($_SESSION[randStrings]){?>checked="checked"<?php }?>
				>
			<br><br>
			
			<input type=hidden name=mode value=1>
			<input type=hidden name=hiddn value=2>
			<input type=hidden name=setVars value=1>
			</div>
		</th></tr></table>
		<?php }?>
		
<?php if(false){?></fieldset>

		<fieldset style="background: white;">
		<legend><a class=mode href=<?php echo $_SERVER[PHP_SELF]?>?mode=2 >what changed game</a></legend>
		<?php if( false )
		{?>
			<div align=left>
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>select in right order
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>revers
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>rand. revers
			<br><br>

			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>select what changed not
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>remix field
			<br><br>
			
			<input type=submit name=d value="xtnd my mmry!"> <a href= >help?!</a>
			<br><br>
			
			poolsize:<br>
			<input type=text size=2 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>
			<br>
			
			add per round:<br>
			<input type=text size=2 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>
			<br>
			
			switch per round:<br>
			<input type=text size=2 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>

			<br>
			
			strings:<br>
			<input type=text size=2 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>

			<br><br>
			
			<div align=right>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?standart=2>what changed not mode!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?standart=2>what changed mode!</a>
			</div>
			</div>
		<?php }?>
		</fieldset>
		
		<fieldset style="background: white;">
		<legend><a class=mode href=<?php echo $_SERVER[PHP_SELF]?>?mode=3 >step game</a></legend>
		<?php if( false )
		{?>
			<div align=left>
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>revers
			<br>
			<input type=checkbox name=invert value=h
				<?php if( $_SESSION[inv]==1){?>checked="checked"<?php }?>
				>rand. revers
			<br><br>

			<input type=radio name=relAbs value=rel <?php if( !isset($_SESSION[relAbs]) || $_SESSION[relAbs]!=2){?>checked=checked<?php }?>
				>relative<br>
			<input type=radio name=relAbs value=abs <?php if( $_SESSION[relAbs]==2){?>checked=checked<?php }?>
				>absolute<br>
			<br>
			
			<input type=submit name=d value="xtnd my mmry!"> <a href= >help?!</a>
			<br><br>
			
			poolsize:<br>
			<input type=text size=3 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>
			<br>
			
			more steps per round:<br>
			<input type=text size=3 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>
			<br>

			strings:<br>
			<input type=text size=3 name=fieldsize value=
				<?php if(!isset($_SESSION[sizeU])){?>25<?php }
				else echo $_SESSION[sizeU];?>
				>

			<br><br>
			
			<div align=right>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?standart=3>absolute mode!</a><br>
				<a href=<?php echo $_SERVER[PHP_SELF]?>?standart=3>relative mode!</a>
			</div>
			</div>
		<?php }?>
		</fieldset>
<?php }?>
<!--index <<-->

		<?php
		}
	if(  $_GET[mode] == 1 || $_POST[mode] == 1 || $_SESSION[mode] == 1)
	{
		
		if( $_POST[hiddn] == 2)
		{
		?>
		<!--2. ausgabe >>-->
		<!-- $_SESSION[mode] sichern >>-->
			<?php $_SESSION[mode] = strip_tags($_POST[mode]);?>
		<!-- $_SESSION[mode] sichern >>-->
		
			<?php //vars speichern - genPool - genPCSelect - ausgabe - timer?
			if( isset( $_POST[setVars] ) )
			{
				//save vars to session
				unset($_SESSION[what]);
				unset($_SESSION[timerInf]);
				unset($_SESSION[standart]);
				$tmp = 0;
				
				if( isset( $_POST["numbers"]))
				{
					$_SESSION[what] = $_SESSION[nmbrs] = strip_tags($_POST["numbers"]);
					$tmp = 10;
				}else
					$_SESSION[nmbrs] = 2;
				
				if( isset( $_POST["letters"]))
				{
					$_SESSION[what] .= $_SESSION[lttrs] = strip_tags($_POST["letters"]);
					$tmp += 26;
				}else
					$_SESSION[lttrs] = 2;
				
				if( isset( $_POST["capitals"]))
				{
					$_SESSION[what] .= $_SESSION[cps] = strip_tags($_POST["capitals"]);
					$tmp += 26;
				}else
					$_SESSION[cps] = 2;
				
				if( isset( $_POST["pictures"]))
				{
					$_SESSION[what] .= $_SESSION[pics] = strip_tags($_POST["pictures"]);
					$tmp+=58;
				}else
					$_SESSION[pics] = 2;
				
				if( isset( $_POST["hist"]))
				{
					$_SESSION[hist] = strip_tags($_POST["hist"]);
				}else
					$_SESSION[hist] = 2;

				if( isset( $_POST["rmx"]))
					$_SESSION[rmx] = strip_tags($_POST["rmx"]);
				else
					$_SESSION[rmx] = 2;

				$_SESSION[rev] = strip_tags($_POST["rev"]);
				$_SESSION[historyLength] = strip_tags($_POST[historyLength]);
				
				if( !isset($_POST["numbers"]) && !isset($_POST["letters"])
				&& !isset($_POST["capitals"]) && !isset($_POST["pictures"]))
				{
					$_SESSION[what] = $_SESSION[pics] = "pr";
					$tmp = 58;
				}
				
				if( $_POST["fieldsize"] > $tmp || $_POST["fieldsize"] < 1)
					$_SESSION[size] = $tmp;
				else
					$_SESSION[size] = strip_tags($_POST["fieldsize"]);
				
				$_SESSION[sizeU] = strip_tags($_POST["fieldsize"]);
				
				if( $_POST["itemsAtOnce"] < 1)
					$_SESSION[atOnce] = 2;
				else
					$_SESSION[atOnce] = strip_tags($_POST["itemsAtOnce"]);
				
				if( !isset( $_POST[timerInf] ))
					$_SESSION[timer] = strip_tags($_POST["timer"]);
				else
					$_SESSION[timerInf] = 1;

				$_SESSION[tries] = strip_tags($_POST[tries]);
				
				if( $_POST["strings"] < 1)
					$_SESSION[strings] = 1;
				else
					$_SESSION[strings] = strip_tags($_POST["strings"]);

				if( isset( $_POST[randStrings] ))
					$_SESSION[randStrings] = 1;
				else
					unset($_SESSION[randStrings]);

			if(
	$_SESSION[what] == "nlcpr" &&
	!isset($_GET[rmx]) &&
	$_SESSION[rev] == "nr" &&
	$_SESSION[sizeU] == 9 &&
	$_SESSION[atOnce] == 2 &&
	$_SESSION[timerInf] == 1 &&
	$_SESSION[tries] == 6 &&
	$_SESSION[strings] == 1 &&
	$_SESSION[historyLength] == "i" &&
	!isset($_GET[randStrings]) ) $_SESSION[standart] = 1;
				elseif(
	$_SESSION[what] == "nlcpr" &&
	$_SESSION[rmx] == "rmx" &&
	$_SESSION[rev] == "nr" &&
	$_SESSION[sizeU] == 9 &&
	$_SESSION[atOnce] == 2 &&
	$_SESSION[timer] == 2000 &&
	!isset($_SESSION[timerInf]) &&
	$_SESSION[tries] == 6 &&
	$_SESSION[strings] == 1 &&
	$_SESSION[historyLength] == 3 &&
	!isset($_SESSION[randStrings]) ) $_SESSION[standart] = 2;
				elseif(
	$_SESSION[what] == "nlcpr" &&
	$_SESSION[rmx] == "rmx" &&
	$_SESSION[rev] == "rr" &&
	$_SESSION[sizeU] == 9 &&
	$_SESSION[atOnce] == 2 &&
	$_SESSION[timer] == 2000 &&
	!isset($_SESSION[timerInf]) &&
	$_SESSION[tries] == 6 &&
	$_SESSION[strings] == 1 &&
	$_SESSION[historyLength] == 3 &&
	!isset($_SESSION[randStrings]) ) $_SESSION[standart] = 3;
				elseif(
	$_SESSION[what] == "nlcpr" &&
	$_SESSION[rmx] == "rmx" &&
	$_SESSION[rev] == "rr" &&
	$_SESSION[sizeU] == 9 &&
	$_SESSION[atOnce] == 2 &&
	$_SESSION[timer] == 2000 &&
	!isset($_SESSION[timerInf]) &&
	$_SESSION[tries] == 6 &&
	$_SESSION[strings] == 2 &&
	$_SESSION[historyLength] == 3 &&
	!isset($_SESSION[randStrings]) ) $_SESSION[standart] = 4;
				elseif(
	$_SESSION[what] == "nlcpr" &&
	$_SESSION[rmx] == "rmx" &&
	$_SESSION[rev] == "rr" &&
	$_SESSION[sizeU] == 9 &&
	$_SESSION[atOnce] == 2 &&
	$_SESSION[timer] == 2000 &&
	!isset($_SESSION[timerInf]) &&
	$_SESSION[tries] == 6 &&
	$_SESSION[strings] == 2 &&
	$_SESSION[historyLength] == 3 &&
	$_SESSION[what] == "nlcpr" ) $_SESSION[standart] = 5;
				else
					unset($_SESSION[standart]);

			}
			
			$_SESSION[tries2] = $_SESSION[tries];
			unset( $_SESSION[finalUserSelection]);
			unset( $_SESSION[counter]);
			$_SESSION[score] = 0;
			unset( $_SESSION[checkPCS]);
			unset( $_SESSION[pool]);
			
			echo "try to notice...";

			for($_SESSION[currentString] = 1;
			$_SESSION[currentString] <= $_SESSION[strings]; $_SESSION[currentString]++)
				genPool( $_SESSION[what]);

			$_SESSION[currentString] = 0;

			genPCSelect();
			?>
			<input type=hidden name=hiddn value=3>
			<?php
			if( isset( $_SESSION[timerInf]))
			{
			?>
			<br><input type=submit value=xtend!>
			<?php
			}else{
			?>
			<script language=javascript>
				window.setTimeout("document.forms[0].submit()", <?php echo strip_tags($_SESSION[timer])?>);
			</script>
		<?php
			}
		?>
		<!--2. ausgabe <<-->
		<?php
		}
		function x3()
		{
			if($_SESSION[rev] == "nr")
			{
				++$_SESSION[x2];
				$_SESSION[direction] = "<b>--&gt;</b>";
			}

			if( $_SESSION[rev] == "r")
			{
				--$_SESSION[x2];
				$_SESSION[direction] = "<b>&lt;--</b>";
			}

			if($_SESSION[rev] == "rr")
				if($_SESSION[rr] == "2")
				{
					--$_SESSION[x2];
					$_SESSION[direction] = "<b>&lt;--</b>";
				}else{
					++$_SESSION[x2];
					$_SESSION[direction] = "<b>--&gt;</b>";
				}
			$_SESSION[direction] .= " string: <b>".$_SESSION[currentString];
		}//010206
		if( $_POST[hiddn] == 3 && !isset($_GET[w]))
		{
		?>
		<!--3. ausgabe >>-->
		<?php //das eigendliche game
			if( $_SESSION[counter][$_SESSION[currentString]] > ++$_SESSION[x])
			{
				if( !isset( $_POST[b]) || 
				key($_POST[b]) == $_SESSION[checkPCS][$_SESSION[currentString]][$_SESSION[x2]])
				{
					if($_SESSION[x] > $_SESSION[score])
						$_SESSION[score] = $_SESSION[x];

					
					echo "try to remember...<br>";
					echo $_SESSION[drawPool][$_SESSION[currentString]];
					x3();
					echo "<br>".$_SESSION[direction];
					if( $_SESSION[hist] != 2)
						buildSelectionString();
					
		?><?php echo "\n"?>
					<input type=hidden name=hiddn value=3>
		<?php
				}else{
					checkTriesLeft();
				}
			}else{
				if( key($_POST[b]) == $_SESSION[checkPCS][$_SESSION[currentString]][$_SESSION[x2]])
				{
					if($_SESSION[x] > $_SESSION[score])
						$_SESSION[score] = $_SESSION[x];

					echo "try to notice...";
					genPCSelect();
					if( $_SESSION[rmx] != 2)
						rmx();
		?>
					<input type=hidden name=hiddn value=3>
		<?php
					if( isset( $_SESSION[timerInf]))
					{
		?>
					<br><input type=submit value=xtend!>
		<?php
					}else{
		?>
					<script language=javascript>
						window.setTimeout("document.forms[0].submit()", <?php echo strip_tags($_SESSION[timer])?>);
					</script>
		<?php
					}
		?>
		<?php
				}else{
					checkTriesLeft();
				}
			}
		?>
		<!--3. ausgabe <<-->
		<?php
		}
		if( $_POST[hiddn] == 4 ){
		?>
		<!--4. ausgabe >>-->
			<b>your score: <?php echo $_SESSION[score]?></b><br>
			<a href=<?php echo $_SERVER[PHP_SELF]?>><b>restart!</b></a><br>
			<br>

			<?php
			if( isset( $_SESSION[standart]) && $_SESSION[score] > 5)
			{
			?>
				<input type=hidden name=hiddn value=5>
				<input type=text name=name maxlength=8 size=8 
					value="
					<?php if(isset($_SESSION[name])){
					echo $_SESSION[name];}?>"><br>
				<input type=submit value="submit!"><br>
				<br>
			<?php showHgh();
			}else{
			?>
				in order to submit your<br>
				highscore you must use a<br>
				standart config and your<br>
				score must be higher than 5<br>
				<br>

			<?php if(isset( $_SESSION[standart])) showHgh();
			}
			?>
		<!--4. ausgabe <<-->

		<?php
		}?>
		<?php if( $_POST[hiddn] == 5)
		{
		?>
		<!--5. ausgabe >>-->
			<a href=<?php echo $_SERVER[PHP_SELF]?>><b>restart!</b></a><br>
			<br>
		<?php
$standart = strip_tags( $_SESSION[standart] ); // here

			// hgh[][1] == time; [2] score; [3] name;
			$dat=fopen("hgh".$standart.".txt","r");
				$hgh =  unserialize(fgets($dat));
			fclose($dat);

			$name = strip_tags($_POST[name]);

			if($name == "")
				$name = "unknown";
			else
				$_SESSION[name] = $name;

			if( is_array( $hgh))
			{
				natsort2d( $hgh, 1); //nach datum sortieren
				for($i = 0,$t = count($hgh)-1; $i < count($hgh);$i++,$t--)
				{
					if($i > 15) break;
					$tmp[$i] = $hgh[$t];
				}
				$hgh = $tmp;
			}

			if( !is_array($hgh))
				$x = 0;
			else
				$x = count($hgh);

			$hgh[ $x][ 1] = time();
			$hgh[ $x][ 2] = strip_tags($_SESSION[score]); //here
			$hgh[ $x][ 3] = $name;
			
			if( is_array( $hgh))
				natsort2d( $hgh, 2);

			$dat=fopen("hgh".$standart.".txt","w");
				fwrite( $dat, serialize( $hgh));
			fclose($dat);

			showHgh();

			?>
		<!--5. ausgabe <<-->
		<?php
		}
	}
	if( $_POST[mode] == 2 || $_SESSION[mode] == 2)
	{
		?>
		
		<?php
	}
	if( $_POST[mode] == 3 || $_SESSION[mode] == 3)
	{
		?>
		
		<!--</fieldset>--><?php
	}?>
	
	

	</th></tr></table>
	</form><a href="http://d3velop.net/">d3v</a></div>
</body></html>
