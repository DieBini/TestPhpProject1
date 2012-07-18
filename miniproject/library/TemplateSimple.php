<?php
/**
 * Description of TemplateSimple
 *
 * @author sabinesteinkamp
 */
class TemplateSimple {

    /**
     * Path to templates
     *
     * @access public
     * @var    string
     */
    protected $templateDir = "templates/";
    
    
    /**
     * left delimeter
     *
     * @access public
     * @var    string
     */
    protected $leftDelimiter = '{$';
    
    /**
     * right delimeter
     *
     * @access public
     * @var    string
     */
    protected $rightDelimiter = '}';


    /**
     * left delimter for comments
     *
     * @access public
     * @var    string
     */
    protected $leftDelimiterC = '\{\*';
    
    /**
     * right delimeter for comments
     *
     * @access public
     * @var    string
     */
    protected $rightDelimiterC = '\*\}';
    

    /**
     * path to template file
     *
     * @access protected
     * @var    string
     */
    protected $templateFile = "";
    
    
    /**
     * template name
     *
     * @access protected
     * @var    string
     */
    protected $templateName = "";
    
    /**
     * template value
     *
     * @access protected
     * @var    string
     */
    protected $template = "";

    
    /**
     * Change template dir
     *
     * @access    public
     * @return    boolean
     */
    public function template($tpl_dir = "") 
    {
        // change template directory
        if (!empty($tpl_dir)) {
            $this->templateDir = $tpl_dir;
        }
        return true;
    }

    
    /**
     * Load Template
     *
     * @access    public
     * @param     string $file Template file name
     * @return    boolean
     */
    public function load($file)
    {

        $this->templateName = $file;
        $this->templateFile = $this->templateDir.$file;
        if(!file_exists($this->templateFile)) {
            throw new Exception("Template file:" . $this->templateFile ." does not exist");
        }
        if(!empty($this->templateFile)) {
            if($fp = @fopen($this->templateFile, "r")) {
 
                $this->template = utf8_decode(fread($fp, filesize($this->templateFile))); 
                fclose ($fp); 
            } else {
                return false;
            }
        }

        $this->replaceFunctions();
        return true;
    }

    /**
     * Replace the placeholders
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
     * Replacement functions
     *
     * @access    protected
     * @return    boolean
     */
    protected function replaceFunctions()
    {
        // Includes ersetzen ( {include file="..."} )
        while(preg_match("/".$this->leftDelimiterF."include file=\"(.*)\.(.*)\"".$this->rightDelimiterF."/isUe", $this->template)) {
            $this->template = preg_replace("/".$this->leftDelimiterF."include file=\"(.*)\.(.*)\"".$this->rightDelimiterF."/isUe"
                       , "file_get_contents(\$this->templateDir.'\\1'.'.'.'\\2')", $this->template);
        }

        // remove comments
        $this->template = preg_replace("/".$this->leftDelimiterC."(.*)".$this->rightDelimiterC."/isUe", "", $this->template);
        return  true;
    }  
      
    /**
     * Echo template after rendering
     *
     * @access    public
     * @return    boolean
     */
    public function out()
    {
        $this->evalPhpCode($this->template);
        echo  $this->template;
        return true;
    }
    
    /**
     * eval php code inside the template
     * @param string $sEval 
     */
    public function evalPhpCode($sEval)
    {

        preg_match_all("/(<\?php|<\?)(.*?)\?>/si", $sEval, $aMatches);
        $iMatchIndex = 0;
        while (isset($aMatches[0][$iMatchIndex])) {
            $sRawPhp = $aMatches[0][$iMatchIndex];
            $sRawPhp = str_replace("<?php", "", $sRawPhp);
            $sRawPhp = str_replace("?>", "", $sRawPhp);
            ob_start();
            eval("$sRawPhp;");
            $sExecPhp = ob_get_contents();
            ob_end_clean();
            $sEval = preg_replace("/(<\?php|<\?)(.*?)\?>/si", $sExecPhp, $sEval, 1);
            $iMatchIndex++;
        }
        //remove every placeholder thats left and not replaced yet because it won't happen anymore:
	$sEval  = preg_replace( "/\{(.*?)\}/" , "" , $sEval);
        $this->template = $sEval; 
    }

}

?>
