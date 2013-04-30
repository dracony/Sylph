Sylph
=====

A simple and easy to use array to class stubber. Greatly improves the speed of writing class stubs.
Here is a quick exxample:

        $this->sylph = new \PHPixie\Sylph();
        $flowers = 7; //Will use it in an anonymous method later on
        $fairy = $this->sylph->cast(array(
            'name' => 'Tinkerbell',
            'likes' => array(
                'flying'  => true,
                'dancing' => true
            ),
            'pick_flowers' => function($picked) use($flowers){
                return $picked + $flowers;
            },
            'friend' => $this->sylph->cast(array(
                'name' => 'Trixie'
            ))
        ));
        
        $this->assertEquals('Tinkerbell', $fairy->name);
        $this->assertEquals(true, $fairy->likes['flying']);
        $this->assertEquals(true, $fairy->likes['dancing']);
        $this->assertEquals(10, $fairy->pick_flowers(3));
        $this->assertEquals('Trixie', $fairy->friend->name); 
