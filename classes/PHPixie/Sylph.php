<?php

namespace PHPixie;

class Sylph{
	public function cast($members) {
		$class_name  = "Sylph_".uniqid();
		
		$properties  = "";
		$methods     = "";
		$assignments = "";
		
		foreach($members as $key=>$member) {
			if (is_callable($member)) {
				$methods.=
				"public function $key() {
					return call_user_func_array(\$this->members['$key'], func_get_args());
				}
				";
				$method_arr[$key] = $member;
			}else {
				$properties.=
				"public \$$key;
				";
				
				$assignments.=
				"\$this->$key = \$this->members['$key'];
				";
			}
		}
		
		$class = "class $class_name { 
			public \$members;
			$properties
			$methods
			public function __construct(\$members){
				\$this->members = \$members;
				$assignments
			}
		}";
		
		eval($class);
		return new $class_name($members);
	}
}