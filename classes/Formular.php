<?php

/**
 * die Klasse Formular erzeugt ermöglichen ein beliebiges HTML-Formular 
 */
class Formular {
    public function formstart(){
       return $this->AddStartTag('form');
    }
    public function formende(){
       return $this->AddEndeTag('form');
    }
    public function input($type){
        $input = $this->AddStartTag('input');
        $this->setAttribute($input, 'type', $type);
        return $input;
    }
    public function text(){
        return $this->input('text');
    }
    public function password(){
        return $this->input('password');
    }
    public function hidden(){
        return $this->input('hidden');
    }
    public function checkbox($content=''){
        return $this->input('checkbox').$content;
    }
    public function radio($content,$value=''){
        $radio = $this->input('radio').$content."\n";
        if($value == '')
            $this->setAttribute($radio, 'value', $content);
        else
            $this->setAttribute($radio, 'value', $value); 
        return $radio;
    }
    public function submit($value=''){
        $submit = $this->input('submit');
        if($value!='')
            $this->setAttribute ($submit, 'value', $value);
        return $submit;
    }
    public function textarea($content=''){
        return $this->AddStartTag('textarea').
               $content."\n".
               $this->AddEndeTag('textarea');
    }
    public function label($content=''){
        return $this->AddStartTag('label').
               $content.
               $this->AddEndeTag('label');
    }
    /**
    * erzeugt ein select Element mit beliebigen Optionen
    * @param array $options [[$value => ]$content]
    * @param string $selected welche Option wird zuerst ausgewählt
    */
    public function select(array $options,$selected){
        $select = $this->selectStart();
        foreach ($options as $key => $value) {
            if(is_numeric($key))
                $option = $this->option($value);
            else
                $option = $this->option($value, $key);
            if($value === $selected)
                $this->setAttribute($option, 'selected'); 
            $select.=$option;
        }
        $select.=$this->selectEnde();
        return $select;
    }
    /**
     * erzeugt mehrere Attributen auf ein mal(Funktion setAttribute wird aufgerufen)
     * @param type &$tagString
     * @param array $attributes [$attributeName => $attributeValue]
     */
    public function setAttributes(&$tagString, array $attributes){
        foreach ($attributes as $attributeName => $value) {
            $this->setAttribute($tagString, $attributeName, $value);
        }
    }
    /**
     * erzeugt ein Attribut mit Attributewert wenn es nicht vorhanden ist,
     * oder ändern den Wert wenn es schon vorhanden ist.
     * @param type &$tagString
     * @param string $attributeName
     * @param string $attributeValue
     */
    public function setAttribute(&$tagString, $attributeName, $attributeValue=''){
        if (str_contains($tagString, $attributeName)) {
            $tagString = preg_replace("~$attributeName=\".*\"~U", "$attributeName=\"$attributeValue\"", $tagString);
        } else {
            preg_match('~<(.+)>~U', $tagString, $matches);
            $tagName = $matches[1]; //get tag name from one element(one record) in elements array
            $tagString = preg_replace("~(<$tagName.*)>~U", "$1 $attributeName=\"$attributeValue\">", $tagString);
        }       
    } 
    public function display(array &$elements){
        foreach ($elements as $value) {
            echo $value.'<br>'."\n";
        }
    }
    private function selectStart(){
        return $this->AddStartTag('select');
    }
    private function selectEnde(){       
        return $this->AddEndeTag('select');
    }
    private function option($content, $value=''){
        $option = "\t".$this->AddStartTag('option').
                  "\t".$content."\n".
                  "\t".$this->AddEndeTag('option');
        if($value == '')
            $this->setAttribute($option,'value',$content);
        else
            $this->setAttribute($option,'value',$value);
        return $option;
    }
    private function AddStartTag($tagName){
            return "<$tagName>\n";
    }
    private function AddEndeTag($tagName){
            return "</$tagName>\n";
    } 
    
}
