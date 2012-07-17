<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemplateSimple
 *
 * @author sabinesteinkamp
 */
class TemplateSimple {
    //put your code here
    
    
       /**
     * Der Ordner in dem sich die Template-Dateien befinden.
     *
     * @access public
     * @var    string
     */
    protected $templateDir = "templates/";
    
    
    /**
     * Der linke Delimter für einen Standard-Platzhalter
     *
     * @access public
     * @var    string
     */
    protected $leftDelimiter = '{$';
    
    /**
     * Der rechte Delimter für einen Standard-Platzhalter
     *
     * @access public
     * @var    string
     */
    protected $rightDelimiter = '}';


    /**
     * Der linke Delimter für ein Kommentar
     * Sonderzeichen müssen escaped werden, weil der Delimter in einem RegExp
     * verwendet wird.
     *
     * @access public
     * @var    string
     */
    protected $leftDelimiterC = '\{\*';
    
    /**
     * Der rechte Delimter für ein Kommentar
     * Sonderzeichen müssen escaped werden, weil der Delimter in einem RegExp
     * verwendet wird.
     *
     * @access public
     * @var    string
     */
    protected $rightDelimiterC = '\*\}';
    

    /**
     * Der komplette Pfad der Templatedatei.
     *
     * @access protected
     * @var    string
     */
    protected $templateFile = "";
    
    
    /**
     * Der Dateiname der Templatedatei
     *
     * @access protected
     * @var    string
     */
    protected $templateName = "";
    
    /**
     * Der Inhalt des Templates.
     *
     * @access protected
     * @var    string
     */
    protected $template = "";

    
    /**
     * Ein paar Eigenschaften ihre Werte zuweisen
     *
     * @access    public
     * @return    boolean
     */
    public function template($tpl_dir = "", $lang_dir = "") 
    {
        // Template Ordner ändern
        if (!empty($tpl_dir)) {
            $this->templateDir = $tpl_dir;
        }

        // Language Ordner ändern
        if (!empty($lang_dir)) {
            $this->languageDir = $lang_dir;
        }
        
        return true;
    }

    
    /**
     * Die Templatedatei öffnen
     *
     * @access    public
     * @param     string $file Dateiname des Templates
     * @return    boolean
     */
    public function load($file)
    {
        // Die Eigenschaften zuweisen
        $this->templateName = $file;
        $this->templateFile = $this->templateDir.$file;

        // Wenn ein Dateiname übergeben wurde, versuchen, die Datei zu öffnen
        if(!empty($this->templateFile)) {
            if($fp = @fopen($this->templateFile, "r")) {
                // Den Inhalt des Templates einlesen
                $this->template = fread($fp, filesize($this->templateFile)); 
                fclose ($fp); 
            } else {
                return false;
            }
        }

        // Die methode replaceFuntions() aufrufen
        $this->replaceFunctions();
        
        return true;
    }


    /**
     * Die Standard-Platzhalter ersetzen
     *
     * @access    public
     * @param     string $replace      Name of var which should be replaced
     * @param     string $replacement  Text with which to replace the var
     * @return    boolean
     */
    public function assign($replace, $replacement)
    {
        $this->template = str_replace($this->leftDelimiter.$replace.$this->rightDelimiter, $replacement, $this->template);
        return  true;
    }

    
    
    /**
     * Die Funktionen ersetzen
     *
     * @access    protected
     * @return    boolean
     */
    protected function replaceFunctions()
    {
        // Includes ersetzen ( {include file="..."} )
        while(preg_match("/".$this->leftDelimiterF."include file=\"(.*)\.(.*)\"".$this->rightDelimiterF."/isUe", $this->template)) {
            $this->template = preg_replace("/".$this->leftDelimiterF."include file=\"(.*)\.(.*)\"".$this->rightDelimiterF."/isUe", "file_get_contents(\$this->templateDir.'\\1'.'.'.'\\2')", $this->template);
        }

    
        // Kommentare löschen
        $this->template = preg_replace("/".$this->leftDelimiterC."(.*)".$this->rightDelimiterC."/isUe", "", $this->template);
        
        return  true;
    }  
      
    /**
     * Das fertige Template ausgeben
     *
     * @access    public
     * @return    boolean
     */
    public function out()
    {
        echo $this->template;
        return true;
    }
}

?>
