<?php
#######################################
# Class : Form
# Description : Form Class
#######################################

//Class for Manage Form 


#checkbox selected
class Form { 

public function  setCheckBox($data, $checker){
	 return $data == $checker?"checked":"";
}


# create listmenu/Combobox function
public function listComboBox($arrData , $selectedVal=""){
		$data = '';
		foreach($arrData as   $key =>$val ){
			$sel=$selectedVal == $key?"selected":"";
			$data .= "<option value='$key' $sel>$val</option>\n";	
	}
		return $data;
}



# create select option function
public function genOptionSelect($arrdata,$key,$value,$select="",$valueOption="", $nameOption = ""){
		  for($i=0;$i<count($arrdata);$i++){ 
				if($valueOption!=""){ $paramOption = "|".$arrdata[$i][$valueOption];}
				$setOption = $nameOption != "" ? " : ".$arrdata[$i][$nameOption] : "";
				
					 $sel=$select == $arrdata[$i][$key]?"selected":""; 					  			
						echo "<option value=\"".$arrdata[$i][$key].$paramOption."\"  $sel>".$arrdata[$i][$value].$setOption."</option>\n";				   
		   }

}

} // End Class